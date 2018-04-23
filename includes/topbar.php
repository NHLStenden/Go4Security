<?php 
$logInOut = (isset($_SESSION['user'])? '<li style="color: #eeeeee;"><a href="account.php" id="userLoggedIn">Welcome: '.$_SESSION['user'].'</a></li><li><a href="logout.php" id="log" data-toggle="modal" data-target="#login-modal">Logout</a></li>' : '<li><a href="#" data-toggle="modal" id="log" data-target="#login-modal">Login</a></li>');
echo'
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    '. $logInOut  .'
                    <li><a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="pass" placeholder="password">
                            </div>
                            <p class="text-center">
                                <button class="btn btn-primary" id="loginButton"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>';
?>
