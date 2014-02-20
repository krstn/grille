<?
include'db_access.php';
$login=false;
$register=true;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=false;
}

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
							<title>UNTITLED</title>
							<script type="text/javascript" src="scripts/jsDatePick.jquery.min.1.3.js"></script>
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
$showForm=true;
$errorMsg="";

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");


$query= "SELECT * FROM news ORDER BY id ASC LIMIT 0,3;";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Grill Guru</title>
        <meta name="description" content="Yummy food!">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/cal.css">
        <script type="text/javascript" src="scripts/main.js"></script>
		<script type="text/javascript" src="scripts/jsDatePick.jquery.min.1.3.js"></script>

    </head>
    
    <body onload="initSlider()">
		<div id="heads">
			<div id="auth" <? if ($login==true ) { ?> class="on" <? } ?>>
				<?php if ($login==false){ ?> <a id="login" href="login.php" style="font-family:'Signika';"> Login </a> 
				<?php } else { ?>  
				<a href="logout.php" id="login" onClick="confirmation();" style="font-family:'Signika';"> Logout </a>
				 		
				<div id="user"> <span ><? echo " Welcome! "?> </span> <a style="color:#fb0;" href="account.php"><? echo $_COOKIE["user"]; ?>&nbsp</a> </div>
				
				<?php } ?>
			</div>
		</div>
        <center>
        <div id="container">
		
					
            <div id="header">
                <a href="index.php"><img src="images/logo.png" /></a>
                <ul>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="news.php">News</a></li>
                    <li><a href="careers.php">Careers</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="reserve.php"><img src="images/reserve.png"></a></li>
                </ul>
            </div>
			<div id="campaign">
                <div id="slides">
                    <div class="slide" style="background-image:url('images/slides/slide1.png')">
                        <span class="content">
                            <div class="title">Grill Guru Cheese Burger</div>
                            <div class="description">Charcoal grilled burger with cheese, onions, tomatoes and special house dressing</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                    <div class="slide" style="background-image:url('images/slides/slide2.png')">
                        <span class="content">
                            <div class="title">Char-grilled Salmon Steak</div>
                            <div class="description">Served over plain rice with sauteed vegetables and our sauce duo (lemon butter and asian soy)</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                    <div class="slide" style="background-image:url('images/slides/slide3.png')">
                        <span class="content">
                            <div class="title">Chocolate Cake</div>
                            <div class="description">Served over plain rice with sauteed vegetables and our sauce duo (lemon butter and asian soy)</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                </div>
                <div class="arrow">
                    <img onclick="slidePrev()" class="left" src="images/slides_arrow_left.png" />
                    <img onclick="slideNext()" class="right" src="images/slides_arrow_right.png" />
                </div>
            </div>
            
            <div id="social">
                <a href="https://www.facebook.com/profile.php?id=100002584601251&fref=ts" target="-blank"><img src="images/social_facebook.png"></a>
                <a href="https://twitter.com/grillgurubcd" target="-blank"><img src="images/social_twitter.png"></a>
                <a href="index.php" target="-blank"><img src="images/social_instagram.png"></a>
            </div>
            <form method="post" action="samp.php">
	<?
		if(isset($error)) {
			echo $error;
		}
	?>
	<textarea name="content" style="display:none;">
							<?$i; for ($i=0; $i < $num; $i++) {?>
							<h3 class="highlight">  <a href="view_news.php?id=<? echo mysql_result($result,$i,"id"); ?>"> <? echo mysql_result($result,$i,"descrition"); ?> </a> </h3>
								<div class="n">
								<img style="width:400px;height:330px;" src="<? echo mysql_result($result,$i,"image");?>" /> 
								</div>
								</br>
								<div class="item">
								<span style="font-family:Arial;"> <?echo mysql_result($result,$i,"news"); ?> </span>
								</br>
								</br>
								<label > <i style="color:#fb0;"> <?echo mysql_result($result,$i,"date"); ?></i> </label>
								</div>
							<? } ?>
	</textarea></br>
	<input type="submit" name="submit" value="generate pdf"/> 
</form>
