<?php 
$page='Inventory';
include 'header.php'; 
include 'db_access.php';

$errorMsg="";

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM inventory WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete user: ".mysql_error();
	}
}

$query= "SELECT * FROM inventory";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();

?>		

<div id="contents">
<form class="list" action="reports_inventory.php" method="GET"> 
		<input type="text" name="search" /> 
		<input class="submit" type="submit" value="Search" onClick="goTo();" />
	</form>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="list">
		<tr>
			
			<th> Product Name </th>
			<th> Date </th>
			<th> Total Stocks </th>
			<th> Unit </th>
			<th> Supplier </th>
			<th> Stock Available </th>
			<th> Date Delivered </th>
		</tr>
		<? $i; 
			for ($i=0; $i < $num; $i++){?>
			<tr>
				
				<td> <? echo mysql_result($result,$i,"name"); ?> </td>
				<td> <? echo mysql_result($result,$i,"date"); ?> </td>
				<td> <? echo mysql_result($result,$i,"quantity"); ?> </td>
				<td> <? echo mysql_result($result,$i,"unit"); ?> </td>
				<td> <? echo mysql_result($result,$i,"supplier"); ?> </td>
				<td> <? echo mysql_result($result,$i,"stock_a"); ?> </td>
				<td> <? echo mysql_result($result,$i,"date_delivered"); ?> </td>
				
				</tr>
					
			<? } ?>
		
	</table>
	<br><br>
	<center>
	<? if ($_COOKIE["type"]=="clerk"){ ?>
		<table class="list">
			<tr>
			<td class="button">
					<a class="submit" href="reports_inventory.php">Generate Report</a>
			</td>
			</tr>
		</table>
		<?}?>
	</center>
	<br><br><br>
	<center><a href="add_inventory.php"> <img src="icons/add.png" width="50px;" height="50px;" style="padding-right:10px"> </a> <a href="update_inventory.php"> <img src="icons/edit.png" width="50px;" height="50px;"> </a></center>
	<br>
	</div>

<? include 'footer.php'; ?>