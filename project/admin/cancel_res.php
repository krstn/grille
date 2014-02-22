<?php 
$page='Reservation Details';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
} 
include 'db_access.php';

if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$id=$_GET['id'];

$query= "SELECT * FROM reservations WHERE id = '".$id."' ";
$result=mysql_query($query);
$num=mysql_numrows($result);
$i; for ($i=0; $i < $num; $i++) {
$ri = mysql_result($result, $i, "rid");
}
$query2= "SELECT * FROM temp_order WHERE rid = '".$ri."' ";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM reservations WHERE id ='". $del . "'";
	header( 'Location: reserve.php' );
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete message: ".mysql_error();
	}
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
			$dompdf->stream(".$page.pdf");
		}
}

}
include 'header.php';
?>		
			
<div id="contents">
	<br>
	<br>
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<? $i; for ($i=0; $i < $num; $i++){
		$g = mysql_result($result,$i,"status");
	
		}
		$k ="";
		if ($g == 0) {
			$k = "Unconfirmed";
		}
		if ($g == 1) {
			$k = "Confirmed";
		}
		if ($g == 2) {
			$k = "Cancelled";
		}
		
	?>
	<div class="subtitle"> Status: <?php echo $k; ?> </div>
	<? $i; for ($i=0; $i < $num; $i++){
		$ty = mysql_result($result,$i,"persons");
	if ($ty >= "9") { ?>
	<div class="subtitle"> Type: Function </div>
	<? } else {?>
	<div class="subtitle"> Type: Regular </div>
	<? } }?>
	<table class="lists">
		<tr>
			<th> First Name </th>
			<th> Last Name </th>
			<th> Address</th>
			<th> Mobile </th>
			<th> E-mail </th>
			<th> Reservation Id </th>
			<th> Date Reserved </th>
			<th> Reservation Date </th>
			<th> Time </th>
			<th> Time End</th>
			<th> Venue </th>
			<th> Pax </th>
			<?
				for ($i=0; $i < $num; $i++){
				$penalty = mysql_result($result,$i,"penalty");
				if ($penalty == "1") {
			?>
			<th> Penalty </th>
			<? } }?>
		</tr>
			<? $i;
		for ($i=0; $i < $num; $i++){
		$date = mysql_result($result,$i,"rdate");
		$new = date("Y-M-d",strtotime($date));
		$sdate = mysql_result($result,$i,"date");
		$news = date("Y-M-d",strtotime($sdate));
		$per = mysql_result($result,$i,"persons");		
		?>
		<tr>
		
			<td> <? echo mysql_result($result,$i,"fname"); ?>  </td>
			<td> <? echo mysql_result($result,$i,"lname"); ?> </td>
			<td><? echo mysql_result($result,$i,"address"); ?></td>
			<td> <? echo mysql_result($result,$i,"mobile"); ?> </td>
			<td> <? echo mysql_result($result,$i,"email"); ?> </td>
			<td> <? echo mysql_result($result,$i,"rid"); ?></td>
			<td> <? echo $news; ?></a> </td>
			<td> <? echo $new; ?></a> </td>
			<td> <? echo mysql_result($result,$i,"time"); ?> </td>
			<td> <? echo mysql_result($result,$i,"t_e"); ?></td>
			<td> <? echo mysql_result($result,$i,"venue"); ?> </td>
			<td> <? echo $per; ?> </td>
			<?
				if ($penalty == "1") {
			?>
			<td> yes </td>
			<? } ?>
		</tr>
	</table>
			<br>
			<br>
			<br>
			<center>
					<?if ($num2 == 0) {?>
					<a href="add_sales.php?id=<?echo mysql_result($result,$i,"rid");?>" class="submit">Add Order</a>
					<?} else {?>
					<a href="orders.php?id=<?echo mysql_result($result,$i,"rid");?>" class="submit">View Pre-Order</a>
					<? } ?>
					<a class="submit" href="done.php?id=<? echo mysql_result($result,$i,"id")?>&rid=<? echo mysql_result($result,$i,"rid")?>">Done</a>
					<?if ($per >= "10") { ?>
					<a class="submit" href="can_res1.php?id=<? echo mysql_result($result,$i,"id")?>">Update Function</a>
					<? } else { ?>
					<a class="submit" href="can_res.php?id=<? echo mysql_result($result,$i,"id")?>">Update</a>
					<?}?>
					<a class="submit" href="can.php?id=<? echo mysql_result($result,$i,"id")?>&rid=<?echo mysql_result($result,$i,"rid")?>">Cancel</a>
					<a class="submit" href="cancel_res.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a>
					
					<? } ?>
					</br>
					</br>
					</br>
					</br>
					</br>
			<a href="#" class="submit"> View Availability Calendar </a>
			</center>
			<br>
			<form method="post" action="cancel_res.php">
	<?
		if(isset($error)) {
			echo $error;
		}
		$hj = date("Y-M-d");
	?>
			<textarea name="content" style="display:none;">
				<center><h1 class="pageTitle"> Reservation Number <?echo $ri;?> </h1></center>
				</br>
				<? for ($i=0; $i < $num; $i++){ 
				$per = mysql_result($result,$i,"persons");
				if ($per >= "10" ){
					$tb = "Function";
				}
				if ($per <= "9" ){
					$tb = "Regular";
				}
				?>
				<h5> Name: <?echo mysql_result($result, $i, "fname");?> <?echo mysql_result($result, $i, "lname");?>  </h5>
				<h5> Address: <?echo mysql_result($result, $i, "address");?> </h5>
				<h5> Mobile: <?echo mysql_result($result, $i, "mobile");?> </h5>
				<h5> E-mail: <?echo mysql_result($result, $i, "email");?> </h5>
				<h5> Type: <?echo $tb; ?> </h5>
				<h3> Status: <?echo $k; ?> </h3>
				<? } ?>
				<center> <h1> Reservation Details </h1> </center>
				<br> <br>
	<table style="font-family:Tahoma;font-size:10px;color:#191919;width:100%;">
		<tr>

			<th style="text-align:center;border:1px dotted #bbb;"> Reservation Id </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Date Reserved </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Reservation Date </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Time </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Time End</th>
			<th style="text-align:center;border:1px dotted #bbb;"> Venue </th>
			<th style="text-align:center;border:1px dotted #bbb;"> Pax </th>
			<?
				for ($i=0; $i < $num; $i++){
				$penalty = mysql_result($result,$i,"penalty");
				$gh = mysql_result($result,$i,"persons");
				 if ($gh >= "10") { if ($penalty == "1") {
			?>
			<th style="text-align:center;border:1px dotted #bbb;"> Penalty </th>
			<? } } }?>
			<? $i;
		for ($i=0; $i < $num; $i++){
		$date = mysql_result($result,$i,"rdate");
		$new = date("Y-M-d",strtotime($date));
		$sdate = mysql_result($result,$i,"date");
		$news = date("Y-M-d",strtotime($sdate));			
		?>
		<tr>
		

			<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"rid"); ?></td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $news; ?></a> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo $new; ?></a> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"time"); ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"t_e"); ?></td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"venue"); ?> </td>
			<td style="text-align:center;border:1px dotted #bbb;"> <? echo mysql_result($result,$i,"persons"); ?> </td>
			<?
				if ($gh >= "10") { if ($penalty == "1") {
			?>
			<td style="text-align:center;border:1px dotted #bbb;"> yes </td>
			<? } }?>
		</tr>
		<? } ?>		
	</table>

			</textarea></br>
			<input type="submit" name="submit" class="submit" value="Print "/>
	</form>
		<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>