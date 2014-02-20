<?php 
$page='Add News';
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
	if (isset ($_POST["news"])){
	$name=$_POST["news"];
	$description=$_POST["desc"];
	
	
	
	if ((strlen($name)>5)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		
		
		$query= "SELECT * FROM news WHERE description = '".$name."' ";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
			
		if ($num==1){
			$errorMsg="Error: News already exists. Please try another one.";
		}
		else {
			
			$query1 = "INSERT INTO news VALUES ('','" . $name . "','" . $image . "','" . $description . "')";
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
			<form method="post" action="addnews.php" enctype="multipart/form-data">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<table >
					<tr>
						<td>Description: </td>
						<td> <input type="text" name="news"/> </td>
					</tr>
					<tr>
						<td>News: </td>
						<td> <textarea name="desc" > </textarea> </td>
					</tr>
					<tr>
						<td>Image: </td>
						<td> <input class="submit" type="file" name="image" > </td>
					</tr>
				</table>
				<input class="submit" type="submit" name="submit" id="submit" value="OK"/>
				<input class="submit" type="Reset" name="Reset" value="Reset"/>
									
				</center>
			</form>
			<?php } else { ?>
			<center>
				<div class="info"> News Added  </div>
				<a class="submit" href="index.php"> OK </a>
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
		