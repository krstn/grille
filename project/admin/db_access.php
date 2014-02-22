<?
$timezone = "Asia/Manila";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

$dbUser="root";
$dbPass="";
$dbName="grille";
$dbHost=("127.0.0.1");

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database.");
?>