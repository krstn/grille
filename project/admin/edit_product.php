<?php 
$page='Edit Product';
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
	$delete="DELETE FROM products WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete News: ".mysql_error();
	}
}


$query= "SELECT * FROM products ORDER BY id DESC;";
$result=mysql_query($query);
$num=mysql_numrows($result);


mysql_close();

?>
		<div id="contents">
	
			<div class="pageTitle"><? echo $page; ?></div>
			
			<?$i; for ($i=0; $i < $num; $i++) {?>
				
				<h3 > <b> <? echo mysql_result($result,$i,"category"); ?> </b> </h3>
				<ul>
					<li> <img src= <?echo mysql_result($result,$i,"image"); ?> style="width:500; height:600;" > </img> </li>
				</ul>
				
				<ul>
					<li type="circle" > <?echo mysql_result($result,$i,"name"); ?> </li>
					<li type="circle" > <?echo mysql_result($result,$i,"description"); ?> </li>
					<li type="circle" > <?echo mysql_result($result,$i,"price"); ?> </li>
					<li type="circle" > <?echo mysql_result($result,$i,"original"); ?> </li>
					<li type="circle" > <?echo mysql_result($result,$i,"available"); ?> </li>
				
					<li>
						<br>
						<a class="submit" href="manage_product_edit.php?id=<? echo mysql_result($result,$i,"id")?>&n=<? echo mysql_result($result,$i,"name"); ?>&des=<? echo mysql_result($result,$i,"description"); ?>&cat=<? echo mysql_result($result,$i,"category"); ?>&pr=<? echo mysql_result($result,$i,"price"); ?>&av=<? echo mysql_result($result,$i,"available"); ?>&or=<? echo mysql_result($result,$i,"original"); ?>">Edit</a>
						<a class="submit" href="edit_product.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a>
					</li>
				</ul>
				<? } ?>
		
			</td>
						
		</div>
		
		<? include 'footer.php'; ?>
			
			
		