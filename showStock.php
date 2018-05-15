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
        
        include("includes/scripts.php");
        
    ?>
    </div>
    <div id="all">
        <div id="content">
            <div id="stockchecker">
                <div class="container" style="height:48px">
                  <div>
                    <?php
                    // TODO: items below should be tidied!
                    
                    if (isset($_POST['id']) && isset($_POST['number'])){
                      $idProduct      = $_POST['id'];
                      $itemsRequested = $_POST[ 'number'];
                      
                      $conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);
                      $query = "SELECT product_id as id, name as n
                                FROM product
                               WHERE product_id = '" . $idProduct . "'
                                 AND nrInStock >= " . $itemsRequested . "
                              order by name;";
                      
                      $stmt = $conn->prepare($query);
                      $stmt->execute();
                      
                      $row = $stmt->fetch();
                      if (! is_null($row)){
                        echo "<div>Van het product " . $row['n'] ." is nog voldoende voorraad ($itemsRequested gevraagd) </div>";
                      }
                      else{
                        echo "<div>Van het product kan niet genoeg geleverd worden ($itemsRequested gevraagd) </div>";
                        
                      }
                    }//if $_POST parameters present
                    else{
                      echo "<div>U heeft geen product en aantal opgegeven.</div>";
                    }
                    
                    ?>
                  </div>
                </div>
            </div>
            <?php
                include("includes/index/advantages.php");
                include("includes/index/hotproducts.php"); 
            ?>
        </div>
            <?php
                include("includes/footer.php");
                include("includes/copyright.php");
            ?>
    </div>
    <?php include("includes/scripts.php"); ?>
</body>
</html>