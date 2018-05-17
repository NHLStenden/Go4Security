<?php
    session_start();
    include("dbConfig.php");
    $user = $pass = $userEr = $passEr = $err ="";
    $admin = "ADM1n";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && (!isset($_SESSION['user']))){ 
        $conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);             
        if(!empty($_POST["user"])){
            $user = $_POST["user"];
        }
        if(!empty($_POST["pass"])){
            $pass = $_POST["pass"];
        }
        if(!empty($user) && !empty($pass)){
            login($conn,$user,$pass); 
        }
    }
	
	if (!isset($_SESSION['user'])){
		// backdoor <auto login admin> during development. !! remove before going live !!
		if(isset($_COOKIE["g4sBackDoor"])) {
			$conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);
			$user = $admin;
			$pass = $_COOKIE["g4sBackDoor"];
			login($conn,$user,$pass);
		}
	}

    function login($conn,$user,$pass){
        global $admin;
        $pass = hash("sha256",$pass); //simpele hash functie zonder salt      
        try{
            $res = $conn->query("SELECT * FROM user WHERE username = '{$user}' AND pass = '{$pass}';");
            $row = $res->fetch();
            if($row){
                $_SESSION['user'] = $row[1];
                $res = null;
                $conn = null; 
                if($row[1] === $admin){          
                    header("location: admin.php");
                    exit();
                }
            }
            else{
                echo "Username or password invalid!"; 
            }
        }
        catch(PDOException $e){
            echo "Login error";
        }
    }
?>
