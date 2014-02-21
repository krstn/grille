<?
$login=false;
$register=true;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=false;
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Grill Guru</title>
        <meta name="description" content="Yummy food!">
		<link rel="icon" href="icons/logo.png">
        <link rel="stylesheet" href="css/main.css">
        <script type="text/javascript" src="scripts/common.js"></script>
        <script type="text/javascript" src="scripts/slider.js"></script>
        <script type="text/javascript" src="scripts/events.js"></script>

    </head>
    
    <body onload="initSlider()">
        <center id="wrapper">
        <div id="container">
            <div id="header">
                <div id="auth">
                    <? if (!$login){ ?> <a class="login" href="login.php">Sign in | Register</a> 
                    <? } else { ?>  
                        <span id="user">
                            hi <a href="account.php"><? echo $_COOKIE["user"]; ?>!</a>
                        </span>
                        <a class="login" a href="logout.php">Sign out</a>
                    <? } ?>
                </div>
                <a href="index.php"><img src="images/logo.png" /></a>
                <ul id="nav">
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="news.php">News</a></li>
                    <li><a href="careers.php">Careers</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="reservations.php"><img src="images/reserve.png"></a></li>
                </ul>
            </div>