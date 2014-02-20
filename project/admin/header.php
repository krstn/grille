
<?php

$login=false;
$register=true;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=false;

}
?>


<html>
	<head> 		
		<title> <?php echo $page; ?> | CVKC Auto Parts </title>
		<link rel="Stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="scripts/scripts.js"> </script>
		<link rel="icon" href="cvkc.jpg">
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
					
					<?php if ($login==false){ ?> <a id="login" href="login.php"> Login as Admin </a> 
					<?php } else { ?>  
						<a id="login" href="logout.php">| Logout </a>
						 <div id="user"> <? echo " Welcome! ". $_COOKIE["user"]; ?> </div> 
					<?php } ?>
				</div>
				<div id="rollyn"> </div>
				<div id="navbar">
					<ul class="tab">
						<li> <a class="<? if (strcasecmp($page, "home") == 0) echo "on"; ?>" href="index.php"> HOME </a> </li>
						<li> <a class="<? if (strcasecmp($page, "about") == 0) echo "on"; ?>" href="about.php"> About </a> </li>
						<li> <a class="<? if (strcasecmp($page, "news") == 0) echo "on"; ?>" href="news.php"> News </a> </li>
						<li> <a class="<? if (strcasecmp($page, "product") == 0) echo "on"; ?>" href="product.php"> Products </a> </li>
						<li> <a class="<? if (strcasecmp($page, "contact") == 0) echo "on"; ?>" href="contact.php"> Contact </a> </li>
					</ul>
				</div>
				<div id="rollyns"> </div>
			</div>
			