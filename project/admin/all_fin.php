<?php 
$page='All Finished Reservations';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
} 
include 'db_access.php';

if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");


$id = "3";
$query= "SELECT * FROM reservations WHERE status = '".$id."' ORDER BY date desc";
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
	header( 'Location: all_confirm.php' );
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete message: ".mysql_error();
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
			<th> Penalty </th>
			<th> Type </th>
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
			<? $pen =  mysql_result($result,$i,"penalty"); 
				$pers = mysql_result($result,$i,"persons"); 
					$pena="";
					$peni="";
					if ($pen == "1") {
						$pena = "yes";
					}
					if ($pen == "0") {
						$pena = "no";
					}
					if ($pers >= "10"){
						$peni="Function";
					}
					if ($pers <= "9"){
						$peni="Regular";
					}
			?>
			<td> <? echo $pena; ?> </td>
			<td> <? echo $peni; ?> </td>
		</tr>
		<? } ?>
	</table>
	<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>