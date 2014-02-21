<?
include 'header.php';
include_once 'db_access.php';

//$query= "SELECT * FROM news ORDER BY id ASC LIMIT 0,4;";
$query= "SELECT * FROM news ORDER BY id DESC";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>

<div id="news">
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
    <? } ?>
    </div>
</div>
<!--<center> <a href="news.php" class="buttonz"> < </a> <span class="buttonz"> Current Page: 1 </span> <a href="news1.php" class="buttonz"> > </a>-->
						 
<? include 'footer.php'; ?>