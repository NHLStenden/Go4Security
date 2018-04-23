<?php       //db variabelen
    $dbhost = "localhost"; 
    $dbInsertUsername = "User2";
    $dbInsertPassword = "phpBDADMIN";
    $dbSelectUsername = "User1";
    $dbSelectPassword = "phpBDADMIN";
    $dbUpdateUsername = "user3";
    $dbUpdatePassword = "phpBDADMIN";


    function setupDB($hst,$un,$pw){
        try {
                $conn = new PDO("mysql:host=$hst;dbname=php", $un, $pw);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
        }
        catch(PDOException $e){
            echo "Connection failed";// . $e->getMessage(); //debug
            return null;
        }       
    }
?>
