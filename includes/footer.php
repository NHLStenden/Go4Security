<?php 
$VERSION = include('version.php');
    echo '
        <div id="footer" data-animate="fadeInUp">
            <div class="container">     
                <div class="row">           
                    <div class="col-md-3 col-sm-6">
                        <h4>Pages</h4>      
                                        
                        <ul>        
                            <li><a href="about.php">About us</a>
                            </li>
                            <li><a href="termsofuse.php?file=terms.txt">Terms and conditions</a>
                            </li>
                            <li><a href="faq.php">FAQ</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3 col-md-6">
                        <h4>User section</h4>

                        <ul>
                            '.str_replace("Welcome: ","",$logInOut).'
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <div class="col-md-3 col-sm-8">

                        <h4>Where to find us</h4>

                        <p><strong>NHL Stenden</strong>
                            <br>Rengerslaan 10
                            <br>Leeuwarden
                            <br>8917 DD
                            <br>
                            <strong>Nederland</strong>
                        </p>

                        <a href="contact.php">Go to contact page</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <div class="col-md-3 col-sm-8">

                    <h4>Version</h4>
                    
                    <p><strong>version</strong>
                        <br>'.$VERSION['version'].'<br>"'.$VERSION['name'].'"
                    </p>
                </div>                    
                    <!-- /.col-md-3 -->
                <!-- /.row -->
            </div>
	</div>
'; ?>
