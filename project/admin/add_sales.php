<?php
$page='Add Pre-Order to Reservation';
include 'header.php'; 
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");

$showForm=true;
$errorMsg="";

$id = $_GET['id'];
$query= "SELECT * FROM reservations WHERE rid = '".$id."' ";
$result=mysql_query($query);
$num=mysql_numrows($result);

$query1= "SELECT * FROM products ";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);

$i; for ($i=0; $i < $num; $i++){
$rid = mysql_result($result,$i,"rid");
}


$j = "1";

$query3= "SELECT * FROM temp_order WHERE rid = '".$id."' ";
$result3=mysql_query($query3);
$num3=mysql_numrows($result3);
$i; for ($i=0; $i < $num3; $i++){
	$gg = mysql_result($result3, $i, "rid");
}

$query9= "SELECT sum(total) FROM temp_order WHERE rid = '".$id."' ";
	$result9=mysql_query($query9);
	
	while ($row = mysql_fetch_array($result9)){
		$tot = $row['sum(total)'];
	}

if (isset ($_POST["rid"])){
$r_id = $_POST['rid'];
$or = $_POST['or'];
$st = $_POST['st'];
$vr = $_POST['status'];
$mc = $_POST['mc'];
$ds = $_POST['ds'];
$sd = $_POST['sd'];
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$date = $_POST['date'];


$query5= "SELECT * FROM products where starters = '".$st."'  ";
$result5=mysql_query($query5);
$num5=mysql_numrows($result5);

$i; for ($i=0; $i < $num5; $i++){
$q_p1 = mysql_result($result5,$i,"s_p");
$fq1 = $q1 * $q_p1;
}
$query6= "SELECT * FROM products where main = '".$mc."'  ";
$result6=mysql_query($query6);
$num6=mysql_numrows($result6);

$i; for ($i=0; $i < $num6; $i++){
$q_p2 = mysql_result($result6,$i,"main_p");
$fq2 = $q2 * $q_p2;
}
$query7= "SELECT * FROM products where des = '".$ds."'  ";
$result7=mysql_query($query7);
$num7=mysql_numrows($result7);

$i; for ($i=0; $i < $num7; $i++){
$q_p3 = mysql_result($result7,$i,"des_p");
$fq3 = $q3 * $q_p3;
}
$query8= "SELECT * FROM products where drink = '".$sd."'  ";
$result8=mysql_query($query8);
$num8=mysql_numrows($result8);

$i; for ($i=0; $i < $num8; $i++){
$q_p4 = mysql_result($result7,$i,"des_p");
$fq4 = $q4 * $q_p4;
}

$total = $fq1 + $fq2 + $fq3 + $fq4;



	if ((strlen($r_id)>0)  && (strlen($or)>0)  && (strlen($q1)>0)  && (strlen($q2)>0)  && (strlen($q3)>0)  && (strlen($q4)>0)){
		$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");
		
			$query = "INSERT INTO temp_order VALUES ('','" . $r_id . "', '" . $or . "', '" . $vr . "','" . $st . "','" . $mc . "','" . $ds . "','" . $sd . "','" . $q1 . "','" . $q2 . "','" . $q3 . "','" . $q4 . "','" . $total . "','" . $date . "')";
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
				<form method="post" action="add_sales.php?id=<? echo $id; ?>">
				<center>
				<div class="error"> <?php echo $errorMsg; ?>  </div>
				
					<table >
						<tr>
							<td>Reservation Id: </td>
							<td> <input type="text" name="rid" value="<?echo $rid; ?>" style="width:100px;" /> </td>
						</tr>
						<tr>
							<td>Order number: </td>
							<td> <input type="text" name="or" value="<?echo rand() ."\n";?>" style="width:100px;" /> </td>
						</tr>
						<tr>
							<td>Order: </td>
							<td style="width:200px;">Starters: </td>
							<td style="width:200px;">Main Course: </td>
							<td style="width:200px;">Dessert: </td>
							<td style="width:200px;">Drinks: </td>
						</tr>
						<tr>
							<td> </td>
							<td>
								<select name="st" style="width:200px;"> 
								
								<?$i; for ($i=0; $i < $num1; $i++){?>
								<option value="<?echo mysql_result($result1,$i,"starters");?>"> <?echo mysql_result($result1,$i,"starters");?> </option>
								<?}?>
								</select>
							</td>
							<td>
								<select name="mc" style="width:200px;"> 
								
								<?$i; for ($i=0; $i < $num1; $i++){?>
								<option value="<?echo mysql_result($result1,$i,"main");?>"> <?echo mysql_result($result1,$i,"main");?> </option>
								<?}?>
								</select>
							</td>
							<td>
								<select name="ds" style="width:200px;"> 
								
								<?$i; for ($i=0; $i < $num1; $i++){?>
								<option value="<?echo mysql_result($result1,$i,"des");?>"> <?echo mysql_result($result1,$i,"des");?> </option>
								<?}?>
								</select>
							</td>
							<td>
								<select name="sd" style="width:200px;"> 
								
								<?$i; for ($i=0; $i < $num1; $i++){?>
								<option value="<?echo mysql_result($result1,$i,"drink");?>"> <?echo mysql_result($result1,$i,"drink");?> </option>
								<?}?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Quantity: </td>
							<td > <input type="text"name="q1" value="0" style="width:200px;" /> </td>
							<td > <input type="text"name="q2" value="0" style="width:200px;" /> </td>
							<td > <input type="text"name="q3" value="0" style="width:200px;" /> </td>
							<td > <input type="text"name="q4" value="0" style="width:200px;" /> </td>
						</tr>
						<tr>
							<td>Date: </td>
							<td > <input type="text"name="date" value="<?echo date("Y-m-d");?>" style="width:100px;" /> </td>
						</tr>
						
					</table> 
					<input class="submit" type="submit" name="submit" value="Send"/>
					<input style="display:none;" type="text" name="status" value="1" />
					</center>
				</form>
				<?	
					if ($num3 >= 1 ) {
					

				?>
				<p class="pageTitle"> Order Summary </p>
				
					<table class="list">
						<tr>
							<th> Starters </th>
							<th> Main Course </th>
							<th> Dessert </th>
							<th> Drinks </th>
							<th> Total </th>
						</tr>
						<? 
						$i;
						for ($i=0; $i < $num3; $i++){
						?>
						<tr>
							<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result3,$i,"starters"); ?></a> </td>
							<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result3,$i,"main"); ?></a> </td>
							<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result3,$i,"des"); ?></a> </td>
							<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result3,$i,"dri"); ?></a> </td>
							<td> <a href="view_feed.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:red"><? echo mysql_result($result3,$i,"total"); ?></a> </td>
						</tr>
						<?
						}
						?>
						<tr>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td><?echo $tot;?> </td>
						</tr>
					<tr> </tr>
					<tr>
					<td class="button">
		
						<a class="submit" href="checkout.php?id=<?echo $gg;?>">Proceed to checkout</a>
				
					</td>
					</tr>
					</table>
					<? } ?>
			<?php } else { ?>
				<center>
					<div class="info"> Confirm Order? </div>
					<a class="submit" href="add_sales.php?id=<?echo $id;?>"> OK </a>
				</center>
			<? } ?>
		</div>
	
		<? include 'footer.php'; ?>