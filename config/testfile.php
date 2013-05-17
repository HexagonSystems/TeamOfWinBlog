<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

echo $_SERVER['DOCUMENT_ROOT'];
echo "<br>-----------<br>";

    $host = "localhost";
    $db = "tow";
    $user = "towuser";
    $pass = "towpassword";
    $database = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
    
    $username = "afdas";

    try{
    $user = $database->query("select * from users  where username = '$username'")->fetch();

    }catch(Exception $e){
        throw new Exception( 'Database error:', 0, $e);
    };

    if($user !== false){
        echo("Username found, dang");
    }else{
        echo("Username not found, dang");
    }
    
    
     try{

        $statement = "INSERT INTO `users` (`username`, `email`, `userPassword`, `createDate`, `ACL`, `lastLoginDate`)
                                   VALUES (:username, :email, :userPassword, :ACL)";

        $query = $database->prepare($statement);

        $query->execute(array(    ':username' => 'DB'
                                , ':email' => 'DB'
                                , ':userPassword' => 'DB'
                                , ':ACL' => 'DB'
                        ));

    }catch(Exception $e){
        throw new Exception( 'Database error:', 0, $e);
        return;
    };
    var_dump($user);
?>
