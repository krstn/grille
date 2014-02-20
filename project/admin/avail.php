<?php 
$page='Room Availability';
include 'header.php'; 
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");
		
$maxi = 4;
$avail = "Available";
$query= "SELECT * FROM rooms WHERE class ='". $avail . "' ORDER BY room ASC";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>		
			
<div id="contents">
	<div class="pageTitle"> <?php echo $page; ?> </div>			
	<div class="subTitle"> Maximum occupants for bedspace room is 4 people. </div>	
	<? $i; for ($i=0; $i < $num; $i++){?>
		<div class="subTitle">Room #<? echo mysql_result($result,$i,"room"); ?></div>
		<ul>
			<li>Available Bedspace: <b><? $results=mysql_result($result,$i,"occ"); $remain = $maxi - $results; echo $remain; ?></b></li>
			<li>Gender: <b><? echo mysql_result($result,$i,"type"); ?></b></li>
		</ul>
	<? } ?>
	<center>
		<a class="submit" href="reservations.php"> Back </a>
	</center>
</div>
<? include 'sidebar.php'; ?>
<? include 'footer.php'; ?>