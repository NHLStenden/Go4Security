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
    <div id="post-content">
        <div id="hot">

            <div class="box">
                         <div class="container">
                             <h2>Contact us</h2>
                             <h4>this feature is currently not available, our apologies.</h4>
                             <form action="index.php">
                                 <div class="form-group">
                                     <label>Email:</label>
                                     <input type="email" class="form-control" placeholder="Enter email">
                                 </div>
                                 <div class="form-group">
                                     <label for="pwd">Question & Complaints</label>
                                     <input type="text" class="form-control" placeholder="Enter question or complaint">
                                 </div>
                                 <button type="submit" class="btn btn-default">Submit</button>
                             </form>
                         </div>
                     </div>
                 </div>
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
