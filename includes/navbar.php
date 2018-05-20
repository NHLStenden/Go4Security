<?php 
require_once('basket.php');
$basket = TotalProducts();
$log = (isset($_SESSION['user'])) ? '<a href="logout.php" data-toggle="modal" data-target="#login-modal">Logout</a></li>' : '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>';
?>
<div class="navbar navbar-default yamm" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-buttons">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
                <a class="btn btn-default navbar-toggle" href="account.php">
                    <i class="fa fa-shopping-cart"></i>  
                    <span class="hidden-xs"><?php echo $basket;  ?></span>
                </a>
            </div>
        </div>
        <div class="navbar-collapse collapse" id="navigation">
            <ul class="nav navbar-nav navbar-left">
            <li class="active"><a href="index.php">Home</a></li>
            <li class="dropdown yamm-fw">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Products <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="yamm-content">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h5>Shop</h5>
                                    <ul>
                                        <li><a href="index.php">Homepage</a></li>
                                        <li><a href="search.php?cat=all">All Items</a></li>
                                        <li><a href="search.php?cat=Development-boards">Development-boards</a></li>
                                        <li><a href="stock.php">Stock check</a></li>
                      
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <h5>User</h5>
                                    <ul>
                                        <li><?php echo $log; ?></li>
                                        <li><a href="account.php?action=basket">Basket</a></li>
                                        <li><a href="account.php?action=pwchange">Change Password</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                <h5>Information</h5>
                                <ul>
                                    <li><a href="faq.php">FAQ</a></li>
                                    <li><a href="termsofuse.php?file=terms.txt">Terms and Conditions</a></li>
                                    <li><a href="about.php">About us</a> </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            </ul>
        </div>
        <div class="navbar-buttons">
            <div class="navbar-buttons">
                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="account.php?action=basket" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"><?php echo $basket; ?>  items in cart</span></a>
                </div>
                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="collapse clearfix" id="search">
                <form class="navbar-form" role="search" action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
