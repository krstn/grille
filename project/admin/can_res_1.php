<?php
$page='Update Reservation';

include 'db_access.php';
$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}
if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");	
$showForm=true;
$errorMsg="";
$id=$_GET['id'];
$query= "SELECT * FROM reservations WHERE id =  '".$id."' ";
$result=mysql_query($query);
$num=mysql_numrows($result);


if (isset ($_POST["submit"])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$address=$_POST["address"];
	$mobile=$_POST["mobile"];
	$email=$_POST["email"];
	$rdate=$_POST["rdate"];
	$time=$_POST["time"];
	$venue=$_POST["venue"];
	$persons=$_POST["persons"];
	$status=$_POST["status"];
	$rid=$_POST["rid"];
	$date=$_POST["date"];
	$penalty = $_POST['penalty'];
	$t_e = "";
	
	
	if ($time == "10:00:00") {
		$t_e = "13:00:00";
	}
	if ($time == "11:00:00") {
		$t_e = "14:00:00";
	}
	if ($time == "12:00:00") {
		$t_e = "15:00:00";
	}
	if ($time == "13:00:00") {
		$t_e = "16:00:00";
	}
	if ($time == "14:00:00") {
		$t_e = "17:00:00";
	}
	if ($time == "15:00:00") {
		$t_e = "18:00:00";
	}
	if ($time == "16:00:00") {
		$t_e = "19:00:00";
	}
	if ($time == "17:00:00") {
		$t_e = "20:00:00";
	}
	if ($time == "18:00:00") {
		$t_e = "21:00:00";
	}
	if ($time == "19:00:00") {
		$t_e = "22:00:00";
	}
	if ($time == "20:00:00") {
		$t_e = "23:00:00";
	}
	
	if ((strlen($rid)>0)){
	mysql_select_db("grille", $con);
	
	$sql=("UPDATE reservations SET rid='$rid',persons='$persons',fname='$fname',lname='$lname',address='$address',date='$date',mobile='$mobile',email='$email',rdate='$rdate',time='$time',t_e='$t_e',venue='$venue',status='$status',penalty='$penalty' where id='$id' ");
			
		if (!mysql_query($sql,$con)) {
			die('Error: ' . mysql_error());
		}
		header("location:reserve.php");
	}
	else $errorMsg="Error: You haven't typed anything.";
} 
} 

		
include 'header.php'; 
?>
<div id="contents">
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"><?echo $page;?></div>
	<center>
	<form method="post" action="can_res_1.php?id=<? echo $id; ?>" >
		
		<?for ($i=0; $i < $num; $i++){?>
		<table class="list" style="width:560px;height:374px;display:">

						<tr>
							<td>First Name*: </td>
							<td> <input type="text" name="fname" value="<?echo mysql_result($result,$i,"fname");?> " /> </td>
						</tr>
						<tr>
							<td>Last Name*: </td>
							<td> <input type="text" name="lname" value="<?echo mysql_result($result,$i,"lname");?> " /> </td>
						</tr>
						<tr>
							<td>Address*: </td>
							<td> <input type="text" name="address" value="<?echo mysql_result($result,$i,"address");?> " /> </td>
						</tr>
						<tr>
							<td>E-mail*: </td>
							<td> <input type="text" name="email"value=" <?echo mysql_result($result,$i,"email");?>" /> </td>
						</tr>
						<tr>
							<td>Mobile*: </td>
							<td> <input type="text" name="mobile" value="<?echo mysql_result($result,$i,"mobile");?> " /> </td>
						</tr>
						<tr>
							<td>Reservation Date(YYYY-MM-DD): </td>
							<td> <?include 'ex.html';?> </td>
						</tr>
						<tr>
							<td>Time: </td>
							<td>
								<select name="time" style="width:170px;">
									<option value="10:00:00"> 10:00 AM </option>
									<option value="11:00:00"> 11:00 AM </option>
									<option value="12:00:00"> 12:00 PM </option>
									<option value="13:00:00"> 1:00 PM </option>
									<option value="14:00:00"> 2:00 PM </option>
									<option value="15:00:00"> 3:00 PM </option>
									<option value="16:00:00"> 4:00 PM </option>
									<option value="17:00:00"> 5:00 PM </option>
									<option value="18:00:00"> 6:00 PM </option>
									<option value="19:00:00"> 7:00 PM </option>
									<option value="20:00:00"> 8:00 PM </option>
								</select>
							</td>
						</tr>	
						<tr>
							<td>Venue: </td>
							<td>
								<select name="venue" style="width:170px;"> 
									<option value="Dining Room"> Dining Room </option>
									<option value="Function Room"> Function Room </option>
									<option value="Alfresco"> Alfresco </option>
								</select>
							</td>
						</tr>	
						<tr>
							<td>Persons : </td>
							<td> <select name="persons" style="width:100px;">
									<?$i; for ($i=10; $i < 56; $i++) {?>
										<option value="<?echo $i;?>"> <? echo $i; ?> </option>
									<? } ?>
								</select> 
							</td>
						</tr>

						<input style="display:none;" type="text" name="date" value="<?echo mysql_result($result,$i,"date");?>" />
						<input style="display:none;" type="text" name="rid" value="<?echo mysql_result($result,$i,"rid");?>" />
						<input style="display:none;" type="text" name="status" value="1" />
						<input style="display:none;" type="text" name="penalty" value="<?echo mysql_result($result,$i,"penalty");?>" />

					</table>
					</br>
					<input class="submit" type="submit" name="submit" value="OK"/>	
					<? } ?>
	</form>
	</center>
	<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>

<? include 'footer.php'; ?>