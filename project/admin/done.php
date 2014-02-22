<?php
$page = "Cancel Reservation";
include 'db_access.php';


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");
	 
$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}
if($login==true){
$showForm=true;
$errorMsg="";

$id=$_GET['id'];
$rid = $_GET['rid'];



if (isset ($_POST["submit"])){
	$ok=$_POST["ok"];
	$ko = "3";
	$date = $_POST["date"];
	$query2= "SELECT sum(total) FROM temp_order WHERE rid = '".$rid."' ";
	$result2=mysql_query($query2);

		while ($row = mysql_fetch_array($result2)){
				$tot = $row['sum(total)'];
			}

	$query3= "SELECT * FROM reservations WHERE rid = '".$rid."' ";
	$result3=mysql_query($query3);
	$num3=mysql_numrows($result3);
	
	$query4= "SELECT * FROM temp_order WHERE rid = '".$rid."' ";
	$result4=mysql_query($query4);
	$num4=mysql_numrows($result4);

	$i; for ($i=0; $i < $num3; $i++){
	$to = mysql_result($result3,$i,"total");
	$pen = mysql_result($result3,$i,"penalty");
	$pax = mysql_result($result3,$i,"persons");
	$fn = mysql_result($result3,$i,"fname");
	$ln = mysql_result($result3,$i,"lname");
	}

if ($pen == "1") {
	$penal = 150;
}
if ($pen == "0") {
	$penal = 0;
}
$dis;
if ($pax >= "10") {
	$dis = 0.15;
	$gt = $tot + $to + $penal;
	$gh = $gt * $dis;
	$final = $gt - $gh;
	$type = "Function";
}
if ($pax <= "9") {
	$dis = 0;
	$gt = $tot + $to + $penal;
	$gh = $gt * $dis;
	$final = $gt - $gh;
	$type = "Regular";
}


	if ((strlen($ok)>0)){
	mysql_select_db("grille", $con);
			$sql=("UPDATE reservations SET status='$ok' where id='$id' ");		
			if (!mysql_query($sql,$con))
			{
			die('Error: ' . mysql_error());
			}
		$query1 = "INSERT INTO sales VALUES ('','" . $rid . "','" . $fn . "','" . $ln . "','" . $date . "','" . $gt . "', '" . $gh . "', '" . $final . "', '" . $type . "')";
		if (!mysql_query($query1,$con)){
			$errorMsg="Cannot proceed with adding sales: ".mysql_error();
		}
		
		if ($result4 >= 1){
			$sql1=("UPDATE temp_order SET veri='$ko' where rid='$rid' ");		
			if (!mysql_query($sql1,$con))
			{
			die('Error: ' . mysql_error());
			}
		}
		mysql_close($con);
		header("location:reserve.php");
	}

	else $errorMsg="Error: Please fill in all the required fields.";
}
		
}		
include 'header.php'; 		
		
?>
		
			
			<div id="contents">
						<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
			<div class="pageTitle"> Reservation Done </div>
			<?php if ($showForm==true){ ?>
			<center>
				<form method="post" action="done.php?id=<? echo $id; ?>&rid=<?echo $rid;?>">
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<br/>
						<div class="info"> Are you sure you want to continue to finish order?  </div>
						<input class="submit" type="submit" name="submit" value="OK"/>
						<input style="display:none" id="guest" name="ok" value="3"/>
						<input style="display:none" id="guest" name="date" value="<?echo date("Y-m-d");?>"/>
						<a class="submit" href="reserve.php"> CANCEL </a>
						
				</form>
				</center>
			<?php } 
			else { ?> 
			<center>
			<div class="success"> 
				<div class="info"> Finish succesful </div>
				<a class="submit" href="reserve.php"> OK </a>
			</div>
			</center>
			<?php } ?> 
			<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
			</div>

<? include 'footer.php'; ?>