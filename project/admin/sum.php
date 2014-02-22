<?
$page = "Sum Sample";
include 'db_access.php';
include 'header.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$b = "2014-01-31";
$c = "2014-02-30";
$d = "2";
$query= "SELECT * FROM reservations WHERE rdate like '".$b."' and '".$c."' and status = '".$d."' ";
$result=mysql_query($query);
$num=mysql_numrows($result);

$sql = "select sum(persons) from reservations";
$q = mysql_query($sql);
$row = mysql_fetch_array($q);



?>

<div id="contents">
	<?$i; for ($i=0; $i < $num; $i++) {?>
		<ul>
			<li type="none" style="color:#000;">Reservation Date: <b> <?echo mysql_result($result,$i,"rdate"); ?> </b> </li>
			<li type="none" style="color:#000;">First Name: <b> <?echo mysql_result($result,$i,"fname"); ?>   </b></li>
			<li type="none" style="color:#000;">Last Name: <b> <?echo mysql_result($result,$i,"lname"); ?> </b> </li>
			<li type="none" style="color:#000;">Email: <b> <?echo mysql_result($result,$i,"email"); ?> </b> </li>
			<li type="none" style="color:#000;">Mobile: <b> <?echo mysql_result($result,$i,"mobile"); ?> </b> </li>
		</ul>
		<? } ?>
			<h2> <? echo 'Sum: ' . $row[0]; ?> </h2>
		</div>
		
		
	<? include 'footer.php'; ?>