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
		// backdoor <auto login > during development. !! remove before going live !!
		// set cookie to user%password
		if(isset($_COOKIE["g4sBackDoor"]) && strpos($_COOKIE["g4sBackDoor"], "%")) {	
			list($user,$pass) = explode("%",$_COOKIE["g4sBackDoor"], 2);
			$conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);	
			login($conn,$user,$pass);
		}
	}

    function login($conn,$user,$pass){
        global $admin;
        $pass = hash("sha256",$pass); //simpele hash functie zonder salt      
        try{
            $res = $conn->prepare("SELECT * FROM user WHERE username=:un AND pass=:p;");
            $res -> bindParam(':p', $user);
            $res -> bindParam(':p', hash("sha256",$pass));
            $res -> execute();
            $row = $res->fetch();
            if($row){
                $_SESSION['user'] = $row[1];
                $res = null;
                $conn = null; 
                if($row[1] === $admin){          
                    header("location: admin.php");
                    exit();
                }
                else {
                    header("location: index.php");
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
