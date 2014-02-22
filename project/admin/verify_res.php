<?php 
$page='Reservation Details';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
} 
include 'db_access.php';
include 'header.php';
if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$id=$_GET['id'];

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM reservations WHERE id ='". $del . "'";
	header( 'Location: reserve.php' );
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete message: ".mysql_error();
	}
}


$query= "SELECT * FROM reservations WHERE id = '".$id."' ";
$result=mysql_query($query);
$num=mysql_numrows($result);

}
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
	if ($ty >= "10") { ?>
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
			<th> Time End </th>
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
		?>
		<tr>
		
			<td> <? echo mysql_result($result,$i,"fname"); ?>  </td>
			<td> <? echo mysql_result($result,$i,"lname"); ?></td>
			<td> <? echo mysql_result($result,$i,"address"); ?></td>
			<td> <? echo mysql_result($result,$i,"mobile"); ?></td>
			<td> <? echo mysql_result($result,$i,"email"); ?> </td>
			<td> <? echo mysql_result($result,$i,"rid"); ?></td>
			<td> <? echo $news; ?></td>
			<td> <? echo $new; ?></td>
			<td> <? echo mysql_result($result,$i,"time"); ?> </td>
			<td> <? echo mysql_result($result,$i,"t_e"); ?> </td>
			<td> <? echo mysql_result($result,$i,"venue"); ?></td>
			<td> <? echo mysql_result($result,$i,"persons"); ?> </td>
			<?
				if ($penalty == "1") {
			?>
			<td> yes</a> </td>
			<? } ?>
		</tr>
		
	</table>
			
			<br>
			<br>
			<br>
			<center>
			<? $g = mysql_result($result, $i, "rdate");
					$h = date("Y-m-d");
					if ($h <= $g) {
					
				?>
				<a class="submit" href="verify.php?id=<? echo mysql_result($result,$i,"id")?>">Verify</a>
				<a class="submit" href="reject.php?id=<? echo mysql_result($result,$i,"id")?>">Ignore</a>
				<? } else {?>
				 <a class="submit" href="verify_res.php?del=<? echo mysql_result($result,$i,"id")?>">Ignore</a> 
				 <?}?>
				 </br>
				 </br>
				 </br>
				 </br>
				 
				 <? } ?>
			<a href="#" class="submit"> View Availability Calendar </a>
			</center>
			<br>
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
		<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>