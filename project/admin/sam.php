<?

include 'db_access.php';
 
$showForm=true;
$errorMsg="";

$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
$query1= "SELECT * FROM reservations Where id = 23";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
for ($i=0; $i < $num1; $i++){
echo $f = mysql_result($result1,$i,"date");
echo '<br>';

}
echo '<br>';

$g = date_create($f);
date_sub($g,date_interval_create_from_date_string("3 days"));
$x = date_format($g,"Y-m-d");
echo $x;

echo '<br>';

?>