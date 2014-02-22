<?
$page = "Search Results";
include 'header.php';
include 'db_access.php';
$con = mysql_connect($dbHost, $dbUser, $dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$search = $_GET['search'];

?>

<div id="search">
<form method="get" action="search_sales.php?search=<?echo $search?>;">
		<?php
		if (isset ($_GET["search"])) {
			$search=$_GET["search"];
			$terms = explode ("  ", $search);
			$query = "SELECT * FROM sales WHERE ";
			$i = 0;
			
			foreach ($terms as $each){
				$i++;
				if($i == 1) $query .= "rid LIKE '%$each%' OR date LIKE '%$each%' OR gross LIKE '%$each%'  OR type LIKE '%$each%'  ";
				else $query .= "OR rid LIKE '%$each%' ";
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
					<th> Rservation Id </th>
					<th> Date </th>
					<th> Gross </th>
					<th> Discount </th>
					<th> Net Total </th>
					<th> Type </th>
				</tr>
			<? while ($row = mysql_fetch_assoc($query)) {
					$id = $row['rid'];
					$email = $row['date'];
					$fname = $row['gross'];
					$lname = $row['discount'];
					$sdate = $row['net'];
					$sda = $row['type'];
					$news = date("Y-M-d",strtotime($email));
				 ?>
					<tr>
						<td> <? echo $id; ?> </td>
						<td> <? echo $email; ?> </td>
						<td> <? echo $fname; ?> </td>
						<td> <? echo $lname; ?> </td>
						<td> <? echo $news; ?> </td>
						<td> <? echo $sda; ?> </td>
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