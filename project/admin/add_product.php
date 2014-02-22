<?php 
$page='Add Product';
include 'header.php';
include 'db_access.php';
$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}
$showForm=true;
$errorMsg="";
if($login==true){
	if(isset($_REQUEST['submit'])) {
		$name= $_FILES['image']['name'];
		$temp= $_FILES['image']['tmp_name'];
		$type= $_FILES['image']['type'];
		$size= $_FILES['image']['size'];
		if(($type=="image/jpeg")||($type=="image/png")||($type=="image/jpg")||($type=="image/gif"))
        {
			$image = "images/".$name;
			move_uploaded_file($temp,$image);
		}
		else
        {
			echo "File type Error.";
		}
	if (isset ($_POST["name"])){
	$name=$_POST["name"];
	$desc=$_POST["desc"];
	$category=$_POST["category"];
	$price=$_POST["price"];
	$original=$_POST["orig"];
	$available=$_POST["ave"];

	$sold="0";
	
	if ((strlen($name)>5)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		
		
		$query= "SELECT * FROM products WHERE name = '".$name."' ";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
			
		if ($num==1){
			$errorMsg="Error: Name already exists. Please try another one.";
		}
		else {
			
			$query1 = "INSERT INTO products VALUES ('','" . $name . "','" . $desc . "','" . $image . "','" . $category . "','" . $price . "','" . $original . "','" . $available . "','" . $sold . "')";
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
			<div class="pageTitle"> <?php echo $page; ?> </div>
			<?php if ($login==true){ if ($_COOKIE["type"]=="admin"){ ?>
			<?php if ($showForm==true){ ?>
			<form method="post" action="add_product.php" enctype="multipart/form-data">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<table >
					<tr>
						<td>Name: </td>
						<td> <input type="text" name="name"/> </td>
					</tr>
					<tr>
						<td>Category: </td>
						<td> 
						<select name="category" style="width:200px;" > 
									<option value="tire"> tires </option>
									<option value="gears"> gears </option>
									<option value="accessories"> accessories</option>
									<option value="lights"> lights </option>
									<option value="wires"> wires </option>
							</select>  
						</td>
					</tr>
					<tr>
						<td>Description: </td>
						<td> <input type="text" name="desc"/> </td>
					</tr>
					<tr>
						<td>Price: </td>
						<td> <input type="text" name="price"/> </td>
					</tr>
					<tr>
						<td>Original Stock: </td>
						<td> <input type="text" name="orig"/> </td>
					</tr>
					<tr>
						<td>Available Stock: </td>
						<td> <input type="text" name="ave"/> </td>
					</tr>
						<td>Image: </td>
						<td> <input  type="file" name="image" > </td>
					</tr>
					
				</table>
				
				<input class="submit" type="submit" name="submit" id="submit" value="OK"/>
				<input class="submit" type="Reset" name="Reset" value="Reset"/>				
				</center>
			</form>
			<?php } else { ?>
			<center>
				<div class="info"> Product Added  </div>
				<a class="submit" href="product.php"> OK </a>
			</center>
			<?php } ?>
			<?php }  else {?>
										<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
											<?php } ?>	
							<?php }  else { ?>
								<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
								<?php } ?>
		</div>

		<?php include 'footer.php'; ?>
		