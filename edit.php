<?php 
include("login.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_SESSION['user']) && $_SESSION['user'] == $admin)){
    $data = validInput();
    $id = null;
    if(isset($_SESSION['productid'])){
        $id = intval($_SESSION['productid']);
    }
    if(!is_null($data) && is_int($id)){
        try{
            $conn = setupDB($dbhost, $dbUpdateUsername, $dbUpdatePassword);
            $stmt = $conn->prepare("UPDATE php.product SET name = :name ,price = :price, description = :desc WHERE product_id = :id;");
            $stmt->bindParam(':name',$data[0]);
            $stmt->bindParam(':price',$data[1]);
            $stmt->bindParam(':desc',$data[2]);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo 'alert("Editing failed, db error")';
            //echo $e->getMessage(); //uncomment voor meer informatie voor studenten
        }
        finally{
            $conn = null;$_SESSION['productid'] = null;
            header("location: detail.php?id=".$id);
        }
    }
    else{
        echo '<script type="text/javascript">alert("Editing failed, invalid data.");</script>';
    }
}

function validInput(){
    if(isset($_POST['productname']) && (isset($_POST['productprice']) && is_numeric($_POST['productprice'])) && isset($_POST['productdesc'])){
        $name = htmlspecialchars(trim(stripslashes($_POST['productname'])));
        $price = trim(stripslashes($_POST['productprice']));
        $desc = htmlspecialchars(trim(stripslashes($_POST['productdesc'])));
        if(strlen($name) < 40 && strlen($price) < 9 && strlen($desc) < 1000){
            return array($name,$price,$desc);
        }
    }
    return null;
}
?>