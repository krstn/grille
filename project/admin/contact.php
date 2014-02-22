<?php 
$page='contact';
$login=false;
include 'header.php';
include 'db_access.php';
$showForm=true;
$errorMsg="";

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_COOKIE["user"])){
	$login=true;
}
if (isset($_POST["fname"])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$email=$_POST["email"];
	$message=$_POST["message"];
	$veri=$_POST["veri"];
	
	if ((strlen($fname)>0) && (strlen($lname)>0) && (strlen($email)>0) && (strlen($message)>0)){
		
		
		$query = "INSERT INTO contact VALUES ('','" . $fname . "', '" . $lname . "', '" . $email . "', '" . $message . "', '" . $veri . "')";
		if (!mysql_query($query,$con)){
			$errorMsg="Cannot proceed with adding feedback: ".mysql_error();
		}
		else $showForm=false;
		mysql_close();
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}
?>
		<div id="contents">
			<table>
			<tr>
			<td style="width:700px;">
			<div class="pageTitle" style="clear:both; color:#fff;" > Inquiries & Suggestions </div>
			<?php if ($showForm==true){ ?>
				<form method="post" action="contact.php">
					<center>
					<div class="error"> <?php echo $errorMsg; ?> </div>
					<table >
						<tr>
							<td style="color:#000;">First Name: </td>
							<td> <input type="text" name="fname"  /> </td>
						</tr>
						<tr>
							<td style="color:#000;">Last Name: </td>
							<td> <input type="text"name="lname"  /> </td>
						</tr>
						<tr>
							<td style="color:#000;">E-mail: </td>
							<td> <input type="text"name="email" /> </td>
						</tr>
						<tr>
							<td style="color:#000;">Message: </td>
							<td> <textarea name="message" > </textarea> </td>
						</tr>
						<tr>
							<td style="color:#fff; visibility:hidden;">Message: </td>
							<td style="color:#fff; visibility:hidden;"> <input type="text" name="veri" value="0" /> </td>
						</tr>
					</table> 
					<input class="submit" type="submit" name="submit" value="Send"/>
					</center>
				</form>
				<?php } else { ?>
			<center>
				<div class="info"> Message Sent </div>
				<a class="submit" href="index.php"> OK </a>
			</center>
			<?php } ?>	
				</td>
				<td style="width:650px;">
			<div class="pageTitle" style="color:#fff;"> Visit Us </div>
				<div >
					<img src="images/map.jpg" width="700px" height="500px" />
					</div>
				</td>
				</tr>
				<tr>
				<td style="width:700px; visibility:hidden;">
			<div class="pageTitle" style="clear:both" > Inquiries & Suggestions </div>
				<form method="post" action="contact.php">
					<center>
					<div class="error"> <?php echo $errorMsg; ?> </div>
					<table >
						<tr>
							<td style="color:#fff;">First Name: </td>
							<td> <input type="text" name="fname"  /> </td>
						</tr>
						<tr>
							<td style="color:#fff;">Last Name: </td>
							<td> <input type="text"name="lname"  /> </td>
						</tr>
						
					</table> 
					<input class="submit" type="submit" name="submit" value="Send"/>
					</center>
				</form>
				</td>
				<td style="width:650px;">
					<p style="color:#000;">Corner Ln. Agustin Drive Molave St. <br />
					Bacolod City, Negros Occidental <br />
					Philippines</p> <br />
					
					<p style="color:#000;">Telephone number: 435-4743 <br />
					Mobile number: +639205069905</p> <br />
					<br />
					
				</td>
				</tr>
				</table>
		</div>
		<? include 'sidebar.php'; ?>
		<? include 'footer.php'; ?>