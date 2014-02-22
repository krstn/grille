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


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$admin = "admin";

$query2= "SELECT * FROM users where type = '".$admin."'";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
for ($i=0; $i < $num2; $i++){
$r = mysql_result($result2,$i,"fname");
$c = mysql_result($result2,$i,"lname");
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
						<form method="post" action="msg1.php">
						
						<div class="error"> <?php echo $errorMsg; ?>  </div>
						</br>
						<div class="pageTitle">Send Message</div>
						<center>
						<table class="list">
						
						<tr>
							
							<td>First Name: </td>
							<td> <input type="text" name="fname" value="<?echo $r;?> " /> </td>
						</tr>
						<tr>
							
							<td>Last Name: </td>
							<td> <input type="text" name="lname" value="<?echo $c;?> " /> </td>
						</tr>
						<tr>
							
							<td>Subject: </td>
							<td> <input type="text" name="subject" value=" " /> </td>
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