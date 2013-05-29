<?php
/**
 * Minor helper class for logging failed user log in attempts
 * Usage pass the class a DB connection and the username of the log in attempt
 * the class will create a log event and test how many times the IP has
 * attempted to login which it will return as a boolean. If the log in event is
 * a failure (tested in the user class) the class must be called again with
 * loginFailed()
 */
class LoginTracker {

    private $database;
    private $ip;
    private $username;
    private $log;
    private $maxAttempts = 3;
    private $attemptsUsername = 0;
    private $attemptsIp = 0;
    private $message = array();
    
    /**
     * Constructor creates a logIn event requires a database and username
     * @param PDO $database 
     * @param String $username
     * @return Array An error of issues or an empty array if no issues found
     */
    public function __construct(PDO $database , $username)
    {
        $this->database = $database;
        
        $this->setIP();
        
        $this->setUsername($username);
        
        $this->checkLog();
        
        return($this->message);
        
    }
    
    /**
     * Sets IP to a long of the users IP address
     */
    private function setIP()
    {
        //Convert IP address to Long for store.
        //This can be reversed with long2ip or in MySQL with INET_NTOA
        $this->ip = ip2long($_SERVER['REMOTE_ADDR']);
    }
    
    private function setUsername($username)
    {
        $this->username = $username;
    }
    
    private function checkLog() {
        
        $statement = "SELECT * FROM 'badLogin' WHERE 'username' = $this->username <> 'IPAddress' = $this->ip AND attemptTime >= NOW() - INTERVAL 30 MINUTES";
        
        $this->log = $this->database->query($statement)->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($this->log as $row){
            if($row['username'] == $this->username){
                $this->attemptsUsername++;
            };
            if($row['IPAddress'] == $this->ip){
                $this->attemptsIp++;
            };
        };
        
        if($this->attemptsIp > $this->maxAttempts){
            $this->message[] = 'Too Many IP';
        };
        
        if($this->attemptsUsername > $this->maxAttempts){
            $this->message[] = 'Too Many Username';
        }
        
    }
    
    private function addLog() {
        
        try{

            $statement = "INSERT INTO `tow`.`badLogins` (`IPAddress`, `attemptTime`, `username`)
                          VALUES ( :IPAddress, NOW(), :username )";

            $query = $this->database->prepare($statement);
            
            $values = array(':username' => $this->username
                          , ':IPAddress' => $this->ip );
            
            $query->execute($values);

        }catch(Exception $e){
                throw new Exception( 'Database error:', 0, $e);
                return;
        };
        
        return(TRUE);
    }
}