<?php 
$page='Send Message';
$login=false;
$showForm=true;
$errorMsg="";
if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
} 
include 'db_access.php';
include 'header.php';

$id = $_GET['id'];

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");
$sender = $_COOKIE["user"];
$query1= "SELECT * FROM users WHERE username = '".$id."'";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);

for ($i=0; $i < $num1; $i++){
$k =  mysql_result($result1,$i,"username");
$fn = mysql_result($result1,$i,"fname");
$ln = mysql_result($result1,$i,"lname");
}



if (isset ($_POST["submit"])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$subject=$_POST["subject"];
	$message=$_POST["message"];
	$sender=$_POST["sender"];
	$date = $_POST["date"];
	$time = $_POST["time"];

	
	if ((strlen($fname)>0) && (strlen($lname)>0) && (strlen($subject)>0) && (strlen($message)>0)){
		
		$query = "INSERT INTO messages VALUES ('','" . $fname . "', '" . $lname . "', '" . $subject . "', '" . $message . "', '" . $sender . "', '" . $date . "', '" . $time . "')";
		if (!mysql_query($query,$con)){
			$errorMsg="Error sending message: ".mysql_error();
		}
		else $showForm=false;
		mysql_close();
	}
	
	else $errorMsg="Error: Please fill in all the required fields.";
}
?>



				<div id="contents">
				
					<?php if ($showForm==true){ ?>				
						<form method="post" action="msg.php?id=<?echo $id;?>">
						
						<div class="error"> <?php echo $errorMsg; ?>  </div>
						</br>
						<div class="pageTitle">Send Message</div>
						<center>
						<table class="list">
						
						<tr>
							
							<td>First Name: </td>
							<td> <input type="text" name="fname" value="<?echo $fn;?> " /> </td>
						</tr>
						<tr>
							
							<td>Last Name: </td>
							<td> <input type="text" name="lname" value="<?echo $ln;?> " /> </td>
						</tr>
						<tr>
							
							<td>Subject: </td>
							<td> <input type="text" name="subject" value="" /> </td>
						</tr>
						<tr>
							
							<td>Message: </td>
							<td> <textarea name="message" > </textarea> </td>
						</tr>
						<tr>
							<td class="submit">
								<input class="submit"  type="submit" name="submit" value="send"/>	
							</td>
						</tr>
						<input style="display:none;" type="text" name="date" value="<?echo date("Y-m-d");?>" />
						<input style="display:none;" type="text" name="time" value="<?echo date("H:i:s");?>" />
						<input style="display:none;" type="text" name="sender" value="<?echo $_COOKIE["user"];?>" />

				
					</table>
					</br>
					
				</form>
				<?php } else { ?>
			<center>
				<div class="info"> Message successfully sent </div>
				<a class="submit" href="index.php"> OK </a>
			</center>
			<? } ?>
			</center>
        </div>
	<?include 'footer.php';?>