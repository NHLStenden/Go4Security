<?php 
if (session_status() == PHP_SESSION_NONE){
session_start();
}
include_once __DIR__ . '/../dbConfig.php';


if(!isset($_SESSION['basket'])){
    $_SESSION['basket'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user']) && isset($_POST['basket_action'])){
    if($_POST['basket_action'] === 'add'){
        echo AddToCart($_POST['product_id'], $_POST['amount']);
    } else if($_POST['basket_action'] === 'remove') {
        RemoveFromCart($_POST['product_id'], $_POST['amount']);
    }
}

function TotalProducts(){
    $total = 0;
    foreach ($_SESSION['basket'] as $product_id) {
        $total += $product_id['amount'];
    }
    return $total;
}

function AddToCart($product_id, $amount) {
  // MaMo 2018-05-22 : added check if product is already in cart; if not: setup new product-id slot in array and setup nr of products to 1 
  if (! array_key_exists($product_id, $_SESSION['basket'])) {
    $_SESSION['basket'][$product_id] = Array('amount' => 1);
  }
  else{
    $_SESSION['basket'][$product_id]['amount'] += $amount;
  }
  return TotalProducts();
}

function RemoveFromCart($product_id, $amount){
    $_SESSION['basket'][$product_id]['amount'] -= $amount;
    if($_SESSION['basket'][$product_id]['amount'] <= 0){
        unset($_SESSION['basket'][$product_id]);
    }
}

function ReturnProductsInBasket(){
    foreach ($_SESSION['basket'] as $product_id => $amount) {
        echo MakeProduct($amount['amount'], SearchProduct($product_id));
    }
}

function SearchProduct($query){
    global $dbhost, $dbSelectUsername, $dbSelectPassword;
    $conn = setupDB($dbhost,$dbSelectUsername,$dbSelectPassword);
    $stmt = $conn->prepare('SELECT * FROM product WHERE product_id = ?');
    $stmt->execute([$query]);
    return $stmt->fetch();    
}

function MakeProduct($amount, $row){
    return '
    <tr>
        <td><a href="detail.php?id='. $row[0]  .'"><img src=".'. $row[4] .'" alt="'. $row[1]  .'" class="productimage"></a></td>
        <td><a href="detail.php?id='. $row[0] .'">'. $row[1]  .'</a></td>
        <td style="text-align: center;">'. $amount .'</td>
        <td style="text-align: center;">'. $row[2] .'</td>
        <td style="text-align: center;">'. number_format((float)$row[2] * $amount, 2, '.', '') .'</td>
        <td><a href="#" class="remove_basket" name="'. $row[0] .'"><i class="fa fa-trash-o"></i></a></td>
    </tr>
    ';
}

function TotalPriceOfCart(){
    $total = 0;
    foreach ($_SESSION['basket'] as $product_id => $amount) {
        $total += SearchProduct($product_id)[2] * $amount['amount']; 
    }
    echo number_format((float)$total, 2, '.', '');
}

?>
