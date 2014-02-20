<?php 
$page='trial';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
}
include "header.php";
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$user = $_COOKIE["user"];
$sql = "SELECT * FROM users WHERE username = '".$user."' ";
$result1=mysql_query($sql);
$num1=mysql_numrows($result1);
$i;
for ($i = 0; $i < $num1; $i++) {
$f = mysql_result($result1,$i,"fname");
$l = mysql_result($result1,$i,"lname");
}




$query= "SELECT * FROM payments WHERE fname = '".$f."' AND lname = '".$l."' ";
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
			<th> Room # </th>
			<th> Additionals </th>
			<th> Additionals </th>
			<th> Additionals </th>
			<th> Description </th>
			<th> Amount </th>
			<th> Year </th>
			<th> Month </th>
			<th> Day </th>
			
		</tr>
		<? $i;
		for ($i=0; $i < $num; $i++){?>
		<tr>
			<td> <? echo mysql_result($result,$i,"fname"); ?> </td>
			<td> <? echo mysql_result($result,$i,"lname"); ?> </td>
			<td> <? echo mysql_result($result,$i,"room"); ?> </td>
			<td> <? echo mysql_result($result,$i,"addon1"); ?> </td>
			<td> <? echo mysql_result($result,$i,"addon2"); ?> </td>
			<td> <? echo mysql_result($result,$i,"addon3"); ?> </td>
			<td> <? echo mysql_result($result,$i,"message"); ?> </td>
			<td> <? echo mysql_result($result,$i,"amount"); ?> </td>
			<td> <? echo mysql_result($result,$i,"year"); ?> </td>
			<td> <? echo mysql_result($result,$i,"month"); ?> </td>
			<td> <? echo mysql_result($result,$i,"day"); ?> </td>
		</tr>
		<? } ?>
	</table>
			</div>
			<? include 'sidebar.php'; ?>
			<? include 'footer.php'; ?>
			