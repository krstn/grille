<?php 
$page='Feedback';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
} 
include 'db_access.php';
include 'header.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM contact WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete message: ".mysql_error();
	}
}

$query= "SELECT * FROM contact";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>		
			
<div id="contents">
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="list">
		<tr>
			<th> First Name </th>
			<th> Last Name </th>
			<th> E-mail </th>
			<th> Message </th>
		</tr>
		<? $i;
		for ($i=0; $i < $num; $i++){?>
		<tr>
			<td> <? echo mysql_result($result,$i,"fname"); ?> </td>
			<td> <? echo mysql_result($result,$i,"lname"); ?> </td>
			<td> <? echo mysql_result($result,$i,"email"); ?> </td>
			<td> <? echo mysql_result($result,$i,"message"); ?> </td>
			<td class="button"> 
				<a class="submit" href="feedback_reply.php?fname=<? echo mysql_result($result,$i,"fname")?>&lname=<? echo mysql_result($result,$i,"lname")?>">Reply</a>
				<a class="submit" href="feedback.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a> 
				</td>
		</tr>
		<? } ?>
	</table>
</div>
<? include 'sidebar.php'; ?>
<? include 'footer.php'; ?>