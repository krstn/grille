<?php 

include 'header.php';
include 'db_access.php';

$showForm=true;
$errorMsg="";
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");


$query= "SELECT * FROM news ORDER BY id ASC LIMIT 0,3;";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
	
?>
						</br>
						</br>
						<center> <h1 > GRILL GURU'S CURRENT EVENTS </h1> </center>
						</br>
						</br>
						<div id="news">
							<?$i; for ($i=0; $i < $num; $i++) {?>
							<h3 class="highlight">  <a href="view_news.php?id=<? echo mysql_result($result,$i,"id"); ?>"> <? echo mysql_result($result,$i,"descrition"); ?> </a> </h3>
								<div class="n">
								<img style="width:400px;height:330px;" src="<? echo mysql_result($result,$i,"image");?>" /> 
								</div>
								</br>
								<div class="item">
								<span style="font-family:Arial;"> <?echo mysql_result($result,$i,"news"); ?> </span>
								</br>
								</br>
								<label > <i style="color:#fb0;"> <?echo mysql_result($result,$i,"date"); ?></i> </label>
								</div>
							<? } ?>
						</div>
						<center> <a href="news.php" class="buttonz"> < </a> <span class="buttonz"> Current Page: 1 </span> <a href="news1.php" class="buttonz"> > </a>
						 
        </div>
		
        </center>
    </body>
</html>

