<?php 
$page='Inventory Report';
include 'db_access.php';
$showForm=true;
$errorMsg="";


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$ddate = $_GET['ddate'];
$dfrom = $_GET['date'];
$newx = date("Y-M-d",strtotime($ddate));

$hk = $_COOKIE['user'];
			$query2= "SELECT * FROM users WHERE username = '" . $hk . "'";
			$result2=mysql_query($query2);
			$num2=mysql_numrows($result2);
			$i; 
			for ($i=0; $i < $num2; $i++){
				$fname = mysql_result($result2,$i, "fname");
				$lname = mysql_result($result2,$i, "lname");
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
			$dompdf->stream('Order.pdf');
		}
}
$rr = "SELECT * FROM inventory_logs WHERE date_update BETWEEN '" . $ddate . "' and '" . $dfrom . "' order by id desc";
$query= $rr;
$result=mysql_query($query);
$num=mysql_numrows($result);

$query5= "SELECT sum(cost) FROM inventory_logs WHERE date_update BETWEEN '" . $ddate . "' and '" . $dfrom . "' order by id desc";
$result5=mysql_query($query5);
	while ($row = mysql_fetch_array($result5)){
		$tot = $row['sum(cost)'];
	}
if (isset ($_POST["submits"])){
	$df = $ddate;
	$dt = $dfrom;
	$date = $_POST['date'];
	$by = $_POST['by'];
	$log = $_POST['log'];
	$veri = $_POST['veri'];
	$query1 = "INSERT INTO log VALUES ('','" . $date . "','" . $by . "','" . $log . "','" . $veri . "','" . $df . "','" . $dt . "')";
		if (!mysql_query($query1,$con)){
			$errorMsg="Cannot proceed with adding inventory: ".mysql_error();
		}
		else $showForm=false;
		mysql_close();
	
}

include 'header.php'; 
?>		
<div id="contents">
	<form class="list" action="search_inven_log.php" method="GET"> 
		<input type="text" name="search" /> 
		<input class="submit" type="submit" value="Search" onClick="goTo();" />
	</form>
	<div class="pageTitle"> <?php echo $page; ?> from <?echo $newx ?> to <?echo $dfrom?> </div>
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
			<tr>
				<? $i; for ($i=0; $i < $num; $i++){
				$date = mysql_result($result,$i,"date_delivered");
				$new = date("Y-M-d",strtotime($date));
				$dates = mysql_result($result,$i,"date_update");
				$news = date("Y-M-d",strtotime($dates));					
				?>
				<td> <? echo mysql_result($result,$i,"name"); ?> </td>
				<td> <? echo mysql_result($result,$i,"p_id"); ?> </td>
				<td> <? echo mysql_result($result,$i,"unit"); ?> </td>
				<td> <? echo mysql_result($result,$i,"supplier"); ?> </td>
				<td> <? echo mysql_result($result,$i,"stock_a"); ?> </td>
				<td> <? echo mysql_result($result,$i,"cost"); ?> </td>
				<td> <? echo $new; ?> </td>
				<td> <? echo $news; ?> </td>
				<td> <? echo mysql_result($result,$i,"action"); ?> </td>
			</tr>
			<? } ?>		
	</table>
	<h3> TOTAL COST: Php.<?echo $tot;?> </h3>
	<form method="post" action="reports_inventory.php">
	<?
		if(isset($error)) {
			echo $error;
		}
		$hj = date("Y-M-d");
	?>
			<textarea name="content" style="display:none;">
				<center><h1> <?php echo $page; ?> from <?echo $newx ?> to <?echo date("Y-M-d")?> </h1></center>
	<table style="font-family:Tahoma;font-size:12px;color:#191919;width:100%;">
		<tr>
			<th style="text-align:center;border:1px dotted #bbb;"> Product Name </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Product ID </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Unit </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Supplier </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Stock Available </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Cost </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Date Delivered </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Date Updated </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Action </th>
		</tr>
		<? 
			$i;
			for ($i=0; $i < $num; $i++){
			$date = mysql_result($result,$i,"date_delivered");
			$new = date("Y-M-d",strtotime($date));	
			$dates = mysql_result($result,$i,"date_update");
			$news = date("Y-M-d",strtotime($dates));
			?>
			<tr>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"name"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"p_id"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"unit"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"supplier"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"stock_a"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"cost"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo $new; ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo $news; ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"action"); ?> </td>
				</tr>	
			<? } ?>
	</table>
	<h3> TOTAL COST: Php.<?echo $tot;?> </h3>
			<h4> Prepared By: <?echo $fname;?>  <?echo $lname;?> </h4>
			</textarea></br>
			<input type="submit" name="submit" class="submit" value="Print "/>
	</form>
	<br>
	<center>
	<?php if ($showForm==true){ ?>
		<form method="post" action="reports_inventory.php?ddate=<?echo $ddate?>&date=<?echo $dfrom?>">
			<input type="text" name="log" value="<?echo rand() ."\n";?>" style="display:none;"/>
			<? if ($_COOKIE["type"]=="clerk"){ ?>
			<input type="text" name="veri" value="0" style="display:none;" />
			<? } ?>
			<? if ($_COOKIE["type"]=="admin"){ ?>
			<input type="text" name="veri" value="1"  style="display:none;"/>
			<? } ?>
			<input type="text" name="date" value="<?echo date("Y-m-d")?>" style="display:none;"/>
			<input type="text" name="by" value="<?echo $_COOKIE['user'];?>" style="display:none;"/>
			<input type="submit" class="submit" name="submits" value="Save" />
		</form>
		<?php } else { ?>
				<center>
					<div class="info"> Report Successfully Saved. </div>
					
					<a class="submit" href="logs.php"> OK </a>
				</center>
			<? } ?>
	
	
</div>

<? include 'footer.php'; ?>