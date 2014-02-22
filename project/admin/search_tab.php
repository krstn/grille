<?
$page = "Search Results";
include 'header.php';
include 'db_access.php';
$con = mysql_connect($dbHost, $dbUser, $dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$search = $_GET['search'];

?>

<div id="search">
<form method="get" action="search_tab.php?search=<?echo $search?>;">
		<?php
		if (isset ($_GET["search"])) {
			$search=$_GET["search"];
			$terms = explode ("  ", $search);
			$query = "SELECT * FROM users WHERE ";
			$i = 0;
			
			foreach ($terms as $each){
				$i++;
				if($i == 1) $query .= "username LIKE '%$each%' OR type LIKE '%$each%' OR email LIKE '%$each%' OR mobile LIKE '%$each%'  OR address LIKE '%$each%' OR fname LIKE '%$each%'  OR password LIKE '%$each%'   ";
				else $query .= "OR username LIKE '%$each%' ";
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
					<th> Username </th>
					<th> Email </th>
					<th> First Name </th>
					<th> Last name </th>
					<th> Type </th>
				</tr>
			<? while ($row = mysql_fetch_assoc($query)) {
					$id = $row['id'];
					$user = $row['username'];
					$email = $row['email'];
					$fname = $row['fname'];
					$lname = $row['lname'];
					$type = $row['type'];
				 ?>
					
					<tr>
						<td> <? echo $user; ?> </td>
						<td> <? echo $email; ?> </td>
						<td> <? echo $fname; ?> </td>
						<td> <? echo $lname; ?> </td>
						<td> <? echo $type; ?> </td>
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