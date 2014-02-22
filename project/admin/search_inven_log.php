<?
$page = "Search Results";
include 'header.php';
include 'db_access.php';
$con = mysql_connect($dbHost, $dbUser, $dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$search = $_GET['search'];

?>

<div id="search">
<form method="get" action="search_inven_log.php?search=<?echo $search?>;">
		<?php
		if (isset ($_GET["search"])) {
			$search=$_GET["search"];
			$terms = explode ("  ", $search);
			$query = "SELECT * FROM inventory_logs WHERE ";
			$i = 0;
			
			foreach ($terms as $each){
				$i++;
				if($i == 1) $query .= "name LIKE '%$each%' OR unit LIKE '%$each%' OR supplier LIKE '%$each%'  OR date_delivered LIKE '%$each%' OR action LIKE '%$each%'  ";
				else $query .= "OR name LIKE '%$each%' ";
			}
			
		
			$query = mysql_query($query);
			$numrows = mysql_num_rows($query);
				?>
			<div id="contents">	
				<h1 class="pageTitle"> <?echo $page?> </h1>
				<? if ($numrows > 0) { ?>
				<br>
			<table class="lists" >
				<tr>
					<th> Product Name </th>
					<th> Unit </th>
					<th> Supplier </th>
					<th> Stock On Hand </th>
					<th> Delivery Date </th>
					<th> Action </th>
				</tr>
			<? while ($row = mysql_fetch_assoc($query)) {
					$id = $row['name'];
					$user = $row['action'];
					$email = $row['unit'];
					$fname = $row['supplier'];
					$lname = $row['stock_a'];
					$sdate = $row['date_delivered'];
					 
					$news = date("Y-M-d",strtotime($sdate));
				 ?>
					
					<tr>
						<td> <? echo $id; ?> </td>
						<td> <? echo $email; ?> </td>
						<td> <? echo $fname; ?> </td>
						<td> <? echo $lname; ?> </td>
						<td> <? echo $news; ?> </td>
						<td> <? echo $user; ?> </td>
					</tr>
			<? } mysql_close(); ?>
			</table>
			
			<? } else { ?>
			<center>
			<div class="info"> No results found. </div>
			<center>
			<?php }
		} ?>
		
	</div>
	<? include 'footer.php'; ?>