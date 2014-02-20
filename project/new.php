<?
include 'header.php';
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$sql = mysql_query("SELECT * FROM news ORDER by id desc");

$nr=mysql_num_rows($sql);
if (isset($_GET['pn'])){
$pn=preg_replace('#[^0-9]#i',"",$_GET['pn']);
}
else
{
$pn=1;
}
$itemsPerPage = 2;
$lastPage = ceil($nr/$itemsPerPage);
	if ($pn < 1){
		$pn = 1;
	}
	else if ($pn > $lastPage) {
	$pn = $lastPage;
	}
$centerPages = "";
$sub1 = $pn -1;
$sub2 = $pn - 2;
$add1 = $pn+1;
$add2 = $pn+2;
if ($pn == 1){
	$centerPages .= '&nbsp; <span class="pagNumActive">'.$pn.'</span>&nbsp;';
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$add1.'">'.$add1.'</a>&nbsp;';
}
else if ($pn == $lastPage){
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'">'.$sub1.'</a>&nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">'.$pn.'</span>&nbsp;';
}
else if ($pn > 2 && $pn < ($lastPage - 1)){
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub2.'">'.$sub2.'</a>&nbsp;';
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'">'.$sub1.'</a>&nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">'.$pn.'</span>&nbsp;';
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$add1.'">'.$add1.'</a>&nbsp;';
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$add2.'">'.$add2.'</a>&nbsp;';
}
else if ($pn > 1 && $pn < $lastPage){
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'">'.$sub1.'</a>&nbsp;';
	$centerPages .= '&nbsp; <span class="pagNumActive">'.$pn.'</span>&nbsp;';
	$centerPages .= '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$add1.'">'.$add1.'</a>&nbsp;';
}
$limit = 'LIMIT'.($pn - 1)*$itemsPerPage.','.$itemsPerPage;


$paginationDisplay="";
if ($lastPage!="1"){
$paginationDisplay.='Page <strong>'.$pn.'</strong> of' .$lastPage.'';
if ($pn !=1){
$previous = $pn-1;
$paginationDisplay.='&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Back</a>';
}
$paginationDisplay .= '<span class="paginationNumbers">'.$centerPages.'</span>';
if($pn!=$lastPage){
$nextPage = $pn + 1;
$paginationDisplay .='&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$nextPage.'">Next</a>';
}
}
$outputList = "";
$sql2 = "SELECT * FROM news ORDER BY id ASC $limit";
$result=mysql_query($sql2);
$num=mysql_numrows($result);
mysql_close();
$i; for ($i=0; $i < $num; $i++) {

echo mysql_result($result,$i,"descrition");
echo mysql_result($result,$i,"news");
echo mysql_result($result,$i,"date");
echo mysql_result($result,$i,"by");
}
?>



   </div>
		
        </center>
    </body>
</html>