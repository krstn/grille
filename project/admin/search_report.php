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
$newz = date("Y-M-d",strtotime($dfrom));
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
$rr = "SELECT * FROM sales WHERE date BETWEEN '" . $ddate . "' and '" . $dfrom . "' order by id desc";
$query= $rr;
$result=mysql_query($query);
$num=mysql_numrows($result);

$query9= "SELECT sum(net) FROM sales WHERE date BETWEEN '" . $ddate . "' and '" . $dfrom . "' ";
	$result9=mysql_query($query9);
	
	while ($row = mysql_fetch_array($result9)){
		$tot = $row['sum(net)'];
	}

if (isset ($_POST["submits"])){
	$df = $ddate;
	$dt = $dfrom;
	$date = $_POST['date'];
	$by = $_POST['by'];
	$log = $_POST['log'];
	$veri = $_POST['veri'];
	$query1 = "INSERT INTO sales_log VALUES ('','" . $log . "','" . $by . "','" . $df . "','" . $dt . "','" . $veri . "','" . $date . "')";
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
	<div class="pageTitle"> <?php echo $page; ?> from <?echo $newx ?> to <?echo $newz?> </div>
	<table class="lists">
		
		<tr>
		
			<th> Reservation Id </th>
			<th> Date </th>
			<th> Gross </th>
			<th> Discount </th>
			<th> Net </th>
			<th> Type </th>			
		</tr>
			<tr>
				<? $i; for ($i=0; $i < $num; $i++){
				$date = mysql_result($result,$i,"date");
				$new = date("Y-M-d",strtotime($date));					
				?>
				<td> <? echo mysql_result($result,$i,"rid"); ?> </td>
				<td> <? echo $new; ?> </td>
				<td> <? echo mysql_result($result,$i,"gross"); ?> </td>
				<td> <? echo mysql_result($result,$i,"discount"); ?> </td>
				<td> <? echo mysql_result($result,$i,"net"); ?> </td>
				<td> <? echo mysql_result($result,$i,"type"); ?> </td>
			</tr>
			<? } ?>		
	</table>
	<h3> TOTAL COST: Php. <?echo $tot;?> </h3>
	<form method="post" action="search_report.php">
	<?
		if(isset($error)) {
			echo $error;
		}
		$hj = date("Y-M-d");
	?>
			<textarea name="content" style="display:none;">
				<center><h1> <?php echo $page; ?> from <?echo $newx ?> to <?echo $newz; ?> </h1></center>
	<table style="font-family:Tahoma;font-size:12px;color:#191919;width:100%;">
		<tr>
			<th style="text-align:center;border:1px dotted #bbb;"> Reservation ID </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Date </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Gross </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Discount </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Net </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Type </th>
		</tr>
		<? 
			$i;
			for ($i=0; $i < $num; $i++){
			$date = mysql_result($result,$i,"date");
			$new = date("Y-M-d",strtotime($date));	
			?>
			<tr>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"rid"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo $new;?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"gross"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"discount"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"net"); ?> </td>
				<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"type"); ?> </td>

				</tr>	
			<? } ?>
	</table>
	<h3> TOTAL COST: Php. <?echo $tot;?> </h3>
			<h4> Prepared By: <?echo $fname;?>  <?echo $lname;?> </h4>
			</textarea></br>
			<input type="submit" name="submit" class="submit" value="Print "/>
	</form>
	<br>
	<center>
	<?php if ($showForm==true){ ?>
		<form method="post" action="search_report.php?ddate=<?echo $ddate?>&date=<?echo $dfrom?>">
			<input type="text" name="log" value="<?echo rand() ."\n";?>" style="display:none;"/>
			<? if ($_COOKIE["type"]=="bookkeeper"){ ?>
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
					
					<a class="submit" href="sales_logs.php"> OK </a>
				</center>
			<? } ?>
	
	
</div>

<? include 'footer.php'; ?>