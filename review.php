<?php
$reviews = array();
$reviewText = '<div class="box"><h4>Reviews:</h4><hr>';


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user'])){
    $reviewSubmission = "";
    if(!empty($_POST['review'])){
        try{
            $conn = setupDB($dbhost,$dbInsertUsername,$dbInsertPassword);
            $prep = $conn->prepare("INSERT INTO review (product_id,user_id,reviewText) VALUES(:id,:userid,:txt)");
            $prep->bindParam(':id',$_GET['id']);
            $prep->bindParam(':userid',nameToUserID($_SESSION['user'],setupDB($dbhost,$dbSelectUsername,$dbSelectPassword)));
            $prep->bindParam(':txt',$_POST['review']);
            $prep->execute();
            $prep = null;
            $conn = null;
            header("location:detail.php?id=".$_GET['id']);
        }
        catch(PDOException $e){
            echo $e->getMessage(); //debug
        }

    }
    else{
        //TODO afhandelen lege form
        header("location:detail.php?id=".$_GET['id']);
    }
    
}


function showReviews($rArray){
    global $conn;
	$rText = "";
    foreach($rArray as $review){
        $rText = $rText.appendReview($review,$conn);
    }
    return $rText;
}

function placeReviews(){
    if(isset($_SESSION['user'])){
        return '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$_GET['id'].'" method="POST" id ="reviewForm">
        <h5>Submit your review:</h5> <textarea name="review" form="reviewForm" class="form-control"></textarea>
        <span class="input-group-btn">
        <button id="reviewButton" class="btn btn-primary" >Submit</button>
        </span>
        </form>';        
    }
    else{
        return "<p><a href='#' data-toggle='modal' data-target='#login-modal'>Login</a> to place reviews.</p>";
    }
}
 
function appendReview($review,$conn){
    $append = '<h5> Posted by: '.userIdToName($review[1],$conn).'</h5>';
    $append = $append."<p>".$review[2];
    return $append."<hr>";
}

function userIdToName($id,$conn){
    $stmt = $conn->prepare("SELECT username FROM user WHERE user_id=:id;");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $row = $stmt->fetch();
    $stmt = null;
    $conn = null;
    return $row[0];
}

function nameToUserID($name,$conn){
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE username=:n;");
    $stmt->bindParam(':n',$name);
    $stmt->execute();
    $row = $stmt->fetch();
    $stmt = null;
    $conn = null;
    return $row[0];

}
function reviewPrint(){
    global $reviewText;
    echo $reviewText.placeReviews().'</  div>';
}
?>
