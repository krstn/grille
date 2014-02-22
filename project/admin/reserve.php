<?php 
$page='Reservations';
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
$b="3";
$type = "10";
$query= "SELECT * FROM reservations WHERE status =  '".$z."' ORDER BY date asc LIMIT 3;";
$result=mysql_query($query);
$num=mysql_numrows($result);
$query2= "SELECT * FROM reservations WHERE status =  '".$y."' ORDER BY date asc  LIMIT 3;";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
$query3= "SELECT * FROM reservations WHERE status =  '".$x."' ORDER BY date asc  LIMIT 3;";
$result3=mysql_query($query3);
$num3=mysql_numrows($result3);
$query4= "SELECT * FROM reservations WHERE status =  '".$b."' ORDER BY date asc  LIMIT 3;";
$result4=mysql_query($query4);
$num4=mysql_numrows($result4);
mysql_close();
}	
?>
		
		<div id="contents">
		<? if ($login == true) { if ($_COOKIE['type'] == "admin" || $_COOKIE['type'] == "bookkeeper") { ?>
		<br>
	<form  action="search_res.php" method="GET">
	<input type="text" name="search" />	
		<input class="submit" type="submit" value="Search" onClick="goTo();" />
	</form>
		
		<br>
		<center>
		<a class="submit" onclick="showSchedule('<?echo date('Y-m-d')?>')"> View Availability Calendar </a>
		</center>
		<table style="margin:25px;">
			<tr >
				<td style="width:25%; padding:10px; border:1px solid #ddd;">
		<div class="pageTitle" >Unconfirmed Reservations </div>
		<?$i; for ($i=0; $i < $num; $i++) {
		$date = mysql_result($result,$i,"rdate");
		$new = date("Y-M-d",strtotime($date));	
		?>
							
							<h3> <b style="color:#000;"> Reservation Id: <a href="verify_res.php?id=<? echo mysql_result($result,$i,"id")?>"> <? echo mysql_result($result,$i,"rid"); ?></a> </b> </h3>
							<ul>
								<li type="none" style="color:#000;">Reservation Date: <b> <?echo $new; ?> </b> </li>
								<li type="none" style="color:#000;">Time: <b> <?echo mysql_result($result,$i,"time"); ?>   </b></li>
								<li type="none" style="color:#000;">First Name: <b> <?echo mysql_result($result,$i,"fname"); ?>   </b></li>
								<li type="none" style="color:#000;">Last Name: <b> <?echo mysql_result($result,$i,"lname"); ?> </b> </li>
								<li type="none" style="color:#000;">Email: <b> <?echo mysql_result($result,$i,"email"); ?> </b> </li>
								<li type="none" style="color:#000;">Mobile: <b> <?echo mysql_result($result,$i,"mobile"); ?> </b> </li>
								<?
									$per = mysql_result($result,$i,"persons");
									$penalty = mysql_result($result,$i,"penalty");
										if ($per >= "10" ){ if ($penalty == 1) {
								?>
									<li type="none" style="color:#000;">Penalty: <b> Yes </b> </li>
								<?
									}	}
									if ($per >= "10" ){
								?>
									<li type="none" style="color:#000;">Type: <b> Function </b> </li>
								<? } else { ?>
									<li type="none" style="color:#000;">Type: <b> Regular </b> </li>
								<? } ?>
								<? if ($per >= "10" ){ ?>
								<li type="none" style="color:#000;">Total: <b>Php. <?echo mysql_result($result,$i,"total"); ?> </b> </li>
								<? } ?>
							</ul>
									<br />
							<? } ?>
							<? if  ($result >= 4) {?>
							<a href="all_unco.php"> <i> view all reservations </i> </a>
							<? } ?>
			</td>			
			<td style="width:25%; padding:10px;border:1px solid #ddd;">
			
				<div class="pageTitle"> Confirmed Reservations </div>
		<?$i; for ($i=0; $i < $num2; $i++) {
		$date = mysql_result($result2,$i,"rdate");
		$new = date("Y-M-d",strtotime($date));	?>
							<h3> <b style="color:#000;"> Reservation Id: <a href="cancel_res.php?id=<? echo mysql_result($result2,$i,"id")?>"> <? echo mysql_result($result2,$i,"rid"); ?> </a> </b> </h3>
							<ul>
								<li type="none" style="color:#000;">Reservation Date: <b> <?echo $new; ?> </b> </li>
								<li type="none" style="color:#000;">Time: <b> <?echo mysql_result($result2,$i,"time"); ?>   </b></li>
								<li type="none" style="color:#000;">First Name: <b> <?echo mysql_result($result2,$i,"fname"); ?>   </b></li>
								<li type="none" style="color:#000;">Last Name: <b> <?echo mysql_result($result2,$i,"lname"); ?> </b> </li>
								<li type="none" style="color:#000;">Email: <b> <?echo mysql_result($result2,$i,"email"); ?> </b> </li>
								<li type="none" style="color:#000;">Mobile: <b> <?echo mysql_result($result2,$i,"mobile"); ?> </b> </li>
								<?
									$per = mysql_result($result2,$i,"persons");
									$penalty = mysql_result($result2,$i,"penalty");
										if ($per >= "10" ){ if ($penalty == 1) {
								?>
									<li type="none" style="color:#000;">Penalty: <b> Yes </b> </li>
								<?
									}	}
								if ($per >= "10" ){
								?>
									<li type="none" style="color:#000;">Type: <b> Function </b> </li>
								<? } else { ?>
									<li type="none" style="color:#000;">Type: <b> Regular </b> </li>
								<? } ?>
								<? if ($per >= "10" ){ ?>
								<li type="none" style="color:#000;">Total: <b>Php. <?echo mysql_result($result2,$i,"total"); ?> </b> </li>
								<? } ?>
							</ul>
						<br />
							<? } ?>
							<? if  ($result2 >= 4) {?>
							<a href="all_confirm.php"> <i> view all reservations </i> </a>
							<? } ?>
							</td>
							<td style="width:25%;padding:10px;border:1px solid #ddd;">
			
				<div class="pageTitle" >Cancelled Reservations </div>
		<?$i; for ($i=0; $i < $num3; $i++) {
		$date = mysql_result($result3,$i,"rdate");
		$new = date("Y-M-d",strtotime($date));	?>
							<h3> <b style="color:#000;"> Reservation Id: <a href="reactivate_res.php?id=<? echo mysql_result($result3,$i,"id")?>"> <? echo mysql_result($result3,$i,"rid"); ?> </a> </b> </h3>
							<ul>
								<li type="none" style="color:#000;">Reservation Date: <b> <?echo $new; ?> </b> </li>
								<li type="none" style="color:#000;">Time: <b> <?echo mysql_result($result3,$i,"time"); ?>   </b></li>
								<li type="none" style="color:#000;">First Name: <b> <?echo mysql_result($result3,$i,"fname"); ?>   </b></li>
								<li type="none" style="color:#000;">Last Name: <b> <?echo mysql_result($result3,$i,"lname"); ?> </b> </li>
								<li type="none" style="color:#000;">Email: <b> <?echo mysql_result($result3,$i,"email"); ?> </b> </li>
								<li type="none" style="color:#000;">Mobile: <b> <?echo mysql_result($result3,$i,"mobile"); ?> </b> </li>
								<?
									$per = mysql_result($result3,$i,"persons");
									$penalty = mysql_result($result3,$i,"penalty");
										if ($per >= "10" ){ if ($penalty == 1) {
								?>
									<li type="none" style="color:#000;">Penalty: <b> Yes </b> </li>
								<?
									}	}
								if ($per >= "10" ){
								?>
									<li type="none" style="color:#000;">Type: <b> Function </b> </li>
								<? } else { ?>
									<li type="none" style="color:#000;">Type: <b> Regular </b> </li>
								<? } ?>
								<? if ($per >= "10" ){ ?>
								<li type="none" style="color:#000;">Total: <b>Php. <?echo mysql_result($result3,$i,"total"); ?> </b> </li>
								<? } ?>
							</ul>
							
						<br />
							<? } ?>
							<? if  ($result3 >= 4) {?>
							<a href="all_cancel.php"> <i> view all reservations </i> </a>
							<? } ?>
							</td>
							<td style="width:25%;padding:10px;border:1px solid #ddd;">
			
				<div class="pageTitle" >Finished Reservations </div>
		<?$i; for ($i=0; $i < $num4; $i++) {
		$date = mysql_result($result4,$i,"rdate");
		$new = date("Y-M-d",strtotime($date));	?>
							<h3> <b style="color:#000;"> Reservation Id: <a href="fin_res.php?id=<? echo mysql_result($result4,$i,"id")?>"> <? echo mysql_result($result4,$i,"rid"); ?> </a> </b> </h3>
							<ul>
								<li type="none" style="color:#000;">Reservation Date: <b> <?echo $new; ?> </b> </li>
								<li type="none" style="color:#000;">Time: <b> <?echo mysql_result($result4,$i,"time"); ?>   </b></li>
								<li type="none" style="color:#000;">First Name: <b> <?echo mysql_result($result4,$i,"fname"); ?>   </b></li>
								<li type="none" style="color:#000;">Last Name: <b> <?echo mysql_result($result4,$i,"lname"); ?> </b> </li>
								<li type="none" style="color:#000;">Email: <b> <?echo mysql_result($result4,$i,"email"); ?> </b> </li>
								<li type="none" style="color:#000;">Mobile: <b> <?echo mysql_result($result4,$i,"mobile"); ?> </b> </li>
								<?
									$per = mysql_result($result4,$i,"persons");
									$penalty = mysql_result($result4,$i,"penalty");
										if ($per >= "10" ){ if ($penalty == 1) {
								?>
									<li type="none" style="color:#000;">Penalty: <b> Yes </b> </li>
								<?
									}	}
								if ($per >= "10" ){
								?>
									<li type="none" style="color:#000;">Type: <b> Function </b> </li>
								<? } else { ?>
									<li type="none" style="color:#000;">Type: <b> Regular </b> </li>
								<? } ?>
								<? if ($per >= "10" ){ ?>
								<li type="none" style="color:#000;">Total: <b>Php. <?echo mysql_result($result4,$i,"total"); ?> </b> </li>
								<? } ?>
							</ul>
						<br />
							<? } ?>
							<? if  ($result4 >= 4) {?>
							<a href="all_fin.php"> <i> view all reservations </i> </a>
							<? } ?>
							</td>
			</tr>
			</table>
			<a href="rejected.php" class="submit"> view rejected reservations </a>
				<? } else { ?>
				
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
														<? } else { ?>
				
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
		</div>
		
<div id="schedule">SCHEDULE HERE</div>
		<? include 'footer.php'; ?>