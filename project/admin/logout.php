<?php 
$page='Logout';
include 'header.php';
include 'db_access.php';



setcookie("user", "", time()-3600);
 header( 'Location: index.php' ) ;



?>
	
	<div id="contents">
<?
include 'sidebar.php';
?>
		<p> You have been logged out </p>
	</div>
				
	<div id="sidebar">
	</div>
	</div>
	<footer>
                <div class="main">
                    <span>© 2012 Cyscorpions INC. All rights reserved.</span>
                    
                </div>
            </footer>
			</center>
	</body>

</html>