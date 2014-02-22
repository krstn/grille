<?
$page = "Search Results";
include 'header.php';
include 'db_access.php';
$con = mysql_connect($dbHost, $dbUser, $dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$search = $_GET['search'];

?>

<div id="search">
<form method="get" action="search_res.php?search=<?echo $search?>;">
		<?php
		if (isset ($_GET["search"])) {
			$search=$_GET["search"];
			$terms = explode ("  ", $search);
			$query = "SELECT * FROM reservations WHERE ";
			$i = 0;
			
			foreach ($terms as $each){
				$i++;
				if($i == 1) $query .= "rid LIKE '%$each%' OR fname LIKE '%$each%' OR lname LIKE '%$each%' OR rdate LIKE '%$each%' OR persons LIKE '%$each%' OR venue LIKE '%$each%' ";
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
					<th> First Name </th>
					<th> Last Name </th>
					<th> Reservation Id</th>
					<th> Reservation Date</th>
					<th> Persons </th>
					<th> Venue </th>
					<th> time Start </th>
					<th> Time End </th>
					<th> Status </th>
					<th> Penalty </th>
				</tr>
			<? while ($row = mysql_fetch_assoc($query)) {
					$id = $row['fname'];
					$user = $row['lname'];
					$email = $row['rid'];
					$sdate = $row['rdate'];
					$news = date("Y-M-d",strtotime($sdate));
					$lname = $row['persons'];
					$type = $row['venue'];
					$g = $row['time'];
					$hh = $row['t_e'];
					$st = $row['status'];
					$ts = $row['penalty'];
					
					if ($st == "0") {
						$k = "Unconfirmed";
					}
					if ($st == "1") {
						$k = "Confirmed";
					}
					if ($st == "2") {
						$k = "Cancelled";
					}
					if ($ts == "0") {
						$j = "No";
					}
					if ($ts == "1") {
						$j = "Yes";
					}
				?>	
					<tr>
						<td> <? echo $id; ?> </td>
						<td> <? echo $user; ?> </td>
						<td> <? echo $email; ?> </td>
						<td> <? echo $news; ?> </td>
						<td> <? echo $lname; ?> </td>
						<td> <? echo $type; ?> </td>
						<td> <? echo $g; ?> </td>
						<td> <? echo $hh; ?> </td>
						<td> <? echo $k; ?> </td>
						<td> <? echo $j; ?> </td>
						
					</tr>
			<? } mysql_close(); ?>
			</table>
				
				<br>
		<center>
		<a class="submit" href="#"> View Availability Calendar </a>
		</center>
			<? } else { ?>
			<center>
			<div class="info"> No results found. </div>
			<center>
			<?php }
		} ?>
		
	</div>
	<? include 'footer.php'; ?>