<?php 
$page='Add Product';
include 'header.php';
include 'db_access.php';

$showForm=true;
$errorMsg="";
$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}

if($login==true){
	if(isset($_REQUEST['submit'])) {
		$name= $_FILES['si']['name'];
		$temp= $_FILES['si']['tmp_name'];
		$type= $_FILES['si']['type'];
		$size= $_FILES['si']['size'];
		if(($type=="image/jpeg")||($type=="image/png")||($type=="image/jpg")||($type=="image/gif"))
        {
			$image = "images/".$name;
			move_uploaded_file($temp,$image);
		}
		else
        {
			echo "File type Error.";
		}
		
		$name1= $_FILES['mi']['name'];
		$temp1= $_FILES['mi']['tmp_name'];
		$type1= $_FILES['mi']['type'];
		$size1= $_FILES['mi']['size'];
		if(($type1=="image/jpeg")||($type1=="image/png")||($type1=="image/jpg")||($type1=="image/gif"))
        {
			$image1 = "images/".$name1;
			move_uploaded_file($temp1,$image1);
		}
		else
        {
			echo "File type Error.";
		}
		
		$name2= $_FILES['di']['name'];
		$temp2= $_FILES['di']['tmp_name'];
		$type2= $_FILES['di']['type'];
		$size2= $_FILES['di']['size'];
		if(($type2=="image/jpeg")||($type2=="image/png")||($type2=="image/jpg")||($type2=="image/gif"))
        {
			$image2 = "images/".$name2;
			move_uploaded_file($temp2,$image2);
		}
		else
        {
			echo "File type Error.";
		}
		
		$name3= $_FILES['dri']['name'];
		$temp3= $_FILES['dri']['tmp_name'];
		$type3= $_FILES['dri']['type'];
		$size3= $_FILES['dri']['size'];
		if(($type3=="image/jpeg")||($type3=="image/png")||($type3=="image/jpg")||($type3=="image/gif"))
        {
			$image3 = "images/".$name3;
			move_uploaded_file($temp3,$image3);
		}
		else
        {
			echo "File type Error.";
		}
	if (isset ($_POST["s"])){
	$s=$_POST["s"];
	$sp = $_POST["sp"];

	$m = $_POST["m"];
	$mp = $_POST["mp"];
	
	$d = $_POST["d"];
	$dp = $_POST["dp"];

	$dr = $_POST["dr"];
	$drp = $_POST["drp"];
	$stat = $_POST["stat"];

	
	
	
	if ((strlen($s)>3)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		
		
		$query= "SELECT * FROM products WHERE starters = '".$s."'  ";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
			
		if ($num==1){
			$errorMsg="Error: News already exists. Please try another one.";
		}
		else {
			
			$query1 = "INSERT INTO products VALUES ('','" . $s . "','" . $m . "','" . $d . "','" . $dr . "','" . $sp . "','" . $mp . "','" . $dp . "','" . $drp . "','" . $image . "','" . $image1 . "','" . $image2 . "','" . $image3 . "','" . $stat . "')";
			$result1=mysql_query($query1);
			if (!mysql_query($query,$con)) { 
				die ('Cannot Register'.mysql_error());
			}
			else $showForm=false;
		}
		mysql_close();
	}
	else $errorMsg="Error: You didn't typed anything.";
	
}
}
}
?>
		
		<div id="contents">
			<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
			<div class="pageTitle"> <?php echo $page; ?> </div>
			<?php if ($showForm==true){ ?>
			<form method="post" action="addprod.php" enctype="multipart/form-data">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<table >
					<tr>
						<td>Starters: </td>
						<td> <input type="text" name="s"/> </td>
					</tr>
					<tr>
						<td>Starter Price: </td>
						<td> <input type="text" name="sp"/> </td>
					</tr>
					<tr>
						<td>Starter Image: </td>
						<td> <input class="submit" type="file" name="si" > </td>
					</tr>
					<tr>
						<td>Main Course: </td>
						<td> <input type="text" name="m"/> </td>
					</tr>
					<tr>
						<td>Main Course Price: </td>
						<td> <input type="text" name="mp"/> </td>
					</tr>
					<tr>
						<td>Main Course Image: </td>
						<td> <input class="submit" type="file" name="mi" > </td>
					</tr>
					<tr>
						<td>Dessert: </td>
						<td> <input type="text" name="d"/> </td>
					</tr>
					<tr>
						<td>Dessert Price: </td>
						<td> <input type="text" name="dp"/> </td>
					</tr>
					<tr>
						<td>Dessert Image: </td>
						<td> <input class="submit" type="file" name="di" > </td>
					</tr>
					<tr>
						<td>Drinks: </td>
						<td> <input type="text" name="dr"/> </td>
					</tr>
					<tr>
						<td>Drinks Price: </td>
						<td> <input type="text" name="drp"/> </td>
					</tr>
					<tr>
						<td>Drinks Image: </td>
						<td> <input class="submit" type="file" name="dri" > </td>
					</tr>
				</table>					
				<input class="submit" type="submit" name="submit" id="submit" value="OK"/>
				<input  type="text" name="stat"  value="1" style="display:none;"/>
				<input class="submit" type="Reset" name="Reset" value="Reset"/>
									
				</center>
			</form>
			<?php } else { ?>
			<center>
				<div class="info"> Product Added  </div>
				<a class="submit" href="products.php"> OK </a>
			</center>
			<?php } ?>
			<?php }  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?php } ?>
																
															<?php }  else { ?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?php } ?>
		</div>

		<? include 'footer.php'; ?>
		