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
                  <form action="showStock.php" method="get">
                    <label>Check stock of item</label>
                    <select name="id">
                    <?php
                    $conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);
                    $query = "SELECT product_id as id, name as n FROM product order by name;";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                      echo '<option value="' . $row['id'] . '">' . $row['n'] . "</option>";
                    }
                    
                    ?>
                    </select>
                    <!--  <input  name="number" type="number" value="1" maxlength="2" min="1" size="3" required/>  -->
                    <input  name="number" type="text" value="1" maxlength="3" size="3" required/>
                    <button type="submit" >Check!</button>
                    </form>
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