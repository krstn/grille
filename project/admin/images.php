<?php 
$page='Upload Image';
include 'header.php';
include 'db_access.php';


$file=$_FILES['image']['tmp_name'];

?>
	<div id="contents">
<?
include 'sidebar.php';
?>
		<div class="pageTitle"> Upload Image </div>
		<div id="img">
		<form id="img_upload" action="images.php" method="post" enctype="multipart/form-data"> 
			File:
			<input id="upload" type="file" name="image"/>
			</br>
			</br>
			</br>
			</br>
			<input type="submit" value="Upload"/>
		</form>
		</div>
		<div id="imgs">
		<?
		if (!isset($file)){
	?>  <p> Please select an image. </p> <?
	
	}else{
	$image = addslashes (file_get_contents($_FILES['image']['tmp_name']));
	$image_name = addslashes($_FILES['image']['tmp_name']);
	$image_size = getimagesize($_FILES['image']['tmp_name']);
	
	
	if ($image_size==false){
	?>
		<p>"Thats not an image. </p>
	<?
	}
	else{
		if ($insert = mysql_query ("INSERT INTO images VALUES ('','$image_name','$image')")){
	?>
		<p>"Problem uploading image.</p>
	<?
		}else{
		$lastid = mysql_insert_id();
	?>
	Image Uploaded <p/> Your Image: <p/> <img src="get.php?id=<?$lastid?>">;
	<?
		}
	}
}
?>
		</div>
	</div>
		</div>
		<footer>
                <div class="main">
                    <span>© 2012 Cyscorpions INC. All rights reserved.</span>
                    
                </div>
            </footer>
		</center>
	</body>
</html>