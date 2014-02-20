<?php 
$page='Login';
include 'header.php';
include 'db_access.php';
 
$showForm=true;
$errorMsg="";

if (isset ($_POST["name"])){
	$name=$_POST["name"];
	$pass=$_POST["pass"];
	if ((strlen($name)>0) && (strlen($pass)>0)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		$veri="1";
		$query= "SELECT * FROM users WHERE username = '".$name."' and password = '".$pass."' and verify = '".$veri."' ";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
			
		if ($num==1){
			$type = mysql_result($result,0, "type");
			setcookie("type", $type);
			setcookie("user", $name);
			header( 'Location: index.php' );
		}
		else{ 
			$errorMsg="Error: Wrong Username and Password";
		}
		mysql_close();
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}
?>		
		<div id="contents">
			<div class="pageTitle"> <?php echo $page; ?> </div>
			<?php if ($showForm == true){ ?>
			<form method="post" action="Login.php">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<table>
					<tr>
						<td>Username: </td>
						<td> <input type="text" name="name"/> </td>
					</tr>
					<tr>
						<td>Password: </td>
						<td> <input type="password" name="pass"/> </td>
					</tr>
				</table>
				<input class="submit" type="submit" name="submit" value="OK" />
				</center>
			</form>
			<?php } ?>
		</div>
		<? include 'footer.php'; ?>