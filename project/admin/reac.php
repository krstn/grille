<?php
$page = "Reactivate Reservation";
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
	 
$query2= "SELECT * FROM temp_order WHERE rid = '".$rid."' ";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
		
if (isset ($_POST["submit"])){

	$ok=$_POST["ok"];
	$ko = "1";
	if ((strlen($ok)>0)){
	mysql_select_db("grille", $con);
	$sql=("UPDATE reservations SET status='$ok' where id='$id' ");
			
				
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
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
			<div class="pageTitle"> Reactivate Reservation </div>
			<?php if ($showForm==true){ ?>
			<center>
				<form method="post" action="reac.php?id=<? echo $id; ?>&rid=<?echo $rid;?>">
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<br/>
						<div class="info"> Are you sure you want to continue to reactivate?  </div>
						<input class="submit" type="submit" name="submit" value="OK"/>
						<input style="display:none" id="guest" name="ok" value="1"/>
						<a class="submit" href="reserve.php"> CANCEL </a>
						
				</form>
				</center>
			<?php } 
			else { ?> 
			<center>
			<div class="success"> 
				<div class="info"> Verifying reservation succesful </div>
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