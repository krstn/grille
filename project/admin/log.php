<?
$page = "Report File";
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$query= "SELECT * FROM log order by id desc ";
$result=mysql_query($query);
$num=mysql_numrows($result);
$i; 
for ($i=0; $i < $num; $i++){
$g = mysql_result($result, $i, "id");
$h = mysql_result($result, $i, "log_id");
$df = mysql_result($result, $i, "date_from");
$dt = mysql_result($result, $i, "date_to");
$v = mysql_result($result, $i, "veri");
}
$rr = "SELECT * FROM inventory_logs WHERE date_update BETWEEN '" . $df . "' and '" . $dt . "' order by id desc";
$query2= $rr;
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
			

mysql_close();
include 'header.php';
?>

<div id="contents">
<br>
	<h1 class="pageTitle"> Inventory Report File <?echo $h;?> </h1>
	<table class="lists">
		<tr>
			<th> Product Name </th>
			<th> Product ID </th>
			<th> Unit</th>
			<th> Supplier </th>
			<th> Current Stock </th>		
			<th> Last Date Delivery </th>
			<th> Last Date Updated </th>
			<th> Action Taken </th>
		</tr>
<?	$i; for ($i=0; $i < $num2; $i++){
$date = mysql_result($result2,$i,"date_delivered");
$new = date("Y-M-d",strtotime($date));
$dates = mysql_result($result2,$i,"date_update");
$news = date("Y-M-d",strtotime($dates));	
$a = mysql_result($result2,$i,"name");
$b = mysql_result($result2,$i,"p_id");
$c = mysql_result($result2,$i,"unit");
$d = mysql_result($result2,$i,"supplier");
$e = mysql_result($result2,$i,"stock_a");
$f = mysql_result($result2,$i,"action");
?>
		<tr>
			<td> <? echo $a; ?> </td>
			<td> <? echo $b; ?> </td>
			<td> <? echo $c; ?> </td>
			<td> <? echo $d; ?> </td>
			<td> <? echo $e; ?> </td>
			<td> <? echo $new; ?> </td>
			<td> <? echo $news; ?> </td>
			<td> <? echo $f; ?> </td>
			</tr>
		<? } ?>		
	</table>
</div>

<? include 'footer.php'; ?>