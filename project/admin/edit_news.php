<?php 
$page='News';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
}
include 'header.php';
include 'db_access.php';


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM news WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete News: ".mysql_error();
	}
}

if ($login == true) {
$query= "SELECT * FROM news ORDER by id DESC;";
$result=mysql_query($query);
$num=mysql_numrows($result);
$date = date("Y-m-d");
$user = $_COOKIE["user"];
}
mysql_close();

?>
		<div id="contents">
		<? if ($login == true) {?>
		<br>
	<form class="lists" action="search_news.php" method="GET">
	<input type="text" name="search" />	
		<input class="submit" type="submit" value="Search" onClick="goTo();" />
	</form>
			<div class="pageTitle"><? echo $page; ?></div>
			 <?$i; for ($i=0; $i < $num; $i++) {?>
			
				<h3 class="subtitle"> <b > <? echo mysql_result($result,$i,"descrition"); ?> </b> </h3>
				
				<ul>
					<li> <img src= <?echo mysql_result($result,$i,"image"); ?> style="width:500; height:350;" > </img> </li>
				</ul>
				
				<ul>
					<li type="circle"> <?echo mysql_result($result,$i,"news"); ?> </li>
				
					<li>
						<a class="submit" href="manage_news_edit.php?id=<? echo mysql_result($result,$i,"id")?>">Edit</a>
						<a class="submit" href="edit_news.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a>
					</li>
				</ul>
				<? } }else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>

		</div>
		<? include 'footer.php'; ?>
			
			
		