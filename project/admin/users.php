<?php 
$page='Users';
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
$veri = "admin";
$gg = "1";
$query= "SELECT * FROM users WHERE type != '".$veri."' and verify = '".$gg."'  ORDER BY type asc";
$result=mysql_query($query);
$num=mysql_numrows($result);

mysql_close();
}
?>		
			
<div id="contents">
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<br>
	<form class="lists" action="search_tab.php" method="GET">
	<input type="text" name="search" />	
		<input class="submit" type="submit" value="Search" onClick="goTo();" />
	</form>

	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="lists">
		<tr>
			<th> First Name </th>
			<th> Last Name </th>
			<th> E-mail </th>
			<th> Type </th>
			<th> Action </th>
		</tr>

		<? $i;
		for ($i=0; $i < $num; $i++){?>
		<tr>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"fname"); ?></a> </td>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"lname"); ?></a> </td>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"email"); ?></a> </td>
			<td> <a href="view_use.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result,$i,"type"); ?></a> </td>
			
			<td class="button"> 
				<a class="submit" href="users.php?del=<? echo mysql_result($result,$i,"id")?>">Deactivate and Delete</a>
				<a class="submit" href="msg.php?id=<? echo mysql_result($result,$i,"username");?>">Send Message</a>
				</td>
		</tr>
		<? } ?>
	</table>
	</br>
					<center> <h2 class="subtitle"> <a href="retrieve.php"> Retrieve Passwords </a> </h2> </center>
		<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>