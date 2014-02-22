<?php 
$page='Feedback';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
} 
include 'db_access.php';
include 'header.php';
if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM contact WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete message: ".mysql_error();
	}
}
$veri = "0";
$ver = "1";
$query= "SELECT * FROM contact WHERE veri = '".$veri."' ORDER BY id DESC";
$result=mysql_query($query);
$num=mysql_numrows($result);
$query1= "SELECT * FROM contact WHERE veri = '".$ver."' ORDER BY id DESC";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
mysql_close();
}
?>		
			
<div id="contents">
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="lists">
		<tr>
			<th> First Name </th>
			<th> Last Name </th>
			<th> E-mail </th>
			<th> Message </th>
			<th> Action </th>
		</tr>

		<? $i;
		for ($i=0; $i < $num; $i++){?>
		<tr>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"fname"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"lname"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"email"); ?></a> </td>
			<td><a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"message"); ?></a> </td>
			<td class="button"> 
				<a class="submit" href="feedbacks.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a> 
				</td>
		</tr>
		<? } ?>


		<? $i;
		for ($i=0; $i < $num1; $i++){?>
		<tr>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result1,$i,"id"); ?>"><? echo mysql_result($result1,$i,"fname"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result1,$i,"id"); ?>"><? echo mysql_result($result1,$i,"lname"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result1,$i,"id"); ?>"><? echo mysql_result($result1,$i,"email"); ?></a> </td>
			<td><a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result1,$i,"message"); ?></a> </td>
			<td class="button"> 
				<a class="submit" href="feedbacks.php?del=<? echo mysql_result($result1,$i,"id")?>">Delete</a> 
				</td>
		</tr>
		<? } ?>

	</table>
		<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>