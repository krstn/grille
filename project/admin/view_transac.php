<?php 
$page='Transaction Details';
 
include 'db_access.php';

$errorMsg="";


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$id = $_GET['id'];

$query= "SELECT * FROM reservations WHERE rid =  '".$id."'";
$result=mysql_query($query);
$num=mysql_numrows($result);

$query1= "SELECT * FROM temp_order WHERE rid =  '".$id."'";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);

$query2= "SELECT * FROM sales WHERE rid =  '".$id."'";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);

$query9= "SELECT sum(total) FROM temp_order WHERE rid = '".$id."' ";
	$result9=mysql_query($query9);
	
	while ($row = mysql_fetch_array($result9)){
		$tot = $row['sum(total)'];
	}

mysql_close();
include 'header.php';
?>		

<div id="contents">
<?if($login==true){ if ($_COOKIE['type'] == "admin" || $_COOKIE['type'] == "clerk") { ?>
<br>

	<div class="pageTitle"> Transaction Details </div>
	<h1> Reservation Details </h1>
	<table class="lists">
	<? $i; 
			for ($i=0; $i < $num; $i++){
			$pen = mysql_result($result,$i,"penalty");
			}
			?>
		<tr>
			<th> Reservation Number </th>
			<th>  Name </th>
			<th> Reservation Date </th>
			<th> Start Time </th>
			<th> End Time </th>
			<?if ($pen == "1") { ?>
			<th> Penalty </th>
			<? } ?>
			<th> Type </th>
			<th> Total </th>
		</tr>
		<? $i; 
			for ($i=0; $i < $num; $i++){
			$date = mysql_result($result,$i,"rdate");
			$new = date("Y-M-d",strtotime($date));
			$per = mysql_result($result,$i,"persons");	
				$gl = "";
			if ($per <= "9") {
				$gl = "Regular";
			}
			if ($per >= "10") {
				$gl = "Function";
			}
			?>
			<tr>
				<td> <? echo mysql_result($result,$i,"rid"); ?></td>
				<td> <? echo mysql_result($result,$i,"fname"); ?> <? echo mysql_result($result,$i,"lname"); ?> </td>
				<td> <? echo $new; ?> </td>
				<td> <? echo mysql_result($result,$i,"time"); ?> </td>
				<td> <? echo mysql_result($result,$i,"t_e"); ?> </td>
				<?if ($pen == "1") { 
				?>
				<td> Yes </td>
				<? } ?>
				<td> <? echo  $gl; ?> </td>
				<?if ($pen == "1") { 
					$lok = mysql_result($result,$i,"total");
					$tt = $lok + 150;
				?> 
				<td>Php. <? echo $tt; ?> </td>
				<? } ?>
				<?if ($pen == "0") { 
					$lok = mysql_result($result,$i,"total");
				?>
				<td>Php. <? echo $lok; ?> </td>
				<? } ?>
			</tr>	
			<? } ?>
	</table>
	<? if ($num1 != 0) {?>
	<h1> Order Details </h1>
		<table class="lists">
		<tr>
			<th> </th>
			<th> Starters </th>
			<th> Main Course </th>
			<th> Dessert </th>
			<th> Drinks </th>
			<th> Total </th>
		</tr>
		<? $i; 
			for ($i=0; $i < $num1; $i++){
			?>
			<tr>
				<td> </td>
				<td> <? echo mysql_result($result1,$i,"starters"); ?></td>
				<td> <? echo mysql_result($result1,$i,"main"); ?>  </td>
				<td> <? echo mysql_result($result1,$i,"des"); ?>  </td>
				<td> <? echo mysql_result($result1,$i,"dri"); ?>  </td>
				<td> </td>
			</tr>
			<tr>
				<th>Quantity</th>
				<td> <? echo mysql_result($result1,$i,"q1"); ?></td>
				<td> <? echo mysql_result($result1,$i,"q2"); ?>  </td>
				<td> <? echo mysql_result($result1,$i,"q3"); ?>  </td>
				<td> <? echo mysql_result($result1,$i,"q4"); ?>  </td>
				<td> Php. <? echo mysql_result($result1,$i,"total"); ?> </td>
			</tr>
			<? } ?>
			<tr>
				<th> Order Total</th>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td style="color:red;"><b> Php. <?echo $tot;?> </b></td>
			</tr>
			
	</table>
	<? } else {?>
		<center> <h1> No Pre Order </h1> </center>
	<? } ?>
	<? $i; for ($i=0; $i < $num2; $i++){ ?>
	<h3 style="font-family:cantarell;color:#191911;"> Transaction Gross: Php. <?echo mysql_result($result2, $i, "gross");?></h3>
	<h3 style="font-family:cantarell;color:#191911;"> Discount: Php. <?echo mysql_result($result2, $i, "discount");?></h3>
	<h3 style="font-family:cantarell;color:#191911;"> Transaction Net Total: Php. <?echo mysql_result($result2, $i, "net");?></h3>
	<? } ?>
	<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
	</div>

<? include 'footer.php'; ?>