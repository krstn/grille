<?php 
$page='Menu';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
}
include 'header.php';
include 'db_access.php';


$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM producs WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete News: ".mysql_error();
	}
}

if ($login == true) {
$query= "SELECT * FROM products ORDER by status desc;";
$result=mysql_query($query);
$num=mysql_numrows($result);
$date = date("Y-m-d");
$user = $_COOKIE["user"];
}
mysql_close();

?>
		<div id="contents">
		<div class="pageTitle"><? echo $page; ?></div>
			<? if ($login == true) { $i; for ($i=0; $i < $num; $i++) {?>
			
			<center>
			<div id="menus">
                <div class="column">
				<h4>Starters:  <? echo mysql_result($result,$i,"starters"); ?>  </h3>
				<h4>Price: Php. <? echo mysql_result($result,$i,"s_p"); ?>  </h3>
                    <img src= <?echo mysql_result($result,$i,"s_image"); ?>  > </img>
				<h4> Main Course: <? echo mysql_result($result,$i,"main"); ?> </b> </h3>
				<h4>Price: Php. <? echo mysql_result($result,$i,"main_p"); ?> </b> </h3>
                    <img src= <?echo mysql_result($result,$i,"m_image"); ?>  > </img>
                </div>
                <div class="column">
				<h4> Dessert: <? echo mysql_result($result,$i,"des"); ?>  </h3>
				<h4> Price: Php. <? echo mysql_result($result,$i,"des_p"); ?>  </h3>
                    <img src= <?echo mysql_result($result,$i,"d_image"); ?>  > </img>
				<h4>Drinks <? echo mysql_result($result,$i,"drink"); ?>  </h3>
				<h4>Price: Php. <? echo mysql_result($result,$i,"dr_pres"); ?>  </h3>
					<img src= <?echo mysql_result($result,$i,"dr_image"); ?>  > </img>
                </div>
            </div>
				<ul>
					<li>
						<a class="submit" href="products_edit.php?id=<? echo mysql_result($result,$i,"id")?>&stat=<? echo mysql_result($result,$i,"status")?>">Edit</a>
							<?
								$stt = mysql_result($result, $i, "status");
									if ($stt == "1") {
							?>
						<a class="submit" href="products_deact.php?id=<? echo mysql_result($result,$i,"id")?>">Deactivate</a>
							<?
							}
							if ($stt == "0") {
							?>
							<a class="submit" href="products_act.php?id=<? echo mysql_result($result,$i,"id")?>">Activate</a>
						<?
						} ?>
						<a class="submit" href="products.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a>
					</li>
				</ul>
				</center>
				<hr>
				<? } }else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>

		</div>
		<? include 'footer.php'; ?>
			
			
		