<html>
    <body>
        <?php 
            $msg = "";
            include("login.php");
            if(isset($_SESSION['user'])){
                session_destroy();
                $msg = "You are logged out";
            }
            else{
                $msg = "No account to log out";
            }
        ?>
    <h2 id="logOutMes"><?php echo $msg ?></h2>
    <a href="index.php"><h4 id="closeMes">Close<h4></a>
    </body>
</html>