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
        
        #include("includes/scripts.php");
        
    ?>
    </div>
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <?php
                        $headers = getallheaders();
                                                
                        assert_options(ASSERT_ACTIVE, 1);
                        assert_options(ASSERT_WARNING, 0);
                        assert_options(ASSERT_QUIET_EVAL, 1); 
                        assert_options(ASSERT_CALLBACK, 'my_assert_handler');

                    	$post;$conn;
                        if(isset($_POST['query'])){
                            $post = $_POST['query'];
                            if(assert("strpos('$post','../')===false")){
                                if(isset($_SESSION['user'])){
                                    if($_SERVER["REQUEST_METHOD"] == "POST"){
					                    $conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);
                                        $query = $_POST['query']; 
                                        search($conn,$query);
                                    }   
				                }
				                elseif(isset($headers['DEBUG']) && ($headers['DEBUG'] === "true")){  
                                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                                        $conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);
                                        $query = $_POST['query']; 
                                        search($conn,$query);
                                    }   
                                }
                                else{
                                    echo "Please login to use this function";
                                }  
                            }
                            else{ 
                                echo ". Possible directory traversal attack detected and blocked";
                            }
				        }
                        elseif(!empty($_GET["cat"])) { //GET variabele voor het selecteren van alle items
				            $conn = setupDB($dbhost, $dbSelectUsername, $dbSelectPassword);
                            echo '<div class="col-md-12"><ul class="breadcrumb"><h4>Showing category: ' . htmlspecialchars($_GET["cat"]) . '</h4></ul></div>';
                            if ($_GET["cat"] == "all") {
                                $sql = "SELECT * FROM product;";
                                echo '<div class="product-slider">';
                                foreach ($conn->query($sql) as $row) {
                                    placeProduct($row);
                                }
                                echo "</div>";
                            } 
                            else {
                                $stmt = $conn->prepare("SELECT COUNT(*) FROM php.product WHERE category = :cat ;");
                                $stmt->bindParam(':cat', $_GET["cat"]);
                                $stmt->execute();
                                if ($stmt->fetchColumn() > 0) {
                                    $stmt = $conn->prepare("SELECT * FROM php.product WHERE category = :cat ;");
                                    $stmt->bindParam(':cat', $_GET["cat"]);
                                    $stmt->execute();
                                    echo '<div class="product-slider">';
                                    while ($row = $stmt->fetch()) {
                                        placeProduct($row);
                                    }
                                    echo "</div>";
                                } 
                                else {
                                    echo "<h4>No items found for this category</h4>";
                                }
                            }
                        }
                        else{ 
                            echo "<h4>An error occured.</h4>";
                        }
                
                        // Create a handler function
                        function my_assert_handler($file, $line, $code, $desc = null)
                        {
                            echo "Assertion failed";
                        }

                        function search($conn,$query){
                            $stmt = $conn->prepare("SELECT COUNT(*) FROM php.product WHERE name LIKE ? OR description LIKE ? ;");
                            $stmt->execute(array('%'.$query.'%','%'.$query.'%'));
                            if($stmt->fetchColumn() > 0){ //geen tabel aanmaken als het geen resultaten heeft
                                $stmt = $conn->prepare("SELECT * FROM php.product WHERE name LIKE ? OR description LIKE ? ;");
                                if ($stmt->execute(array('%'.$query.'%','%'.$query.'%'))) {
			                        echo "<h2>You searched for: ".$query." </h2>";
			                        echo '<div class="product-slider">';
                                    while ($row = $stmt->fetch()) {
                                        placeProduct($row);
			                        }
                                    echo "</div>";
                                }
                            }
                            else{
                                echo "<h2>No results for your query..</h2><br>";
                                echo "<h2>You searched for:.$query. </h2>";
                            }
                            $conn = null;
                        }

                        function placeProduct($prod){
                            echo '
                            <div class="item">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="detail.php?id=' . $prod[0] . '">
                                                    <img src=".'. $prod[4] .'" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="detail.php?id=' . $prod[0] . '">
                                                    <img src=".'. str_replace(".jpg","_2.jpg",$prod[4]) .'" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="detail.php?id=' . $prod[0] . '" class="invisible">
                                        <img src=".'. $prod[4] .'" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <h3><a href="detail.php?id=' . $prod[0] . '">'. $prod[1] .'</a></h3>
                                        <p class="price">'.'€ '. $prod[2]  .'</p>
                                        <p class="buttons">
                                            <a href="detail.php?id=' . $prod[0] . '" class="btn btn-default">View details</a>
                                            <a name="'. $prod[0]  .'" class="btn btn-primary add_basket">Add to cart<i class="fa fa-shopping-cart"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>';
                        }
                    ?> 
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