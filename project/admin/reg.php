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
	$delete="DELETE FROM users WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete message: ".mysql_error();
	}
}
$veri = "0";

$query= "SELECT * FROM users WHERE verify = '".$veri."' ORDER BY id DESC";
$result=mysql_query($query);
$num=mysql_numrows($result);

}
?>		
			
<div id="contents">
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="lists">
		<tr>
			<th> First Name </th>
			<th> Last Name </th>
			<th> Address</th>
			<th> Mobile </th>
			<th> E-mail </th>
			<th>Action</th>
		</tr>

		<? $i;
		for ($i=0; $i < $num; $i++){?>
		<tr>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"gender"); ?> <? echo mysql_result($result,$i,"fname"); ?></a> </td>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"lname"); ?></a> </td>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"address"); ?></a> </td>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"mobile"); ?></a> </td>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"email"); ?></a> </td>
			
			<td class="button">
				<a class="submit" href="verify_user.php?id=<? echo mysql_result($result,$i,"id")?>">Verify</a> 
				<a class="submit" href="reg.php?del=<? echo mysql_result($result,$i,"id")?>">Ignore</a> 
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