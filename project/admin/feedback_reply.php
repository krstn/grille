<?php
$page='Send Message';
include 'header.php'; 
include 'db_access.php';



$showForm=true;
$errorMsg="";

$f=$_GET['fname'];
$l=$_GET['lname'];
	 
		
if (isset ($_POST["fname"])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$message=$_POST["message"];
	$sender=$_POST["sender"];

	
	if ((strlen($fname)>0) && (strlen($lname)>0) && (strlen($message)>0)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		
			$query = "INSERT INTO messages VALUES ('','" . $fname . "', '" . $lname . "','" . $message . "','" . $sender . "')";
			if (!mysql_query($query,$con)) { 
				die ('Cannot send message'.mysql_error());
			}
			else $showForm=false;
		
		mysql_close();
	}
	else $errorMsg="Error: Please fill in all the fields.";
}
?>
			<div id="contents">
				<div class="pageTitle"> <?php echo $page; ?> </div>
				<?php if ($showForm==true){ ?>
				<form method="post" action="feedback_reply.php?fname=<? echo $f; ?>&lname=<? echo $l; ?>">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
					<table >
						<tr>
							<td>To: </td>
						</tr>
						<tr>
							<td>First Name: </td>
							<td> <input type="text" name="fname" value="<?echo $f?>" /> </td>
						</tr>
						<tr>
							<td>Last Name: </td>
							<td> <input type="text"name="lname" value="<?echo $l?>" /> </td>
						<tr>
							<td>Message: </td>
							<td> <textarea name="message" > </textarea> </td>
						</tr>
						<tr>
							<td>From: </td>
							<td> <input type="text" name="sender" value="<?echo $_COOKIE["user"];?>" /> </td>
						</tr>
					</table> 
					<input class="submit" type="submit" name="submit" value="Send"/>
					</center>
				</form>
			<?php } else { ?>
				<center>
					<div class="info"> Sending Message Succesful. </div>
					<a class="submit" href="index.php"> OK </a>
				</center>
			<? } ?>
		</div>
		<? include 'sidebar.php'; ?>
		<? include 'footer.php'; ?>