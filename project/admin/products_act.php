<?php
$page = "Activate Products";
include 'db_access.php';


$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}
if($login==true){
$showForm=true;
$errorMsg="";
$id=$_GET['id'];

		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");	 
		
if (isset ($_POST["submit"])){
	$ok=$_POST["ok"];
	if ((strlen($ok)>0)){
	mysql_select_db("grille", $con);
	$sql=("UPDATE products SET status='$ok' where id='$id' ");
	
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}

		mysql_close($con);
		header("location:products.php");
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}
		
}		
include 'header.php'; 		
		
?>
		
			
			<div id="contents">
						<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
			<div class="pageTitle"> Activate Product </div>
			<?php if ($showForm==true){ ?>
			<center>
				<form method="post" action="products_act.php?id=<? echo $id; ?>">
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<br/>
						<div class="info"> Are you sure you want to continue to activate? </div>
						<input class="submit" type="submit" name="submit" value="OK"/>
						<input style="display:none" id="guest" name="ok" value="1"/>
						<a class="submit" href="product.php"> CANCEL </a>
						
				</form>
				</center>
			<?php } 
			else { ?> 
			<center>
			<div class="success"> 
				<div class="info"> Activating Product </div>
				<a class="submit" href="products.php"> OK </a>
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