<?php 
$page='News';
include 'header.php';
include 'db_access.php';

$showForm=true;
$errorMsg="";
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");


$query= "SELECT * FROM news ORDER BY id ASC;";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
	
?>
		
		<div id="contents">
		<div class="pageTitle" > News </div>
		<?$i; for ($i=0; $i < $num; $i++) {?>
							<table>
						<tr >
						<td style="width:50%; ">
							
							<h3> <b style="color:#000;"> <? echo mysql_result($result,$i,"name"); ?> </b> </h3>
							<ul>
								<li type="circle" style="color:#000;"> <?echo mysql_result($result,$i,"description"); ?> </li>
							</ul>
							</td>
						<td style="width:50%; ">
						<div id="brax" style="margin-left:50px;"> <div id="feat"><img src="<? echo mysql_result($result,$i,"image"); ?>" style="width:400px; height:500px;"/> </div>						
						
						</td>
						</tr>
						</table>
						<br />
							<? } ?>

		</div>
		
		<? include 'footer.php'; ?>
		