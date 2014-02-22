<?php
$page='Edit Product';

include 'db_access.php';
$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}

$showForm=true;
$errorMsg="";
$id=$_GET['id'];
$stat = $_GET['stat'];

if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");	 
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
	$st = $_POST["stat"];
	

	if ((strlen($s)>0)){
	mysql_select_db("grille", $con);
	
	$sql=("UPDATE products SET starters='$s',main='$m',des='$d',drink='$dr',s_p='$sp',main_p='$mp',des_p='$dp',dr_pres='$drp',s_image='$image',m_image='$image1',d_image='$image2',dr_image='$image3',status='$st' where id='$id' ");
			
		if (!mysql_query($sql,$con)) {
			die('Error: ' . mysql_error());
		}
		header("location:products.php");
	}
	else $errorMsg="Error: You haven't typed anything.";
} 
} 
}
	
$query= "SELECT * FROM products WHERE id = '".$id."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
include 'header.php'; 
?>

<div id="contents">
			<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
			<div class="pageTitle"> <?php echo $page; ?> </div>
			<?php if ($showForm==true){ ?>
			<form method="post" action="products_edit.php?id=<?echo $id?>&stat=<?echo $stat?>" enctype="multipart/form-data">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<?$i; for ($i=0; $i < $num; $i++) { ?>
				<table >
					<tr>
						<td>Starters: </td>
						<td> <input type="text" name="s" value="<?echo mysql_result($result,$i,"starters"); ?>"/> </td>
					</tr>
					<tr>
						<td>Starter Price: </td>
						<td> <input type="text" name="sp" value="<?echo mysql_result($result,$i,"s_p"); ?>"/> </td>
					</tr>
					<tr>
						<td>Starter Image: </td>
						<td> <input class="submit" type="file" name="si" > </td>
					</tr>
					<tr>
						<td>Main Course: </td>
						<td> <input type="text" name="m" value="<?echo mysql_result($result,$i,"main"); ?>"/> </td>
					</tr>
					<tr>
						<td>Main Course Price: </td>
						<td> <input type="text" name="mp" value="<?echo mysql_result($result,$i,"main_p"); ?>"/> </td>
					</tr>
					<tr>
						<td>Main Course Image: </td>
						<td> <input class="submit" type="file" name="mi" > </td>
					</tr>
					<tr>
						<td>Dessert: </td>
						<td> <input type="text" name="d" value="<?echo mysql_result($result,$i,"des"); ?>"/> </td>
					</tr>
					<tr>
						<td>Dessert Price: </td>
						<td> <input type="text" name="dp" value="<?echo mysql_result($result,$i,"des_p"); ?>"/> </td>
					</tr>
					<tr>
						<td>Dessert Image: </td>
						<td> <input class="submit" type="file" name="di" > </td>
					</tr>
					<tr>
						<td>Drinks: </td>
						<td> <input type="text" name="dr" value="<?echo mysql_result($result,$i,"drink"); ?>"/> </td>
					</tr>
					<tr>
						<td>Drinks Price: </td>
						<td> <input type="text" name="drp" value="<?echo mysql_result($result,$i,"dr_pres"); ?>"/> </td>
					</tr>
					<tr>
						<td>Drinks Image: </td>
						<td> <input class="submit" type="file" name="dri" > </td>
					</tr>
				</table>
				<? } ?>				
				<input class="submit" type="submit" name="submit" id="submit" value="OK"/>
				<input  type="text" name="stat"  value="<?echo $stat;?>" style="display:none;"/>
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
		