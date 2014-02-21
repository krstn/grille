<?php 

include 'header.php';
include 'db_access.php';

$showForm=true;
$errorMsg="";
$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

//$query= "SELECT * FROM news ORDER BY id ASC LIMIT 0,4;";
$query= "SELECT * FROM news ORDER BY id DESC";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>

<div id="news">
<!--    <div class="title">See what's grillin'!</span></div>-->
    <div id="items">
    <?
    for($i=0; $i<$num; $i++) {
    ?>
        <div class="item">
            <div class="image"><img src="<?echo mysql_result($result,$i,"image")?>" /></div>
            <div class="date"><? echo date("l, j M Y", strtotime(mysql_result($result,$i,"date"))); ?></div>
            <div class="headline"><? echo ucfirst(mysql_result($result,$i,"descrition")); ?></div>
            <div class="author">by <? echo ucwords(mysql_result($result,$i,"by")); ?></div>
            <p><? echo ucfirst(mysql_result($result,$i,"news")); ?><p>
        </div>
<!--
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
-->
    <? } ?>
    </div>
</div>
<!--<center> <a href="news.php" class="buttonz"> < </a> <span class="buttonz"> Current Page: 1 </span> <a href="news1.php" class="buttonz"> > </a>-->
						 
<? include 'footer.php'; ?>