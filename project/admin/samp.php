
<?php

$login=false;
$register=true;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=false;
	
	if (isset($_POST['submit'])){
	$content = $_POST['content'];
		if(empty($content)){
			$error ='Please enter some content to create your Pdf';
		}
		else {
			include_once('dompdf/dompdf_config.inc.php');
			$html = '<!DOCTYPE html>
					<html lang="en">
						<head>
							 <meta charset="utf-8">
							<link rel="Stylesheet" href="css/style.css" type="text/css" media="screen" />
							<script type="text/javascript" src="scripts/scripts.js"> </script>
							<link rel="icon" href="icons/logo.png">
							<title>  Grill Guru </title>
						</head>
						<body>
							</br>
							<center>'.$content.'</center>
						</body>
						</html>';
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream('Sample.pdf');
		}
}

}
?>

<html>
	<head> 		
	 <meta charset="utf-8">
		<title> <?php echo $page; ?> | Grill Guru </title>
		<link rel="Stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="scripts/scripts.js"> </script>
		<link rel="icon" href="icons/logo.png">
		<script src="themes/1/js-image-slider.js" type="text/javascript"></script>
		<script src="themes/3/js-image-slider.js" type="text/javascript"></script>
		<link href="generic.css" rel="stylesheet" type="text/css" />
		
	</head>
	<body>
	<center>
		<div id="container">
			<div id="header">
				<div id="axe"> </div>
				<div id="auth" <? if ($login==true ) { ?> class="on" <? } ?>>
					
					<?php if ($login==false){ ?> <a id="login" href="login.php"> Admin Login </a> 
					<?php } else { ?>  
						<a href="logout.php" id="login" onClick="confirmation();"> Logout </a>
						 <div id="user"> <? echo " Welcome! ". $_COOKIE["user"]; ?> </div> 
					<?php } ?>
				</div>
				
				<div id="navbar">
					<ul class="tab">
						<li> <a class="<? if (strcasecmp($page, "home") == 0) echo "on"; ?>" href="index.php"> Home </a> </li>
						<li> <a class="<? if (strcasecmp($page, "news") == 0) echo "on"; ?>" href="edit_news.php"> News </a> </li>
						<li> <a class="<? if (strcasecmp($page, "users") == 0) echo "on"; ?>" href="users.php"> Users </a> </li>
						<li> <a class="<? if (strcasecmp($page, "menu") == 0) echo "on"; ?>" href="products.php"> Menu </a> </li>
						<li> <a class="<? if (strcasecmp($page, "reservations") == 0) echo "on"; ?>" href="reserve.php"> Reservations </a> </li>
						<li> <a class="<? if (strcasecmp($page, "careers") == 0) echo "on"; ?>" href="careers.php"> Sales </a> </li>
						<li> <a class="<? if (strcasecmp($page, "careers") == 0) echo "on"; ?>" href="careers.php"> Inventory </a> </li>
						
					</ul>
				</div>
				
			</div>
				 <form method="post" action="samp.php">
	<?
		if(isset($error)) {
			echo $error;
		}
	?>
			<textarea name="content" >
						asdadaad asdasdasdasd asdadadad asdadad
	</textarea></br>
	<input type="submit" name="submit" value="generate pdf"/>
	</form>