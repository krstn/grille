<?
$page = "Search Results";
include 'header.php';
include 'db_access.php';
$con = mysql_connect($dbHost, $dbUser, $dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$search = $_GET['search'];

?>

<div id="search">
<form method="get" action="search_news.php?search=<?echo $search?>;">
		<?php
		if (isset ($_GET["search"])) {
			$search=$_GET["search"];
			$terms = explode ("  ", $search);
			$query = "SELECT * FROM news WHERE ";
			$i = 0;
			
			foreach ($terms as $each){
				$i++;
				if($i == 1) $query .= "descrition LIKE '%$each%' OR news LIKE '%$each%' OR date LIKE '%$each%' ";
				else $query .= "OR descrition LIKE '%$each%' ";
			}
			
		
			$query = mysql_query($query);
			$numrows = mysql_num_rows($query);
				?>
			<div id="contents">	
				<h1 class="pageTitle"> <?echo $page?> </h1>
				<? if ($numrows > 0) { 
				while ($row = mysql_fetch_assoc($query)) {
					$des = $row['descrition'];
					$news = $row['news'];
					$image = $row['image'];
					$sdate = $row['date'];
					$new = date("Y-M-d",strtotime($sdate));
					$by = $row['by'];
				 ?>
				<center> <h3 class="subtitle"><?echo $des;?></h3> 
					<img src="<?echo $image;?>" style="width:300px; height:300px;"/>
					<h4 style="width:50%;"> <? echo $news; ?> </h4>
					<h5> by <? echo $by; ?>, <?echo $new; ?> </h5>
					</br> </br>
				</center>	
			<? } mysql_close(); ?>
			<? } else { ?>
			<center>
			<div class="info"> No results found. </div>
			<center>
			<?php }
		} ?>
		
	</div>
	<? include 'footer.php'; ?>