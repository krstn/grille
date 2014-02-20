<?php 
$page='Edit News';
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


$query= "SELECT * FROM news ORDER by id ASC;";
$result=mysql_query($query);
$num=mysql_numrows($result);
$date = date("Y-m-d");
$user = $_COOKIE["user"];

mysql_close();

?>
		<div id="contents">
			<div class="pageTitle"><? echo $page; ?></div>
			<?$i; for ($i=0; $i < $num; $i++) {?>
				<h3> <b> <? echo mysql_result($result,$i,"name"); ?> </b> </h3>
				<hr style="border:dotted; color:#191919;">
				<ul>
					<li> <img src= <?echo mysql_result($result,$i,"image"); ?> style="width:500; height:350;" > </img> </li>
				</ul>
				
				<ul>
					<li type="circle"> <?echo mysql_result($result,$i,"description"); ?> </li>
				
					<li>
						<a class="submit" href="manage_news_edit.php?id=<? echo mysql_result($result,$i,"id")?>&descz=<? echo mysql_result($result,$i,"name"); ?>&newsz=<? echo mysql_result($result,$i,"description"); ?>">Edit</a>
						<a class="submit" href="edit_news.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a>
					</li>
				</ul>
				<? } ?>

		</div>
		<? include 'footer.php'; ?>
			
			
		