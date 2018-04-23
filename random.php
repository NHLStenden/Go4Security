<?php 
include("login.php");
$ids = array();
if($conn == null){
    $conn = setupDB($host,$dbSelectUsername,$dbSelectPassword);
}
$stmt = $conn->prepare("SELECT product_id FROM product");
$stmt->execute();
while ($row = $stmt->fetch()) {
    $ids[] = $row[0];
}
$id = array_rand($ids);
header("location: detail.php?id=".$ids[$id]);
exit();
?>