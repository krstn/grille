<?php
$page='Products';
include 'header.php'; 
include 'db_access.php';
$login=false;
$register=true;
$showForm=true;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=false;

}





$id=$_GET['id'];
$name=$_GET['name'];
$desc=$_GET['description'];
$image=$_GET['image'];
$category=$_GET['category'];
$available=$_GET['available'];
$price=$_GET['price'];

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$p_id = $id;
$query= "SELECT * FROM products WHERE id = '" . $p_id . "'  LIMIT 0, 3;";
$result=mysql_query($query);
$num=mysql_numrows($result);





if ($login==true){
$type = $_COOKIE["user"];
$query9= "SELECT * FROM users WHERE username = '".$type."'";
$result9=mysql_query($query9);
$num9=mysql_numrows($result9);
mysql_close();

for ($i=0; $i < $num9; $i++){
$first=mysql_result($result9,$i,"fname");
$last=mysql_result($result9,$i,"lname");
}
if (isset($_POST["p_id"])){
	$p_id1=$_POST["p_id"];
	$name1=$_POST["name"];
	$qty1=$_POST["qty"];
	$price1=$_POST["price"];
	$total1=$_POST["total"];
	$veri=$_POST["veri"];
	$code=$_POST["code"];
	$np = "0";
	if ((strlen($p_id1)>0) && (strlen($name1)>0) && (strlen($qty1)>0) && (strlen($price1)>0)){
		
		$fname = $first;
		$lname = $last;
		$query = "INSERT INTO temp_order VALUES ('','" . $p_id1 . "', '" . $name1 . "', '" . $qty1 . "', '" . $price1 . "', '" . $np . "', '" . $total1 . "', '" . $fname . "', '" . $lname . "', '" . $veri. "', '" . $code . "')";
		if (!mysql_query($query,$con)){
			$errorMsg="Cannot proceed with adding feedback: ".mysql_error();
		}
		else $showForm=false;
		mysql_close();
		header("location:product_added.php");
	}
	else $errorMsg="Error: Please fill in all the required fields.";
	mysql_close();
}

}
?>


		<div id="contents">
		
								<div class="pageTitle" > View Product </div>

					<form method="post" action="view_categories.php?id=<? echo $id ?>&name=<? echo $name; ?>&desc=<? echo $desc; ?>&image=<? echo $image; ?>&category=<? echo $category; ?>&price=<? echo $price; ?>&available=<? echo $available; ?>">
						
					
							<p style="background:#ffd101;; width:50%;"> <b style=" font-family:Arial; font-size:25px;"> <i><? echo $category; ?></i> </b> </p> <p> <b style="color:#ffd101; font-family:Arial; font-size:20px;"><i><? echo $name; ?></i> </b> </p>	
							<ul>
								<li type="circle" style="color:#ffd101;"> <? echo $desc; ?>  </li>
								<li> <img src= "<? echo $image; ?>" style="width:500px; height:500px; box-shadow: 1px 1px 1px #1c1c1c;" > </img>    </li>
								<li><label style="color:#ffd101; Font-family:Book Antiqua;"> <i> <b>Price:</b> <?echo $price; ?>, <b>Available Stocks:</b> <?echo $available; ?></i>  </label> </li>
								
							</ul>
										
						
						</form>
						
									
								
									
									
			</div>
		<? include 'footer.php'; ?>