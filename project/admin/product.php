<?
$page="Product";
$showForm=true;
$errorMsg="";
$login=false;
$register=true;
include 'header.php';
include 'db_access.php';
if (isset ($_COOKIE["user"])){
	$login=true;
	$register=false;

}

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");




$z = "0";
$tire = "tire";
$query1= "SELECT * FROM products WHERE category = '".$tire."' and available != '".$z."' ";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
$gears = "gears";
$query2= "SELECT * FROM products WHERE category = '".$gears."' and available != '".$z."' ";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
$accessories = "accessories";
$query3= "SELECT * FROM products WHERE category = '".$accessories."' and available != '".$z."' ";
$result3=mysql_query($query3);
$num3=mysql_numrows($result3);
$lights = "lights";
$query4= "SELECT * FROM products WHERE category = '".$lights."' and available != '".$z."' ";
$result4=mysql_query($query4);
$num4=mysql_numrows($result4);
$wires = "wires";
$query5= "SELECT * FROM products WHERE category = '".$wires."' and available != '".$z."' ";
$result5=mysql_query($query5);
$num5=mysql_numrows($result5);
mysql_close();


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
}
?>
					<div id="contents">
					

							
								
									
									<div class="pageTitle" style="clear:both"  > Product List </div>
									
									<table style="border-style:solid; border-color:red; border:1px;">
									<tr>
									<td style="width:5%;">
									<h3 style=" Font-family:Book Antiqua; background-color:#000; color:#fff; padding:8px 6px;"> Tires  </h3>
									
									<? $i; for ($i=0; $i < $num1; $i++) {?>
									
									<div class="p_col" style=" padding:5px; margin-bottom:5px;">
									<a href="view_categories.php?id=<? echo mysql_result($result1,$i,"id"); ?>&name=<? echo mysql_result($result1,$i,"name"); ?>&description=<? echo mysql_result($result1,$i,"description"); ?>&image=<? echo mysql_result($result1,$i,"image"); ?>&category=<? echo mysql_result($result1,$i,"category"); ?>&price=<? echo mysql_result($result1,$i,"price"); ?>&available=<? echo mysql_result($result1,$i,"available"); ?>">	<p> <b style="color:#000; font-family:Arial; "> <? echo mysql_result($result1,$i,"name"); ?> </b> </p>	
									<p> <img src= <? echo mysql_result($result1,$i,"image"); ?> style="width:200px; height:200px; " > </img> </a> </p>
									<p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Price:</b> <?echo mysql_result($result1,$i,"price"); ?> </i></p> <p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Remaining Stocks:</b> <?echo mysql_result($result1,$i,"available"); ?></i> </p>
										<?if ($login==true){ if ($_COOKIE["type"]=="customer") {?>
										<form method="post" action="featured2.php">
										<input class="submit" type="submit" name="submit" value="add to cart" />
										<input type="text" name="p_id" value="<? echo mysql_result($result1,$i,"id"); ?>" style="display:none" />
										<input type="text" name="name" value="<? echo mysql_result($result1,$i,"name"); ?>" style="display:none" />
										<? 
											$qty = "1";
											$price = mysql_result($result1,$i,"price");
											$total = $qty * $price;
										?>
										<input type="text" name="qty" value="<? echo $qty; ?>" style="display:none" />
										<input type="text" name="price" value="<? echo mysql_result($result1,$i,"price"); ?>" style="display:none" />
										<input type="text" name="total" value="<? echo $total ?>" style="display:none" />
										<input type="text" name="veri" value="0" style="display:none" />
											<input type="text" name="code" value="0" style="display:none" />
										</form>
										<? } }?>
								</div>
								<? } ?>
								
								</td>
								<td style="width:5%;">
									<h3 style=" Font-family:Book Antiqua; background-color:#000; color:#fff; padding:8px 6px;"> Gears  </h3>									
									<? $i; for ($i=0; $i < $num2; $i++) {?>
									
									<div class="p_col" style=" padding:5px; margin-bottom:5px;">
									<a href="view_categories.php?id=<? echo mysql_result($result2,$i,"id"); ?>&name=<? echo mysql_result($result2,$i,"name"); ?>&description=<? echo mysql_result($result2,$i,"description"); ?>&image=<? echo mysql_result($result2,$i,"image"); ?>&category=<? echo mysql_result($result2,$i,"category"); ?>&price=<? echo mysql_result($result2,$i,"price"); ?>&available=<? echo mysql_result($result2,$i,"available"); ?>">	<p> <b style="color:#000; font-family:Arial; "> <? echo mysql_result($result2,$i,"name"); ?> </b> </p>	
									<p> <img src= <? echo mysql_result($result2,$i,"image"); ?> style="width:200px; height:200px; " > </img> </a> </p>
									<p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Price:</b> <?echo mysql_result($result2,$i,"price"); ?> </i></p> <p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Remaining Stocks:</b> <?echo mysql_result($result2,$i,"available"); ?></i> </p>
										<?if ($login==true){  if ($_COOKIE["type"]=="customer") {?>
										<form method="post" action="featured2.php">
										<input class="submit" type="submit" name="submit" value="add to cart" />
										<input type="text" name="p_id" value="<? echo mysql_result($result2,$i,"id"); ?>" style="display:none" />
										<input type="text" name="name" value="<? echo mysql_result($result2,$i,"name"); ?>" style="display:none" />
										<input type="text" name="veri" value="0" style="display:none" />
											<input type="text" name="code" value="0" style="display:none" />
										<? 
											$qty = "1";
											$price = mysql_result($result2,$i,"price");
											$total = $qty * $price;
										?>
										<input type="text" name="qty" value="<? echo $qty; ?>" style="display:none" />
										<input type="text" name="price" value="<? echo mysql_result($result2,$i,"price"); ?>" style="display:none" />
										<input type="text" name="total" value="<? echo $total ?>" style="display:none" />
									
										</form>
										<? }} ?>
								</div>
								<? } ?>
								</td>
								</tr>
								<tr>
									<td style="width:5%;">
<h3 style="color:#206676; Font-family:Book Antiqua; background-color:#000; color:#fff; padding:8px 6px;"> Accessories  </h3>									<? $i; for ($i=0; $i < $num3; $i++) {?>
									
									<div class="p_col" style=" padding:5px; margin-bottom:5px;">
									<a href="view_categories.php?id=<? echo mysql_result($result3,$i,"id"); ?>&name=<? echo mysql_result($result3,$i,"name"); ?>&description=<? echo mysql_result($result3,$i,"description"); ?>&image=<? echo mysql_result($result3,$i,"image"); ?>&category=<? echo mysql_result($result3,$i,"category"); ?>&price=<? echo mysql_result($result3,$i,"price"); ?>&available=<? echo mysql_result($result3,$i,"available"); ?>">	<p> <b style="color:#000; font-family:Arial; "> <? echo mysql_result($result3,$i,"name"); ?> </b> </p>	
									<p> <img src= <? echo mysql_result($result3,$i,"image"); ?> style="width:200px; height:200px; " > </img> </a> </p>
									<p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Price:</b> <?echo mysql_result($result3,$i,"price"); ?> </i></p> <p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Remaining Stocks:</b> <?echo mysql_result($result3,$i,"available"); ?></i> </p>
										<?if ($login==true){ if ($_COOKIE["type"]=="customer") {?>
										<form method="post" action="featured2.php">
										<input class="submit" type="submit" name="submit" value="add to cart" />
										<input type="text" name="p_id" value="<? echo mysql_result($result3,$i,"id"); ?>" style="display:none" />
										<input type="text" name="name" value="<? echo mysql_result($result3,$i,"name"); ?>" style="display:none" />
										<input type="text" name="veri" value="0" style="display:none" />
											<input type="text" name="code" value="0" style="display:none" />
										<? 
											$qty = "1";
											$price = mysql_result($result3,$i,"price");
											$total = $qty * $price;
										?>
										<input type="text" name="qty" value="<? echo $qty; ?>" style="display:none" />
										<input type="text" name="price" value="<? echo mysql_result($result3,$i,"price"); ?>" style="display:none" />
										<input type="text" name="total" value="<? echo $total ?>" style="display:none" />
										<input type="text" name="veri" value="0" style="display:none" />
											<input type="text" name="code" value="0" style="display:none" />
										</form>
										<?} } ?>
								</div>
								<? } ?>
								</td>
								<td style="width:5%;">
<h3 style="color:#206676; Font-family:Book Antiqua; background-color:#000; color:#fff; padding:8px 6px;"> Lights  </h3>									<? $i; for ($i=0; $i < $num4; $i++) {?>
									
									<div class="p_col" style="padding:5px; margin-bottom:5px;">
									<a href="view_categories.php?id=<? echo mysql_result($result4,$i,"id"); ?>&name=<? echo mysql_result($result4,$i,"name"); ?>&description=<? echo mysql_result($result4,$i,"description"); ?>&image=<? echo mysql_result($result4,$i,"image"); ?>&category=<? echo mysql_result($result4,$i,"category"); ?>&price=<? echo mysql_result($result4,$i,"price"); ?>&available=<? echo mysql_result($result4,$i,"available"); ?>">	<p> <b style="color:#000; font-family:Arial; "> <? echo mysql_result($result4,$i,"name"); ?> </b> </p>	
									<p> <img src= <? echo mysql_result($result4,$i,"image"); ?> style="width:200px; height:200px; " > </img> </a></p>
									<p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Price:</b> <?echo mysql_result($result4,$i,"price"); ?> </i></p> <p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Remaining Stocks:</b> <?echo mysql_result($result4,$i,"available"); ?></i> </p>
										<?if ($login==true){ if ($_COOKIE["type"]=="customer") {?>
										<form method="post" action="featured2.php">
										<input class="submit" type="submit" name="submit" value="add to cart" />
										<input type="text" name="p_id" value="<? echo mysql_result($result4,$i,"id"); ?>" style="display:none" />
										<input type="text" name="name" value="<? echo mysql_result($result4,$i,"name"); ?>" style="display:none" />
										<input type="text" name="veri" value="0" style="display:none" />
											<input type="text" name="code" value="0" style="display:none" />
										<? 
											$qty = "1";
											$price = mysql_result($result4,$i,"price");
											$total = $qty * $price;
										?>
										<input type="text" name="qty" value="<? echo $qty; ?>" style="display:none" />
										<input type="text" name="price" value="<? echo mysql_result($result4,$i,"price"); ?>" style="display:none" />
										<input type="text" name="total" value="<? echo $total ?>" style="display:none" />
										</form>
										<? } }?>
								</div>
								<? } ?>
								</td>
								</tr>
								<tr>
									<td style="width:5%;">
<h3 style="color:#206676; Font-family:Book Antiqua; background-color:#000; color:#fff; padding:8px 6px;"> Wires  </h3>									<? $i; for ($i=0; $i < $num5; $i++) {?>
									
									<div class="p_col" style=" padding:5px; margin-bottom:5px;">
									<a href="view_categories.php?id=<? echo mysql_result($result5,$i,"id"); ?>&name=<? echo mysql_result($result5,$i,"name"); ?>&description=<? echo mysql_result($result5,$i,"description"); ?>&image=<? echo mysql_result($result5,$i,"image"); ?>&category=<? echo mysql_result($result5,$i,"category"); ?>&price=<? echo mysql_result($result5,$i,"price"); ?>&available=<? echo mysql_result($result5,$i,"available"); ?>">	<p> <b style="color:#000; font-family:Arial; ">  <? echo mysql_result($result5,$i,"name"); ?> </b> </p>	
									<p> <img src=<? echo mysql_result($result5,$i,"image"); ?> style="width:200px; height:200px; " > </img> </a> </p>
									<p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Price:</b> <?echo mysql_result($result5,$i,"price"); ?> </i></p> <p style="color:#000; Font-family:Book Antiqua;"> <i> <b>Remaining Stocks:</b> <?echo mysql_result($result5,$i,"available"); ?></i> </p>
										<?if ($login==true){ if ($_COOKIE["type"]=="customer") {?>
										<form method="post" action="featured2.php">
										<input class="submit" type="submit" name="submit" value="add to cart" />
										<input type="text" name="p_id" value="<? echo mysql_result($result5,$i,"id"); ?>" style="display:none" />
										<input type="text" name="name" value="<? echo mysql_result($result5,$i,"name"); ?>" style="display:none" />
										<input type="text" name="veri" value="0" style="display:none" />
											<input type="text" name="code" value="0" style="display:none" />
										<? 
											$qty = "1";
											$price = mysql_result($result5,$i,"price");
											$total = $qty * $price;
										?>
										<input type="text" name="qty" value="<? echo $qty; ?>" style="display:none" />
										<input type="text" name="price" value="<? echo mysql_result($result5,$i,"price"); ?>" style="display:none" />
										<input type="text" name="total" value="<? echo $total ?>" style="display:none" />
										</form>
										<? } }?>
								</div>
								<? } ?>
								</tr>
								</table>
							</div>
						<?include 'footer.php';?>
				