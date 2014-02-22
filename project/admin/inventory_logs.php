<?php 
$page='Inventory Log Files';
 
include 'db_access.php';

$errorMsg="";


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");
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
if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM inventory WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete user: ".mysql_error();
	}
}

$query= "SELECT * FROM inventory_logs order by id desc";
$result=mysql_query($query);
$num=mysql_numrows($result);

$query5= "SELECT sum(cost) FROM inventory_logs order by id desc";
$result5=mysql_query($query5);
	while ($row = mysql_fetch_array($result5)){
		$tot = $row['sum(cost)'];
	}
	
mysql_close();
include 'header.php';
?>		

<div id="contents">
<br>
	<form class="lists" action="search_inven_log.php" method="GET">
	<input type="text" name="search" />	
		<input class="submit" type="submit" value="Search" onClick="goTo();" />
	</form>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<table class="lists">
		<tr>
			
			<th> Product Name </th>
			<th> Product ID </th>
			<th> Unit </th>
			<th> Supplier </th>
			<th> Quantity </th>
			<th> Cost </th>
			<th> Date Updated </th>
			<th> Action </th>
			
		</tr>
		<? $i; 
			for ($i=0; $i < $num; $i++){
			$date = mysql_result($result,$i,"date_delivered");
			$new = date("Y-M-d",strtotime($date));
			$dates = mysql_result($result,$i,"date_update");
			$news = date("Y-M-d",strtotime($dates));
			$quan = mysql_result($result,$i,"stock_a");			
			?>
			<tr>
				
				<td> <? echo mysql_result($result,$i,"name"); ?> </td>
				<td> <? echo mysql_result($result,$i,"p_id"); ?> </td>
				<td> <? echo mysql_result($result,$i,"unit"); ?> </td>
				<td> <? echo mysql_result($result,$i,"supplier"); ?> </td>
				<?if ($quan <= "5") {?>
				<td style="color:red;" > <? echo $quan;  ?> </td>
				<? } else { ?>
				<td  > <? echo $quan;  ?> </td>
				<? } ?>
				<td> <? echo mysql_result($result,$i,"cost"); ?> </td>

				<td> <? echo  $news; ?> </td>
				
				<td> <? echo mysql_result($result,$i,"action"); ?> </td>
				</tr>	
			<? } ?>
	</table>
	<h3> TOTAL COST: Php.<?echo $tot;?> </h3>
		 <form method="post" action="inventory_logs.php">
	<?
		if(isset($error)) {
			echo $error;
		}
		$hj = date("Y-M-d");
	?>
			<textarea name="content" style="display:none;">
				<center><h1> <?php echo $page; ?> as of <?echo $hj;?> </h1></center>
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
		<? $i; 
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
			</textarea></br>
			<input type="submit" name="submit" class="submit" value="Print "/>
	</form>
	<br><br>

	<? if ($_COOKIE["type"]!="customer" || $_COOKIE["type"] != "bookkeeper"){ ?>
		<form class="lists" action="reports_inventory.php" method="GET">
		<h2 style="background-color:#000; color:#fff; width:15%;text-align:center;border-radius:.3em;padding:2px;"> Generate Report </h2>
	<table>
		<tr>
			<td>Date From:</td>
			<td> <?include 'exa.html';?> </td>
		</tr>
		<tr>
			<td>Date To:</td>
			<td> <input type="text" name="date" value="" style="width:150px"/> </td>
		</tr>
	
	</table>
		<input class="submit" type="submit" value="generate" onClick="goTo();" />
	</form>
		<?}?>
		

	<br><br><br>
	
	<br>
	</div>

<? include 'footer.php'; ?>