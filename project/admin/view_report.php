<?
$page = "Report File";
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");
$id = $_GET['id'];

$query= "SELECT * FROM log where id = '".$id."' order by id desc ";
$result=mysql_query($query);
$num=mysql_numrows($result);

$i; 
for ($i=0; $i < $num; $i++){
$h = mysql_result($result, $i, "log_id");
$df = mysql_result($result, $i, "date_from");
$dt = mysql_result($result, $i, "date_to");
$dd = mysql_result($result, $i, "date_filed");
$by = mysql_result($result, $i, "by");
$v = mysql_result($result, $i, "veri");
$new = date("M-d-Y",strtotime($df));	
$news = date("M-d-Y",strtotime($dt));
$newss = date("M-d-Y",strtotime($dd));
if ($v == "0"){
	$ans = "Not Approved";
}
if ($v == "1"){
	$ans = "Approved";
}
}
$query3= "SELECT * FROM users WHERE username = '".$by."'";
$result3=mysql_query($query3);
$num3=mysql_numrows($result3);
for ($i=0; $i < $num3; $i++){
$kl = mysql_result($result3, $i, "fname");
$lk = mysql_result($result3, $i, "lname");
}
$rr = "SELECT * FROM inventory_logs WHERE date_update BETWEEN '" . $df . "' and '" . $dt . "' order by id desc";
$query2= $rr;
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);

$query5= "SELECT sum(cost) FROM inventory_logs WHERE date_update BETWEEN '" . $df . "' and '" . $dt . "' order by id desc";
$result5=mysql_query($query5);
	while ($row = mysql_fetch_array($result5)){
		$tot = $row['sum(cost)'];
	}

if (isset($_POST['submit'])){
	$content = $_POST['content'];
		if(empty($content)){
			$error ='Please enter some content to create your Pdf';
		}
		else {
			include_once('dompdf/dompdf_config.inc.php');
			$html = '
					<html lang="en">
						<head>
							<title>  Grill Guru </title>
						</head>
						<body>
							<center>
								<h1> <img src="icons/footer_logo.png" style="height:50px; width:50px"/> Grill Guru </h1>
								<p> Kamunsil St., cor. C.L. Montelibano Ave., 6100 Bacolod City </p>
							</center>
							'.$content.'						
						</body>
						</html>';
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream("'.$page.'.pdf");
		}
}		

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
			<th> Cost </th>				
			<th> Last Date Delivery </th>
			<th> Last Date Updated </th>
			<th> Action Taken </th>
		</tr>
<?	$i; for ($i=0; $i < $num2; $i++){
$date = mysql_result($result2,$i,"date_delivered");
$newf = date("Y-M-d",strtotime($date));
$dates = mysql_result($result2,$i,"date_update");
$newd = date("Y-M-d",strtotime($dates));	
$a = mysql_result($result2,$i,"name");
$b = mysql_result($result2,$i,"p_id");
$c = mysql_result($result2,$i,"unit");
$d = mysql_result($result2,$i,"supplier");
$e = mysql_result($result2,$i,"stock_a");
$km = mysql_result($result2,$i,"cost");
$f = mysql_result($result2,$i,"action");
?>
		<tr>
			<td> <? echo $a; ?> </td>
			<td> <? echo $b; ?> </td>
			<td> <? echo $c; ?> </td>
			<td> <? echo $d; ?> </td>
			<td> <? echo $e; ?> </td>
			<td> <? echo $km; ?> </td>
			<td> <? echo $newf; ?> </td>
			<td> <? echo $newd; ?> </td>
			<td> <? echo $f; ?> </td>
			</tr>
		<? } ?>		
	</table>
<h3> TOTAL COST: Php.<?echo $tot;?> </h3>
<br>
<h5> Prepared By: <?echo $kl;?> <?echo $lk;?></h5>
<h5> Date Submitted: <?echo $newss;?></h5>
<h5> Inventory Log From: <?echo $new;?> &nbsp To: <?echo $news;?></h5>
<h5> Remarks: <?echo $ans;?> </h5>


	<form method="post" action="reports_inventory.php">
	<?
		if(isset($error)) {
			echo $error;
		}
		$hj = date("Y-M-d");
	?>
			<textarea name="content" style="display:none;">
				<center><h1 class="pageTitle"> Inventory Report File <?echo $h;?> </h1></center>
				</br>
	<table style="font-family:Tahoma;font-size:12px;color:#191919;width:100%;">
		<tr>
			<th style="text-align:center;border:1px dotted #bbb;"> Product Name </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Product ID </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Unit</th>
			<th style="text-align:center;border:1px dotted #bbb;"> Supplier </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Current Stock </th>	
			<th style="text-align:center;border:1px dotted #bbb;"> Cost </th>			
			<th style="text-align:center;border:1px dotted #bbb;"> Last Date Delivery </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Last Date Updated </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Action Taken </th>
		</tr>
<?	$i; for ($i=0; $i < $num2; $i++){
$date = mysql_result($result2,$i,"date_delivered");
$newf = date("Y-M-d",strtotime($date));
$dates = mysql_result($result2,$i,"date_update");
$newd = date("Y-M-d",strtotime($dates));	
$a = mysql_result($result2,$i,"name");
$b = mysql_result($result2,$i,"p_id");
$c = mysql_result($result2,$i,"unit");
$d = mysql_result($result2,$i,"supplier");
$e = mysql_result($result2,$i,"stock_a");
$km = mysql_result($result2,$i,"cost");
$f = mysql_result($result2,$i,"action");
?>
		<tr>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $a; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $b; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $c; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $d; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $e; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $km; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $newf; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $newd; ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $f; ?> </td>
			</tr>
		<? } ?>		
	</table>
<h3> TOTAL COST: Php.<?echo $tot;?> </h3>
<br>
<h5> Prepared By: <?echo $kl;?> <?echo $lk;?></h5>
<h5> Date Submitted: <?echo $newss;?></h5>
<h5> Inventory Log From: <?echo $new;?>  </h5>
<h5> To: <?echo $news;?></h5>
<h5> Remarks: <?echo $ans;?> </h5>
			</textarea></br>
			<input type="submit" name="submit" class="submit" value="Print "/>
	</form>
</div>

<? include 'footer.php'; ?>