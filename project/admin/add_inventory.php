<?php 
$page='Add Inventory';
include 'header.php';
include 'db_access.php';
 
$showForm=true;
$errorMsg="";

$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");


if (isset ($_POST["name"])){
	$name=$_POST["name"];
	$unit=$_POST["unit"];
	$supplier=$_POST["supplier"];
	$stock_a=$_POST["quantity"];
	$date_delivered=$_POST["ddate"];
	$pid =$_POST["pid"];
	$action =$_POST["action"];
	$date =$_POST["date"];
	$cost=$_POST['cost'];

		$query = "INSERT INTO inventory VALUES ('','" . $pid . "','" . $name . "','" . $unit . "', '" . $supplier . "', '" . $stock_a . "', '" . $cost . "', '" . $date_delivered . "')";
		if (!mysql_query($query,$con)){
			$errorMsg="Cannot proceed with adding inventory: ".mysql_error();
		}
		else $showForm=false;
		$query1 = "INSERT INTO inventory_logs VALUES ('','" . $pid . "','" . $name . "','" . $unit . "', '" . $supplier . "', '" . $stock_a . "', '" . $cost . "', '" . $date_delivered . "', '" . $date . "', '" . $action . "')";
		if (!mysql_query($query1,$con)){
			$errorMsg="Cannot proceed with adding sales: ".mysql_error();
		}
		else $showForm=false;
		mysql_close();
	
}
?>
		<div id="contents">
			<div class="pageTitle"> <?php echo $page; ?> </div>
			<?php if ($showForm==true){ ?>
				<form method="post" action="add_inventory.php">
					<center>
					<div class="error"> <?php echo $errorMsg; ?>  </div>
					<table>
						<tr>
							<td>Product Name: </td>
							<td> <input type="text" name="name" value=" " />
							</td>
						</tr>
						<tr>
							<td>Quantity: </td>
							<td> <input type="text" name="quantity" value=" " style="width:100px;"/>
							</td>
						</tr>
						<tr>
							<td>Unit: </td>
							<td> <select name="unit"  style="width:100px;"> 
									<option value="kg"> kg </option>
									<option value="pcs"> pcs </option>
									<option value="cartons"> cartons </option>
									<option value="sacks"> sacks </option>
								</select> </td>
						</tr>
						<tr>
							<td>Supplier: </td>
							<td> <input type="text" name="supplier"/> </td>
						</tr>
						<tr>
							<td>Cost: </td>
							<td> <input type="text" name="cost" style="width:130px;"/> </td>
						</tr>
						<tr>
							<td>Date Delivered(YYYY-MM-DD):</td>
							<td> <?include 'exa.html';?> </td>
						</tr>
					 
										
					</table>
					<input type="text" name="pid" value="<?echo rand() ."\n";?>" style="display:none;"/>
					<input type="text" name="action" value="add new item" style="display:none;"/>
					<input type="text" name="date" value="<?echo date("Y-m-d");?>" style="display:none;"/>
					<input class="submit" type="submit" name="submit" value="OK"/>
					</center>
				</form>
		<?php } else { ?>
				<center>
					<div class="info"> Added Inventory Succesfull. </div>
					
					<a class="submit" href="inventory.php"> OK </a>
				</center>
			<? } ?>
		</div>
		
		<? include 'footer.php'; ?>