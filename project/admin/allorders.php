<?php 
$page='Orders';
include 'header.php';
include 'db_access.php';

$showForm=true;
$errorMsg="";
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if ($login == true) {

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM contact WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete message: ".mysql_error();
	}
}

$z = "0";
$y="1";
$x="2";


$query4= "SELECT * FROM reservations";
$result4=mysql_query($query4);
$num4=mysql_numrows($result4);

$query= "SELECT * FROM temp_order WHERE veri =  '".$z."' ORDER BY date asc  ;";
$result=mysql_query($query);
$num=mysql_numrows($result);
$query2= "SELECT * FROM temp_order WHERE veri =  '".$y."' ORDER BY date asc  ;";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
$query3= "SELECT * FROM temp_order WHERE veri =  '".$x."' ORDER BY date asc  ;";
$result3=mysql_query($query3);
$num3=mysql_numrows($result3);




mysql_close();
}	
?>
		
		<div id="contents">
		<? if ($login == true) {
		?>
		<br>
		<center>
		<a class="submit" href="#"> View Availability Calendar </a>
		</center>
		
		<table style="margin:15px;padding:10px;vertical-align:center;">
			<tr >
				<td style="width:10%; padding:10px; border:1px solid #ddd;">
		<div class="pageTitle" >Unverified Order </div>
		<?$i; for ($i=0; $i < $num; $i++) {?>
			<h3> <b style="color:#000;"> Order Id: <a href="verify_res.php?id=<? echo mysql_result($result,$i,"id")?>"> <? echo mysql_result($result,$i,"rid"); ?></a> </b> </h3>
							
									<br />	
					<? } ?>
			</td>			
			<td style="width:10%; padding:10px;border:1px solid #ddd;">
			
				<div class="pageTitle"> Verified Order </div>
		<?$i; for ($i=0; $i < $num2; $i++) {?>
							<h3> <b style="color:#000;"> Order Id: <a href="cancel_res.php?id=<? echo mysql_result($result2,$i,"id")?>"> <? echo mysql_result($result2,$i,"rid"); ?> </a> </b> </h3>
							<ul>
								<li type="none" style="color:#000;">Reservation Date: <b> <?echo mysql_result($result2,$i,"starters"); ?> </b> </li>
								<li type="none" style="color:#000;">First Name: <b> <?echo mysql_result($result2,$i,"main"); ?>   </b></li>
								<li type="none" style="color:#000;">Last Name: <b> <?echo mysql_result($result2,$i,"des"); ?> </b> </li>
								<li type="none" style="color:#000;">Email: <b> <?echo mysql_result($result2,$i,"dri"); ?> </b> </li>
								<li type="none" style="color:#000;">Mobile: <b> <?echo mysql_result($result2,$i,"total"); ?> </b> </li>
							
							</ul>


						<br />
							<? } ?>
							</td>
							<td style="width:10%;padding:10px;border:1px solid #ddd;">
			
				<div class="pageTitle"> Order Order </div>
		<?$i; for ($i=0; $i < $num3; $i++) {?>
							<h3> <b style="color:#000;"> Reservation Id: <a href="reactivate_res.php?id=<? echo mysql_result($result3,$i,"id")?>"> <? echo mysql_result($result3,$i,"rid"); ?> </a> </b> </h3>
							<ul>
								<li type="none" style="color:#000;">Reservation Date: <b> <?echo mysql_result($result3,$i,"starters"); ?> </b> </li>
								<li type="none" style="color:#000;">First Name: <b> <?echo mysql_result($result3,$i,"main"); ?>   </b></li>
								<li type="none" style="color:#000;">Last Name: <b> <?echo mysql_result($result3,$i,"des"); ?> </b> </li>
								<li type="none" style="color:#000;">Email: <b> <?echo mysql_result($result3,$i,"dri"); ?> </b> </li>
								<li type="none" style="color:#000;">Mobile: <b> <?echo mysql_result($result3,$i,"total"); ?> </b> </li>
								
							</ul>
							
						<br />
							<? } ?>
							</td>
			</tr>
			</table>
			
				<? } else { ?>
				
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
		</div>
		
		<? include 'footer.php'; ?>
		