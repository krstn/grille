<?php
$page='View Message';

include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$showForm=true;
$errorMsg="";
$id=$_GET['id'];


$query1= "SELECT * FROM messages WHERE id = '".$id."' LIMIT 0, 1; ";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
$i; for ($i = 0; $i < $num1; $i++){	
$g = mysql_result($result1,$i,"fname");
$h = mysql_result($result1,$i,"lname");
$j = mysql_result($result1,$i,"message");
$k = mysql_result($result1,$i,"sender");
$s = mysql_result($result1,$i,"subject");
}

if (isset ($_POST["submit"])){
	$veri=$_POST["verify"];
	if ((strlen($veri)>0)){
	mysql_select_db($dbName, $con);
	$sql=("UPDATE messages SET veri='$veri' where id='$id' ");	
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}
		mysql_close($con);
		header("location:messages.php");
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}	
include 'header.php'; 
?>
											<div id="contents">
								<table id="main_cont">
								<tr>
									<td style="width:70%">
									<div class="index_side">
											<form method="post" action="view_message.php?id=<?echo $id;?>">
												<div class="error"> <?php echo $errorMsg; ?> </div>
													<table class="list">
														<tr>
															<td>Subject: </td>
															<td><p> <?echo $s;?> </p></td>
														</tr>
														<tr>
															<td>Message: </td>
															<td><textarea>  <?echo $j;?> </textarea> </td>
														</tr>
														<tr>
															<td>sender: </td>
															<td><p> <?echo $k;?></p> </td>
														</tr>
													</table> 
													<center>
														<input class="submit" type="submit" name="submit" value="OK"/>
														<input style="display:none" id="guest" name="verify" value="1"/>
													</center>
											</form>
								</div>
						
						</td>
						
					</tr>
				</table>
			</div>
	