<?
if (isset ($_POST["name"])){
	$name=$_POST["name"];
	$pass=$_POST["pass"];
    
	if ((strlen($name)>0) && (strlen($pass)>0)){
        include_once 'db_access.php';
        
        $veri="1";
		$query= "SELECT * FROM users WHERE username = '".$name."' and password = '".$pass."' and verify = '".$veri."' ";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		
        if ($num==1){
			$type = mysql_result($result,0, "type");
			setcookie("type", $type);
			setcookie("user", $name);
			header("Location:reservations.php");
            exit();
		}
		else{ 
			$errorMsg="Error: Wrong username or password.";
		}
		mysql_close();
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}

include 'header.php';
?>
<form id="login" method="post" action="login.php">
    <div class="title">Login</div>
    <span class="contents">
        <div class="row"><div class="cell">No account yet? <a href="registration.php" >Register</a> first.</div></div>
        <div class="inputs">
            <div><div class="cell"><input class="text" type="text" name="name" placeholder="username" /></div></div>
            <div><div class="cell"><input class="text" type="password" name="pass" placeholder="password" /></div></div>
            <div><div class="error cell"> <?php echo $errorMsg; ?></div></div>
            <div class="action"><input class="button" type="submit" name="submit" value="Login" /></div>
        </div>
    </span>
</form>

<? 
include 'footer.php'; 
?>