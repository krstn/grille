<?php 
$page='Messages';
include 'header.php'; 
include 'db_access.php';

$errorMsg="";
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
}
if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM messages WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete user: ".mysql_error();
	}
}
$admin = "clerk";

$query2= "SELECT * FROM users where type = '".$admin."'";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
for ($i=0; $i < $num2; $i++){
$r = mysql_result($result2,$i,"fname");
$c = mysql_result($result2,$i,"lname");
}
$query3= "SELECT * FROM messages WHERE fname = '".$r."' and lname = '".$c."'  ";
$result3=mysql_query($query3);
$num3=mysql_numrows($result3);
mysql_close();
}
?>		
<div id="contents">
<? if($login==true){  ?>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="lists">
		<tr>
			<th> Sender </th>
			<th> Subject </th>
			<th> Message </th>
			<th> Date Sent </th>
			<th> Action </th>

		</tr>
		<? $i; 
			for ($i=0; $i < $num3; $i++){
			$sdate = mysql_result($result3,$i,"date");
		$news = date("Y-M-d",strtotime($sdate));?>
			<tr>
			
				<td> <a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><?echo mysql_result($result3,$i,"sender"); ?></a> </td>
				<td><a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><?echo mysql_result($result3,$i,"subject"); ?> </a></td>
				<td  ><a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red;" ><p> <? echo mysql_result($result3,$i,"message"); ?></p></a></td>
				<td><a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><?echo $news; ?>,<?echo mysql_result($result3,$i,"time"); ?> </a></td>
				
				
				
				<td class="button">
				<a class="submit" href="msg1.php">Reply</a>
				<a class="submit" href="inbox_clerk.php?del=<? echo mysql_result($result3,$i,"id")?>">Delete</a> 
				</td>
			</tr>
			<? } ?>

	</table>
		
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>