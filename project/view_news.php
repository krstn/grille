<?php

include 'header.php'; 
include 'db_access.php';
$login=false;
$register=true;
$showForm=true;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=false;

}
$id=$_GET['id'];

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");


$query= "SELECT * FROM news WHERE id = '" . $id . "' ";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();

?>


						<?$i; for ($i=0; $i < $num; $i++) {?>
						</br>
						</br>
						<center> <h1 style="color:#fb0;"> <strong> <? echo mysql_result($result,$i,"descrition"); ?> </strong> </h1> 
						</br>
						</br>
						<div id="news">
								<div class="n">
								<img style="width:700px;height:630px;border:10px solid #ddd;" src="<? echo mysql_result($result,$i,"image");?>" />
								</div>
								</br>
								<div class="item">
								<span style="font-family:Arial; font-size:20px;"> <?echo mysql_result($result,$i,"news"); ?> </span>
								</br>
								</br>
								<label > <i style="color:#fb0;"> <?echo mysql_result($result,$i,"date"); ?></i> </label>
								</br>
								<label > Posted by:<?echo mysql_result($result,$i,"by"); ?>,<?echo mysql_result($result,$i,"date"); ?>  </label>
								</div>
							<? } ?>
								</br>
								<a class="buttonz" href="news.php"> Go Back </a>
						</div>
						</center>
						<span> 
        </div>
		
        </center>
    </body>
</html>