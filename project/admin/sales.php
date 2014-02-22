<?php 
$page='Sales';
 
include 'db_access.php';

$errorMsg="";


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM sales WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete user: ".mysql_error();
	}
}

$query= "SELECT * FROM sales order by id desc";
$result=mysql_query($query);
$num=mysql_numrows($result);


$query9= "SELECT sum(gross) FROM sales";
	$result9=mysql_query($query9);
	
	while ($row = mysql_fetch_array($result9)){
		$tot = $row['sum(gross)'];
	}
$query8= "SELECT sum(discount) FROM sales";
$result8=mysql_query($query8);
	
	while ($row = mysql_fetch_array($result8)){
		$tots = $row['sum(discount)'];
	}
$query7= "SELECT sum(net) FROM sales";
$result7=mysql_query($query7);
	
	while ($row = mysql_fetch_array($result7)){
		$totz = $row['sum(net)'];
	}
mysql_close();
	
include 'header.php';
?>		

<div id="contents">
<?if($login==true){ if ($_COOKIE['type'] == "admin" || $_COOKIE['type'] == "bookkeeper") { ?>
<br>
	<form class="lists" action="search_sales.php" method="GET">
	<input type="text" name="search" />	
		<input class="submit" type="submit" value="Search" onClick="goTo();" />
	</form>
	<div class="pageTitle"> Transaction Summary </div>
	<table class="lists">
		<tr>
			
			<th> Reservation Number </th>
			<th> Gross Total </th>
			<th> Discount </th>
			<th> Net Total </th>
			<th> Reservation Type </th>
			<th> Date </th>
			<th> Action </th>
			
		</tr>
		<? $i; 
			for ($i=0; $i < $num; $i++){
			$date = mysql_result($result,$i,"date");
			$new = date("Y-M-d",strtotime($date));	
			?>
			<tr>
				
				<td><a href="view_transac.php?id=<?echo mysql_result($result,$i,"rid");?>"> <? echo mysql_result($result,$i,"rid"); ?></a> </td>
				<td> <? echo mysql_result($result,$i,"gross"); ?> </td>
				<td> <? echo mysql_result($result,$i,"discount"); ?> </td>
				<td> <? echo mysql_result($result,$i,"net"); ?> </td>
				<td> <? echo mysql_result($result,$i,"type"); ?> </td>
				<td> <? echo  $new; ?> </td>
				<td class="button"> 
				
				<a class="submit" href="sales.php?del=<? echo mysql_result($result,$i,"id")?>" >Delete</a> 
				</td>
				</tr>	
			<? } ?>
			<tr>
				<th style="color:red;">Total</th>
				<th style="color:red;"> <?echo $tot;?> </th>
				<th style="color:red;"> <?echo $tots;?> </th>
				<th style="color:red;"> <?echo $totz;?> </th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
	</table>
	
	</br>
		<a href="sales_logs.php"> view sales logs </a>
	</br>
	</br>
	<?if ($_COOKIE['type'] == "admin" || $_COOKIE['type'] == "bookkeeper") { ?>
	<form class="lists" action="search_report.php" method="GET">
		<h2 style="background-color:#000; color:#fff; width:15%;text-align:center;border-radius:.3em;padding:2px;"> Generate Report </h2>
	<table>
		<tr>
			<td>Date From:</td>
			<td> <?include 'exa.html';?> </td>
		</tr>
		<tr>
			<td>Date To:</td>
			<td> <input type="text" name="date" value="" style="width:150px"/> </td>
		</tr>
	
	</table>
		<input class="submit" type="submit" value="generate" onClick="goTo();" />
	</form>
		<?}?>
		
	<br>
	<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
	</div>

<? include 'footer.php'; ?>