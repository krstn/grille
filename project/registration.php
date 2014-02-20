<?
include 'header.php';
include 'db_access.php';
 
$showForm=true;
$errorMsg="";

	
	if (isset ($_POST["name"])){
	$name=$_POST["name"];
	$pass=$_POST["pass"];
	$email=$_POST["email"];
	$mobile=$_POST["mobile"];
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$address=$_POST["address"];
	$type=$_POST["type"];
	$veri=$_POST["verify"];
	$gender=$_POST["gender"];
	if ((strlen($name)>5) && (strlen($pass)>5) && (strlen($email)>5) && (strlen($fname)>4) && (strlen($lname)>4)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		
		
		$query= "SELECT * FROM users WHERE username = '".$name."' and email = '".$email."' ";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
			
		if ($num==1){
			$errorMsg="Error: Username is already taken. Please try another one.";
		}
		else {
			
			$query1 = "INSERT INTO users VALUES ('','" . $name . "', '" . $pass . "','" . $email . "','" . $mobile . "','" . $fname . "','" . $lname . "', '" . $address . "', '" . $type . "','" . $veri . "','" . $gender . "')";
			$result1=mysql_query($query1);
			if (!mysql_query($query,$con)) { 
				die ('Cannot Register'.mysql_error());
			}
			else $showForm=false;
		}
		mysql_close();
	}
	else $errorMsg="Error: Please fill in all the fields. Username and Password atleast 5 characters.";
	
}
?>
            
			  <div id="campaign">
                <div id="slides">
                    <div class="slide" style="background-image:url('images/slides/slide1.png')">
                        <span class="content">
                            <div class="title">Grill Guru Cheese Burger</div>
                            <div class="description">Charcoal grilled burger with cheese, onions, tomatoes and special house dressing</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                    <div class="slide" style="background-image:url('images/slides/slide2.png')">
                        <span class="content">
                            <div class="title">Char-grilled Salmon Steak</div>
                            <div class="description">Served over plain rice with sauteed vegetables and our sauce duo (lemon butter and asian soy)</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                    <div class="slide" style="background-image:url('images/slides/slide3.png')">
                        <span class="content">
                            <div class="title">Chocolate Cake</div>
                            <div class="description">Served over plain rice with sauteed vegetables and our sauce duo (lemon butter and asian soy)</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                </div>
                <div class="arrow">
                    <img onclick="slidePrev()" class="left" src="images/slides_arrow_left.png" />
                    <img onclick="slideNext()" class="right" src="images/slides_arrow_right.png" />
                </div>
            </div>
			<div id="contentz">
          <?php if ($showForm==true){ ?>
			<form method="post" action="registration.php">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				<table class="form">
					<tr>
						<td>Username: </td>
						<td> <input type="text" name="name"/> </td>
					</tr>
					<tr>
						<td>Password: </td>
						<td> <input type="password" name="pass"/> </td>
					</tr>
					<tr>
						<td>First Name: </td>
						<td> <input type="text" name="fname"/> </td>
					</tr>
					<tr>
						<td>Last Name: </td>
						<td> <input type="text" name="lname"/> </td>
					</tr>
					<tr>
							<td>Gender: </td>
							<td>
								<select name="gender" style="width:100px;"> 
									<option value="Mr."> Male </option>
									<option value="Ms."> Female </option>
								</select>
							</td>
						</tr>
					<tr>
						<td>Address(St.,City,Province): </td>
						<td> <input type="text" name="address"/> </td>
					</tr>
					<tr>
						<td>Email: </td>
						<td> <input type="text" name="email"/> </td>
					</tr>
					<tr>
						<td>Mobile: </td>
						<td> <input type="text" name="mobile"/> </td>
					</tr>
					
				</table>
				</br>
				<input style="display:none" id="guest" name="type" value="guest"/>
				<input style="display:none" id="guest" name="verify" value="0"/>
				<input class="buttonz" type="submit" name="submit" value="OK"/>
				<input class="buttonz" type="Reset" name="Reset" value="Reset"/>					
				</center>
			</form>
			<?php } else { ?>
			<center>
				<div class="info"> Registration complete. Please wait for your account to be verified within 24hrs! Thank you.  </div>
				<a class="submit" href="index.php"> OK </a>
			</center>
			<? } ?>
        </div>
		</div>
        </center>
    </body>
</html>