<?php 
$page='Registrations';
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
$veri = "1";

$query= "SELECT * FROM users WHERE verify = '".$veri."' ORDER BY type ASC";
$result=mysql_query($query);
$num=mysql_numrows($result);

}
?>		
			
<div id="contents">
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="list">
		<tr>
			<th> First Name </th>
			<th> Last Name </th>
			<th> Username</th>
			<th> Password </th>
			<th> Type </th>

		</tr>

		<? $i;
		for ($i=0; $i < $num; $i++){?>
		<tr>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"gender"); ?> <? echo mysql_result($result,$i,"fname"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"lname"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"username"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"password"); ?></a> </td>
			<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"type"); ?></a> </td>

		</tr>
		<? } ?>
	</table>
		</br>
					<center> <h2 class="subtitle"> <a href="users.php"> Go Back </a> </h2> </center>

		<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>