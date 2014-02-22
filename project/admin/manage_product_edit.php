<?php
$page='Update Product';

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
$n=$_GET['n'];
$des=$_GET['des'];
$cat=$_GET['cat'];
$pr=$_GET['pr'];
$av=$_GET['av'];
$or=$_GET['or'];

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");


	 
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
	
	
	if ((strlen($name)>1)){
	mysql_select_db("kensitedb", $con);
	
	$sql=("UPDATE products SET name='$name',description='$desc',image='$image',category='$category',price='$price',original='$original',available='$available' where id='$id' ");
			
		if (!mysql_query($sql,$con)) {
			die('Error: ' . mysql_error());
		}
		header("location:product.php");
	}
	else $errorMsg="Error: You haven't typed anything.";
} 
} 
}
include 'header.php'; 
?>

<div id="contents">
	<div class="pageTitle"><?echo $page;?></div>
	<?if ($login==true){ if ($_COOKIE["type"]=="admin"){ ?>
	<form method="post" action="manage_product_edit.php?id=<? echo $id; ?>&n=<? echo $n; ?>&des=<? echo $des; ?>&cat=<? echo $cat; ?>&pr=<? echo $pr; ?>&av=<? echo $av; ?>&or=<? echo $or; ?>" enctype="multipart/form-data">
		<center>
		<div class="error"> <?php echo $errorMsg; ?>  </div>
			<table >
					<tr>
						<td>Name: </td>
						<td> <input type="text" name="name" value="<? echo $n; ?>"/> </td>
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
						<td> <input type="text" name="desc" value="<? echo $des; ?>"/> </td>
					</tr>
					<tr>
						<td>Price: </td>
						<td> <input type="text" name="price" value="<? echo $pr; ?>"/> </td>
					</tr>
					<tr>
						<td>Original Stock: </td>
						<td> <input type="text" name="orig" value="<? echo $or; ?>"/> </td>
					</tr>
					<tr>
						<td>Available Stock: </td>
						<td> <input type="text" name="ave" value="<? echo $av; ?>"/> </td>
					</tr>
						<td>Image: </td>
						<td> <input  type="file" name="image" > </td>
					</tr>
				</table>
				<input class="submit" type="submit" name="submit" id="submit" value="OK"/>
				<input class="submit" type="Reset" name="Reset" value="Reset"/>	
		</center>
	</form>
	<?}  else {?>
										<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
											<?}?>	
							<?}  else {?>
								<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
								<?}?>
</div>

<? include 'footer.php'; ?>