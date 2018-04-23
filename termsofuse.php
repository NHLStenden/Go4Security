
<!DOCTYPE html>
<html lang="en">
<?php
include("login.php");
include("includes/head.php");
?>
<body>
<div id="navb">
    <?php
    include("includes/topbar.php");
    include("includes/navbar.php");
    ?>
</div>
<div id="all">
    <div id="content">
        <div id="hot">
            <div class="box">
                <div class="container">
                    <div class="col-md-11">
                        <h2>Terms of use</h2>
                        <?php
                            $url = $_SERVER['REQUEST_URI'];
                            if ((strpos($url,"file")&&(strpos($url,".txt")) !== false)) {
                               if (file_exists((string)($_GET['file']))){
                                   $test = file_get_contents($_GET['file']);
                                   echo "<pre>$test</pre>";
                               }
                               else {
                                   echo "<strong>file does not exist</strong>";
                               }
                            }
                            else{
                                echo "<strong>couldn't find .txt file</strong>";
                            }
                        ?>
        </div>
    </div>
</div>

    </div>
    <?php
    include("includes/footer.php");
    include("includes/copyright.php");
    ?>
</div>
<?php include("includes/scripts.php"); ?>
</body>
</html>
