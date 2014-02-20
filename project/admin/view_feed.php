<?php
$page='View Feedback';
 
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$showForm=true;
$errorMsg="";
$id=$_GET['id'];


$query1= "SELECT * FROM contact WHERE id = '".$id."' LIMIT 0, 1; ";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
$i; for ($i = 0; $i < $num1; $i++){	
$g = mysql_result($result1,$i,"fname");
$h = mysql_result($result1,$i,"lname");
$z = mysql_result($result1,$i,"email");
$j = mysql_result($result1,$i,"message");

}

if (isset ($_POST["submit"])){
	$veri=$_POST["verify"];
	if ((strlen($veri)>0)){
	mysql_select_db("kensitedb", $con);
	$sql=("UPDATE contact SET veri='$veri' where id='$id' ");	
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}
		mysql_close($con);
		header("location:feedbacks.php");
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}	
include 'header.php';
?>
											<div id="contents">
								
									
									<center>
											<form method="post" action="view_feed.php?id=<?echo $id;?>">
												<div class="error"> <?php echo $errorMsg; ?> </div>
													<table class="list">
														<tr>
															<td>First Name: </td>
															<td><p> <?echo $g;?> </p></td>
														</tr>
														<tr>
															<td>Last Name: </td>
															<td><p> <?echo $h;?> </p></td>
														</tr>
														<tr>
															<td>Email: </td>
															<td><p> <?echo $z;?></p> </td>
														</tr>
														<tr>
															<td>Message: </td>
															<td><p>  <?echo $j;?> </p> </td>
														</tr>
														
													</table> 
													
														<input class="submit" type="submit" name="submit" value="OK"/>
														<input style="display:none" id="guest" name="verify" value="1"/>

													</center>
											</form>
								
						
					
			</div>
	<? include 'footer.php'; ?>	