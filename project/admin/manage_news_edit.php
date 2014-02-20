<?php
$page='Edit News';

include 'db_access.php';
$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}

$showForm=true;
$errorMsg="";
$id=$_GET['id'];
$descs=$_GET['descz'];
$newz=$_GET['newsz'];




if($login==true){
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
if (isset ($_POST["submit"])){
	$desc=$_POST["desc"];
	$news=$_POST["news"];

	
	
	if ((strlen($news)>0)){
	mysql_select_db("kensitedb", $con);
	
	$sql=("UPDATE news SET description='$desc',name='$news',image='$image' where id='$id' ");
			
		if (!mysql_query($sql,$con)) {
			die('Error: ' . mysql_error());
		}
		header("location:news.php");
	}
	else $errorMsg="Error: You haven't typed anything.";
} 
} 
}
include 'header.php'; 
?>
<div id="contents">
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"><?echo $page;?></div>
	<form method="post" action="manage_news_edit.php?id=<? echo $id; ?>&descz=<? echo $descs; ?>&newsz=<? echo $newsz; ?>" enctype="multipart/form-data">
		<center>
		<div class="error"> <?php echo $errorMsg; ?>  </div>
			<table>
				<tr>
					<td>Update Description: </td>
					<td> <input type="text" name="news" value="<? echo $descs; ?>" /> </td>
				</tr>
				<tr>
					<td>News: </td>
					<td> <textarea name="desc"> <? echo $newz; ?> </textarea> </td>
				</tr>
				<tr>
						<td>Image: </td>
						<td> <input class="submit" type="file" name="image" > </td>
				</tr>
			</table>
		<input class="submit" type="submit" name="submit" value="OK"/>
		<input style="display:none;" type="text"  name="date" value=" <?echo date("Y-m-d");?> "/>
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