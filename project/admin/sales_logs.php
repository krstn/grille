<?
$page = "Report File";
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$query= "SELECT * FROM sales_log order by id desc ";
$result=mysql_query($query);
$num=mysql_numrows($result);


mysql_close();
include 'header.php';
?>

<div id="contents">
<br>
	<h1 class="pageTitle"> Sales Report Files </h1>
	<table class="lists">
		<tr>
			<th> Report ID </th>
			<th> Date Submitted </th>
			<th> From </th>
			<th> To </th>
			<th> By </th>
			<th> Status </th>		
		</tr>
		<? $i; 
for ($i=0; $i < $num; $i++){
$w = mysql_result($result, $i, "id");
$h = mysql_result($result, $i, "sale_id");
$df = mysql_result($result, $i, "from");
$dt = mysql_result($result, $i, "to");
$dd = mysql_result($result, $i, "filed");
$by = mysql_result($result, $i, "by");
$v = mysql_result($result, $i, "veri");
$new = date("Y-M-d",strtotime($df));	
$news = date("Y-M-d",strtotime($dt));
$newss = date("Y-M-d",strtotime($dd));
if ($v == "0"){
	$ans = "Not Approved";
}
if ($v == "1"){
	$ans = "Approved";
}
?>
		<tr>
			<td> <a href="view_rep.php?ddate=<?echo mysql_result($result,$i,"from")?>&date=<?echo mysql_result($result,$i,"to")?>"><? echo $h; ?> </a> </td>
			<td> <? echo $newss; ?> </td>
			<td> <? echo $new; ?> </td>
			<td> <? echo $news; ?> </td>
			<td> <? echo $by; ?> </td>
			<? if ($ans == "Not Approved") {?>
			<td> <a href="verify_sale.php?id=<?echo $w;?>"><? echo $ans; ?></a> </td>
			<?} else {?>
			<td> <? echo $ans; ?> </td>
			<? } ?>
			</tr>
		<? } ?>		
	</table>
</div>

<? include 'footer.php'; ?>