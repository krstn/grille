<?php 
$page='Orders';
include 'db_access.php';
$login=false;
$register=true;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
} 





$id=$_GET['id'];
if (isset($_POST['submit'])){
	$content = $_POST['content'];
		if(empty($content)){
			$error ='Please enter some content to create your Pdf';
		}
		else {
			include_once('dompdf/dompdf_config.inc.php');
			$html = '
					<html lang="en">
						<head>
							<title>  Grill Guru </title>
						</head>
						<body>
							<center>
								<h1> <img src="icons/footer_logo.png" style="height:50px; width:50px"/> Grill Guru </h1>
								<p> Kamunsil St., cor. C.L. Montelibano Ave., 6100 Bacolod City </p>
							</center>
							'.$content.'						
						</body>
						</html>';
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream('Order.pdf');
		}
}
if($login==true){
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");





if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM reservations WHERE id ='". $del . "'";
	header( 'Location: reserve.php' );
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete News: ".mysql_error();
	}
}
$query= "SELECT * FROM reservations WHERE rid = '".$id."' ";
$result=mysql_query($query);
$num=mysql_numrows($result);

$query2= "SELECT * FROM temp_order WHERE rid = '".$id."' ";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);

$i; for ($i=0; $i < $num2; $i++){
$st = mysql_result($result2,$i,"starters");
$mc = mysql_result($result2,$i,"main");
$ds = mysql_result($result2,$i,"des");
$sd = mysql_result($result2,$i,"dri");
$q1 = mysql_result($result2,$i,"q1");
$q2 = mysql_result($result2,$i,"q2");
$q3 = mysql_result($result2,$i,"q3");
$q4 = mysql_result($result2,$i,"q4");
$yes = mysql_result($result2,$i,"veri");
}

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

$query9= "SELECT sum(total) FROM temp_order WHERE rid = '".$id."' ";
	$result9=mysql_query($query9);
	
	while ($row = mysql_fetch_array($result9)){
		$tot = $row['sum(total)'];
	}


}



?>		
<html lang="en">
	<head> 		
	 <meta charset="utf-8">
		<title> <?php echo $page; ?> | Grill Guru </title>
		<link rel="Stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="scripts/scripts.js"> </script>
		<link rel="icon" href="icons/logo.png">
		<script src="themes/1/js-image-slider.js" type="text/javascript"></script>
		<script src="themes/3/js-image-slider.js" type="text/javascript"></script>
		<script type="text/javascript" src="scripts/jsDatePick.jquery.min.1.3.js"></script>
		<link href="generic.css" rel="stylesheet" type="text/css" />
		
	</head>
	<body>
	
		<div id="container">
			<div id="header">
				<div id="axe"> </div>
				<div id="auth" <? if ($login==true ) { ?> class="on" <? } ?>>
					
					<?php if ($login==false){ ?> <a id="login" href="login.php"> Admin Login </a> 
					<?php } else { ?>  
						<a href="logout.php" id="login" onClick="confirmation();"> Logout </a>
						 <div id="user"> <? echo " Welcome! ". $_COOKIE["user"]; ?> </div> 
					<?php } ?>
				</div>
				<center>
				<div id="navbar">
					<ul class="tab">
						<li> <a class="<? if (strcasecmp($page, "home") == 0) echo "on"; ?>" href="index.php"> Home </a> </li>
						<li> <a class="<? if (strcasecmp($page, "news") == 0) echo "on"; ?>" href="edit_news.php"> News </a> </li>
						<li> <a class="<? if (strcasecmp($page, "users") == 0) echo "on"; ?>" href="users.php"> Users </a> </li>
						<li> <a class="<? if (strcasecmp($page, "menu") == 0) echo "on"; ?>" href="products.php"> Menu </a> </li>
						<li> <a class="<? if (strcasecmp($page, "reservations") == 0) echo "on"; ?>" href="reserve.php"> Reservations </a> </li>
						<li> <a class="<? if (strcasecmp($page, "careers") == 0) echo "on"; ?>" href="careers.php"> Sales </a> </li>
						<li> <a class="<? if (strcasecmp($page, "careers") == 0) echo "on"; ?>" href="careers.php"> Inventory </a> </li>
						
					</ul>
				</div>
				</center>
			</div>
						
<div id="contents">
	<br>
	<br>
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<? $i; for ($i=0; $i < $num; $i++){
		$g = mysql_result($result,$i,"status");
		$fna = mysql_result($result,$i,"fname");
		$lna = mysql_result($result,$i,"lname");
		$add = mysql_result($result,$i,"address");
		$mob = mysql_result($result,$i,"mobile");
		$em = mysql_result($result,$i,"email");
	
		$ti = mysql_result($result,$i,"time");
		$te = mysql_result($result,$i,"t_e");
		$ven = mysql_result($result,$i,"venue");
		$pax = mysql_result($result,$i,"persons");

		$ri = mysql_result($result,$i,"rid");
		$penalty = mysql_result($result,$i,"penalty");

		$date = mysql_result($result,$i,"rdate");
		$new = date("Y-M-d",strtotime($date));
		$sdate = mysql_result($result,$i,"date");
		$news = date("Y-M-d",strtotime($sdate));			

		}
		$k ="";
		if ($g == 0) {
			$k = "Unconfirmed";
		}
		if ($g == 1) {
			$k = "Confirmed";
		}
		if ($g == 2) {
			$k = "Cancelled";
		}
		
	?>
	<div class="subtitle"> Reservation Status: <?php echo $k; ?>  </div> 
	<h4 >  Name: &nbsp <b style="color:#d30; font-family:quicksand;"> <?echo $fna;?> <?echo $lna;?> </b>  </h4>
	<h4>   Date: &nbsp <b style="color:#d30; font-family:quicksand;"> <?echo $new;?>  </b> </h4>
	<h4>   Reservation Id: &nbsp <b style="color:#d30; font-family:quicksand;"> <?echo $ri;?>  </b> </h4>
	 &nbsp &nbsp &nbsp &nbsp <a href="#" class="submit"> View Calendar </a>
	<?
		if ($yes == "1") {
			$ans = "Verified";
		}
		if ($yes == "0") {
			$ans = "Unverified";
		}
		if ($yes == "2") {
			$ans = "Cancelled";
		}
		if ($yes == "3") {
			$ans = "Finished";
		}
	?>
	<div class="subtitle"> Order Status: <?php echo $ans; ?> </div>
	<br>
	<br>
	<table class="lists" >
		<center><h1 > ORDER SUMMARY </h1></center>
		<tr>
			<th> </th>
			<th> Starters </th>
			<th> Main Course </th>
			<th> Dessert </th>
			<th> Drinks </th>
			<th> Total </th>
			
			
		</tr>
		<? $i; for ($i=0; $i < $num2; $i++){ ?>
		<tr>
			<td> </td>
			<td> <? echo mysql_result($result2,$i,"starters"); ?> </td>
			<td> <? echo mysql_result($result2,$i,"main"); ?> </td>
			<td> <? echo mysql_result($result2,$i,"des"); ?> </td>
			<td> <? echo mysql_result($result2,$i,"dri"); ?></td>
			<td> </td>
		</tr>

		<tr>
			<th> Quantity </th>

			<th > <? echo  mysql_result($result2,$i,"q1"); ?> </th>
			<th  > <? echo  mysql_result($result2,$i,"q2");?> </th>
			<th> <? echo  mysql_result($result2,$i,"q3"); ?> </th>
			<th> <? echo  mysql_result($result2,$i,"q4"); ?> </th>
			<th>Php. <? echo  mysql_result($result2,$i,"total"); ?> </th>
			
		</tr>
		<? } ?>

		<tr>
			<th> Grand Total </th>
			<th>  </th>
			<th>  </th>
			<th>  </th>
			<th>  </th>
			<th style="color:red;"> Php. <?echo $tot;?> </th>

		</tr>
	</table>
				
			<br>
			<br>
			<br>
			<a href="add_sales.php?id=<?echo $id;?>" class="submit"> Update Order </a>
			<?if ($yes == "0") {?>
			<a href="verify_order.php?id=<?echo $id;?>" class="submit"> Verify Order </a>
			<?}?>
			<?if ($yes == "1") {?>
			<a href="finish.php?id=<?echo $id;?>" class="submit"> Finish Order </a>
			<?}?>
			<?if ($yes == "2") {?>
			<a href="verify_order.php?id=<?echo $id;?>" class="submit"> Reactivate Order </a>
			<?}?>
			
			 <form method="post" action="orders.php?id=<?echo $id?>">
	<?
		if(isset($error)) {
			echo $error;
		}
	?>
			<textarea name="content" style="display:none;">
						
						<h4 > Reservation Status: <?php echo $k;?> </h4>
						<p> Name: <?echo $fna;?> <?echo $lna;?> </p>
						<p> Address: <?echo $add;?> </p>
						<p> Mobile: <?echo $mob;?> </p>
						<p> Email: <?echo $em;?> </p>
						<p> Reservation Date: <?echo $new;?> </p>
						<p> Time: <?echo $ti;?> </p>
						<p> Time End: <?echo $te;?> </p>
						<p> Venue: <?echo $ven;?> </p>
						<p> Persons: <?echo $pax;?> </p>
						<?
							if ($penalty == "1") {
						?>
						<p> Penalty: Yes </p>
						<? } ?>
						<p> Reservation Number: <? echo $ri; ?>
						<h4> Order Status: <?php echo $ans;?> </h4>
						
						</br>
						</br>
						<center><h1> ORDER SUMMARY </h1>
						<br>
						<br>
						<table style="font-family:Tahoma;font-size:12px;color:#191919;width:100%;">
							<tr>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;">Starters</td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;">Main Course</td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;">Dessert</td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;">Drinks</td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;">Total</td>
							</tr>
							<? $i; for ($i=0; $i < $num2; $i++){ ?>
							<tr>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result2,$i,"starters"); ?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result2,$i,"main"); ?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result2,$i,"des"); ?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo mysql_result($result2,$i,"dri"); ?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> </td>
							</tr>
							<tr>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> Quantity </th>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo  mysql_result($result2,$i,"q1"); ?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo  mysql_result($result2,$i,"q2");?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo  mysql_result($result2,$i,"q3"); ?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;"> <? echo  mysql_result($result2,$i,"q4"); ?> </td>
								<td style="text-align:center;padding:5px;border:1px dotted #bbb;">Php. <? echo  mysql_result($result2,$i,"total"); ?> </td>
			
							</tr>
								<? } ?>

								<tr>
									<th style="text-align:center;padding:5px;border:1px dotted #bbb;"> Grand Total </th>
									<td style="text-align:center;padding:5px;border:1px dotted #bbb;">  </td>
									<td style="text-align:center;padding:5px;border:1px dotted #bbb;">  </td>
									<td style="text-align:center;padding:5px;border:1px dotted #bbb;">  </td>
									<td style="text-align:center;padding:5px;border:1px dotted #bbb;">  </td>
									<td style="text-align:center;padding:5px;border:1px dotted #bbb;color:red;"> Php. <?echo $tot;?> </td>
								</tr>
						</table>
							<center>
			</textarea></br>
			<input type="submit" name="submit" class="submit" value="Print "/>
	</form>
			
			<br>
		<?}  else {?>
					<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
							<?}?>		
								<?}  else {?>
									<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
								<?}?>
</div>

