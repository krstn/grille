<?php 
$page='Add News';
include 'header.php';
include 'db_access.php';

$showForm=true;
$errorMsg="";

	
	if (isset ($_POST["news"])){
	$news=$_POST["news"];
	$desc=$_POST["desc"];
	
	
	if ((strlen($news)>5)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		
		
		$query= "SELECT * FROM news WHERE news = '".$news."' ";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
			
		if ($num==1){
			$errorMsg="Error: News already exists. Please try another one.";
		}
		else {
			
			$query1 = "INSERT INTO news VALUES ('','" . $desc . "','" . $news . "')";
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
?>
		
		<div id="contents">
			<div class="pageTitle"> <?php echo $page; ?> </div>
			<?php if ($showForm==true){ ?>
			<form method="post" action="add_news.php">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<table >
					<tr>
						<td>Description: </td>
						<td> <input type="text" name="desc"/> </td>
					</tr>
					<tr>
						<td>News: </td>
						<td> <textarea name="news" > </textarea> </td>
					</tr>
				</table>
				<input class="submit" type="submit" name="submit" value="OK"/>
				<input class="submit" type="Reset" name="Reset" value="Reset"/>					
				</center>
			</form>
			<?php } else { ?>
			<center>
				<div class="info"> News Added  </div>
				<a class="submit" href="index.php"> OK </a>
			</center>
			<? } ?>
		</div>
		<?include 'sidebar.php';?>
		<? include 'footer.php'; ?>
		