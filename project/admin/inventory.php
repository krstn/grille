<?php 
$page='Inventory';
 
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

$query= "SELECT * FROM inventory order by id desc";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
include 'header.php';
?>		

<div id="contents">
<?if($login==true){ if ($_COOKIE['type'] == "admin" || $_COOKIE['type'] == "clerk") { ?>
<br>
	<form class="lists" action="search_inven.php" method="GET">
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
			<th> Stock Available </th>
			<th> Date Delivered </th>
			<th> Action </th>
			
		</tr>
		<? $i; 
			for ($i=0; $i < $num; $i++){
			$date = mysql_result($result,$i,"date_delivered");
			$new = date("Y-M-d",strtotime($date));	
			$quan = mysql_result($result,$i,"stock_a");
			?>
			<tr>
				
				<td> <? echo mysql_result($result,$i,"name"); ?> </td>
				<td> <? echo mysql_result($result,$i,"pid"); ?> </td>
				<td> <? echo mysql_result($result,$i,"unit"); ?> </td>
				<td> <? echo mysql_result($result,$i,"supplier"); ?> </td>
				<?if ($quan <= "5") {?>
				<td style="color:red;" > <? echo $quan;  ?> </td>
				<? } else { ?>
				<td  > <? echo $quan;  ?> </td>
				<? } ?>
				<td> <? echo  $new; ?> </td>
				<td class="button"> 
				<a class="submit" href="update_inventory.php?id=<? echo mysql_result($result,$i,"id")?>&pid=<? echo mysql_result($result,$i,"pid")?>">Update</a> 
				<a class="submit" href="inventory.php?del=<? echo mysql_result($result,$i,"id")?>" >Delete</a> 
				</td>
				</tr>	
			<? } ?>
	</table>
	</br>
	<?if ($_COOKIE['type'] == "admin" || $_COOKIE['type'] == "clerk") { ?>
	<a href="add_inventory.php" > add inventory item </a> </br>
	<a href="inventory_logs.php" > view inventory logs </a> </br>
	<a href="logs.php" > view inventory reports </a>
	<? } ?>
		 <form method="post" action="inventory.php">
		
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
			<th style="text-align:center;padding:5px;border:1px dotted #bbb;"> Product Name </th>
			<th style="text-align:center;padding:5px;border:1px dotted #bbb;"> Product ID </th>
			<th style="text-align:center;padding:5px;border:1px dotted #bbb;"> Unit </th>
			<th style="text-align:center;padding:5px;border:1px dotted #bbb;"> Supplier </th>
			<th style="text-align:center;padding:5px;border:1px dotted #bbb;"> Stock Available </th>
			<th style="text-align:center;padding:5px;border:1px dotted #bbb;"> Date Delivered </th>
		</tr>
		<? $i; 
			for ($i=0; $i < $num; $i++){
			$date = mysql_result($result,$i,"date_delivered");
			$new = date("Y-M-d",strtotime($date));	
			?>
			<tr>
				<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"name"); ?> </td>
				<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"pid"); ?> </td>
				<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"unit"); ?> </td>
				<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"supplier"); ?> </td>
				<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"stock_a"); ?> </td>
				<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo $new; ?> </td>
				</tr>	
			<? } ?>
	</table>				
			</textarea></br>
			<input type="submit" name="submit" class="submit" value="Print "/>
	</form>
	<br>
	<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
	</div>

<? include 'footer.php'; ?>