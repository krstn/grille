<?
 
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");

$showForm=true;
$errorMsg="";

$id = "32404";
$query9= "SELECT sum(total) FROM temp_order WHERE rid = '".$id."' ";
$result9=mysql_query($query9);
$num9=mysql_numrows($result9);

$tot = $num9[0];
echo $tot
?>

