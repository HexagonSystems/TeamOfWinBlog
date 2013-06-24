<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

class User
{
    private $database;
    private $username;
    private $password;
    private $email;
    private $firstLogin;
    private $lastLogin;
    private $accessLevel;

    /**
     * Constructor with extra quick create/login
     * @param  PDO    $database  sets the database connection
     * @param  Array  $userArray Optional must contain a key of "new" or "login" needs "username", "password" [, "email", "accessLevel"]
     * @return Object or String returns this object
     */
    public function __construct( PDO $database, $userArray = array('') )
    {

        $this->database = $database;

        if ( isset($userArray["new"]) ) {

            $this->createUser($userArray["username"], $userArray["password"], $userArray["email"], $userArray["accessLevel"]);

            return($this);

        } elseif (isset($userArray["login"]) ) {

            $this->loginUser($userArray["username"], $userArray["password"]);

            return($this);
        }

    }

    /**
     * Creates a new user
     *
     * @param String $username
     * @param String $password
     * @param String $email
     * @param Int    $accessLevel
     */
    public function createUser($username, $password, $email, $accessLevel)
    {
        if ($this->checkUsername($username) == "Username not found") {

            $this->setUsername($username);

            if ($this->checkEmail($email) == "Email not found") {

                $this->setEmail($email);

            } else {
                return($this->checkEmail($email));

            }

            $this->setPassword($password);

            $this->setFirstLogin();
            //$this->setLastLogin(time());

            $this->setAccessLevel($accessLevel);

            //If success return this object
            return($this);

        } else {
            return($this->checkUsername($username));
        }

        return($this);

    } //end createUser

    /**
     * Tests if username exists in Database
     * Can be used to check the user has the right username or check the user isn't trying to
     * register a username that already exists
     * @param  String    $username
     * @return String
     * @throws Exception
     */
    public function checkUsername($username)
    {

        try {
            $user = $this->database->query("select username from users where username = '$username'")->fetch();

        } catch (Exception $e) {
            throw new Exception( 'Database error:', 0, $e);

            return;
        };

        if ($user !== false) {
            return("Username found");
        } else {
            return("Username not found");
        }

    }// end checkUsername

    /**
     * Tests if email exists in Database
     * Can be used to check the user has the right email or check the user isn't trying to
     * register an email that already exists
     * @param  String    $email
     * @return String    either "Email found" or "Email not found"
     * @throws Exception
     */
    public function checkExists($data, $type)
    {

        try {
            $user = $this->database->query("select $type from users where $type = '$data'")->fetch();

        } catch (Exception $e) {
            throw new Exception( 'Database error:', 0, $e);

            return;
        };

        if ($user !== false) {
            return("Data found");
        } else {
            return("Data not found");
        }

    }// end checkUsername

    public function checkEmail($email)
    {

        try {
            $user = $this->database->query("select * from users where email = '$email'")->fetch();

        } catch (Exception $e) {
            throw new Exception( 'Database error:', 0, $e);

            return;
        };

        if ($user !== false) {
            return("Email found");
        } else {
            return("Email not found");
        }

    }// end checkEmail

    /**
     * Checks if a string matches the password. Does NOT set the Password
     * @todo Need to add an error check if password hasn't been set yet
     * @param  String  $password
     * @return boolean
     */
    public function checkPassword($password)
    {
        $password = sha1($password);

        if ($this->getPassword() === $password) {
            return true;
        } else {
            return false;
        }
    }// end checkPassword

    /**
     * Wraps checking Username and Password together
     * @todo Set Up calls to create session for user if successful
     * @param  String        $username
     * @param  String        $password
     * @return String/Object
     * @throws Exception
     */
    public function loginUser($username, $password)
    {
        if ($this->checkUsername($username) == "Username not found") {
            return("Username not found");
        }

        //Collect User from the database
        try {
            //returns multidemnsional array
            $user = $this->database->query("select * from users where username = '$username'")->fetch();

        } catch (Exception $e) {
            throw new Exception( 'Database error:', 0, $e);

            return;
        };

        //map the single row to be the whole array
        //$user = $user[0];

        //Set the password
        $this->setPassword($user["userPassword"], "old");

        if (!$this->checkPassword($password)) {
            //Else errors
            return("Password Incorrect");
        };

        $this->setUsername($user["username"]);

        $this->setEmail($user["email"]);

        //$this->firstLogin = $firstLogin;
        $this->setLastLogin();
        $_SESSION['activeUser'] = $this->getUsername();

        $this->setAccessLevel($user['ACL']);

        //If success return this object
        return($this);

    }//end loginUser

    /**
     * Save user to database
     *
     * @todo Get this working correctly the current INSERT is in correct
     * @return string - Either error messages or saved
     */
    public function save()
    {
        try {

            $statement = "INSERT INTO `users` (`username`, `email`, `userPassword`, `ACL`)
                                       VALUES (:username, :email, :userPassword, :ACL)";

            $statement = $this->database->prepare($statement);

            $statement->execute(
                array(':username' => $this->getUsername()
                    , ':email' => $this->getEmail()
                    , ':userPassword' => $this->getPassword()
                    , ':ACL' => $this->getAccessLevel()
                )
            );

        } catch (Exception $e) {
            throw new Exception( 'Database error:', 0, $e);

            return;
        };

        return("saved");
    }

    
    public function automaticLogin($username) {
        
        if ($this->checkUsername($username) == "Username not found") {
            return("Username not found");
        }

        //Collect User from the database
        try {
            //returns multidemnsional array
            $user = $this->database->query("select * from users where username = '$username'")->fetch();

        } catch (Exception $e) {
            throw new Exception( 'Database error:', 0, $e);

            return;
        };

        //Set the password
        $this->setPassword($user["userPassword"], "old");

        $this->setUsername($user["username"]);

        $this->setEmail($user["email"]);

        $this->setLastLogin();
        
        $_SESSION['activeUser'] = $this->getUsername();

        $this->setAccessLevel($user['ACL']);

        //If success return this object
        return($this);
    }
    /**
     * Set the username for the user
     * @todo go private on this I don't think it should be a public method
     * @param String $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the users email
     * @todo Add check for well formedness?
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Password, change the value of old when setting an already encrypted password
     * @param string $password
     * @param string $old      - If unset will encrypt the incoming password
     */
    public function setPassword($password, $old = 0)
    {
        if ($old === 0) {
            $password = sha1($password);
        };

        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    //First Login
    public function setFirstLogin()
    {
        $this->firstLogin =  date('Y-m-d H:i:s');
    }
    public function getFirstLogin()
    {
        return $this->firstLogin;
    }

    //Last Login
    public function setLastLogin()
    {
        $this->lastLogin = time();
    }
    public function getlastLogin($username = null)
    {
        if($username != null){
            try {
                $user = $this->database->query("select lastLogin from users where username = '$username'")->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                throw new Exception( 'Database error:', 0, $e);

                return;
            };
            return($user['lastLogin']);
        }
        return $this->lastLogin;
    }

    /**
     * Sets the access level for the user
     * @todo Add Sanity checks in here and return values
     * @param Int $accessLevel
     */
    public function setAccessLevel($accessLevel)
    {
        $this->accessLevel = $accessLevel;
    }
    public function getAccessLevel()
    {
        return $this->accessLevel;
    }

    public function sessionCreate()
    {
        if (!empty($this->username)) {
            $_SESSION['account'] = array('username'=>$this->getUsername(), 'access'=>$this->getAccessLevel());
            $_SESSION['accountObject'] = serialize($this);
        }
    }

    public function sessionDestroy()
    {
        if (isset($_SESSION['account'])) {
            session_unset('account');
        }
        if (isset($_SESSION['accountObject'])) {
            session_unset('accountObject');
        }
    }

    public function __sleep()
    {
        return array( 'username'
                    , 'password'
                    , 'email'
                    , 'firstLogin'
                    , 'lastLogin'
                    , 'accessLevel'
                    );
    }

    public function setDatabase(PDO $database)
    {
        $this->database = $database;
    }
    //end Class
}
