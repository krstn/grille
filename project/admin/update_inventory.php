<?php 
$page='Update Existing Inventory';
include 'header.php';
include 'db_access.php';
 
$showForm=true;

$errorMsg="";
$id=$_GET['id'];
$pid = $_GET['pid'];

$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");

$query= "SELECT * FROM inventory where id = '". $id. "' " ;
$result=mysql_query($query);
$num=mysql_numrows($result);

$i; for ($i=0; $i < $num; $i++){
$n = mysql_result($result, $i, "name");
$u = mysql_result($result, $i, "unit");
$s = mysql_result($result, $i, "supplier");
$st = mysql_result($result, $i, "stock_a");
$gb = mysql_result($result, $i, "cost");

}

if (isset ($_POST["name"])){
	$name=$_POST["name"];
	$unit=$_POST["unit"];
	$supplier=$_POST["supplier"];
	$stock_a=$_POST["stock_a"];
	$date_delivered=$_POST["ddate"];
	$pid =$_POST["pid"];
	$action =$_POST["action"];
	$date =$_POST["date"];
	$cost =$_POST["cost"];
	if ($action == "restock") {
	$to = $st + $stock_a;
	}
	if ($action == "kitchen order") { 
	$sx = $st;
	$sl = $stock_a;
	$to = $st - $stock_a ;
	$cost = "0";
	
	}
	if ($action == "incorrect input") {
	$to = $stock_a;
	}
	
	if ($sl > $sx){
		$errorMsg = "The Quantity you requested exeeds the current stock. Please try another value.";
		mysql_close();
	}
	else
	if ((strlen($name)>0) && (strlen($stock_a)>0)  && (strlen($stock_a)>0)){
	mysql_select_db("grille", $con);
	$sql=("UPDATE inventory SET name='$name', unit='$unit', supplier='$supplier', stock_a='$to',cost='$cost',  date_delivered='$date_delivered'  where id='$id' ");
				
				
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}
		$query1 = "INSERT INTO inventory_logs VALUES ('','" . $pid . "','" . $name . "','" . $unit . "', '" . $supplier . "', '" . $stock_a . "', '" . $cost . "', '" . $date_delivered . "', '" . $date . "', '" . $action . "')";
		if (!mysql_query($query1,$con)){
			$errorMsg="Cannot proceed with adding sales: ".mysql_error();
		}
		mysql_close($con);
		header("location:inventory.php");
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}
?>
		<div id="contents">
			<div class="pageTitle"> <?php echo $page; ?> </div>
			<?php if ($showForm==true){ ?>
				<form method="post" action="update_inventory.php?id=<? echo $id ?>&pid=<?echo $pid;?>">
					<center>
					<div class="error"> <?php echo $errorMsg; ?>  </div>
					<table>
								<tr>
							<td>Nature Of Action: </td>
							<td> <select name="action"  style="width:200px;"> 
									<option value="restock"> Restock </option>
									<option value="kitchen order"> Kitchen Order </option>
									<option value="incorrect input"> Wrong Input </option>
									<option value="others"> Others </option>
								</select> 
							</td>
						</tr>
						<tr>
							<td>Product Name: </td>
							<td> <input type="text" name="name" value="<? echo $n ?> " />
							</td>
						</tr>
						<tr>
							<td>Product ID: </td>
							<td> <input type="text" name="pid" value="<? echo $pid ?> " />
							</td>
						</tr>
						<tr>
							<td>Unit: </td>
							<td> <select name="unit"  style="width:100px;"> 
									<option value="kg"> kg </option>
									<option value="pcs"> pcs </option>
									<option value="cartons"> cartons </option>
									<option value="sacks"> sacks </option>
								</select> 
							</td>
						</tr>
						<tr>
							<td>Current Stock: </td>
							<td> <input type="text" name="current" value="<?echo $st;?>" style="width:130px;"/> </td>
						</tr>
						<tr>
							<td>Quantity: </td>
							<td> <input type="text" name="stock_a" value="" style="width:130px;"/> </td>
						</tr>
						<tr>
							<td>Cost: </td>
							<td> <input type="text" name="cost" value="" /> </td>
						</tr>
						<tr>
							<td>Suplier: </td>
							<td> <input type="text" name="supplier" value="<? echo $s ?>"/> </td>
						</tr>
						<tr>
						<tr>
							<td>Date Delivered(YYYY-MM-DD):</td>
							<td> <?include 'exa.html';?> </td>
						</tr>
					</table>
					<input type="text" name="date" value="<?echo date("Y-m-d");?>" style="display:none;"/>
					<input class="submit" type="submit" name="submit" value="OK"/>
					</center>
				</form>
		<?php } else { ?>
				<center>
					<div class="info"> Updated Inventory Succesfully. </div>
					
					<a class="submit" href="#"> OK </a>
				</center>
			<? } ?>
		</div>
		
		<? include 'footer.php'; ?>