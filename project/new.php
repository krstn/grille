<?
include 'header.php';
include_once 'db_access.php';

$query = mysql_query("SELECT * FROM news ORDER by id desc");
$rows = mysql_num_rows($query);
echo "<br />".$rows;

if (isset($_GET['pn'])) {
    $pn = preg_replace('#[^0-9]#i',"",$_GET['pn']);
}
else {
    $pn = 1;
}

$itemsPerPage = 2;
$lastPage = ceil($rows/$itemsPerPage);
if ($pn < 1){
    $pn = 1;
}
else if ($pn > $lastPage) {
    $pn = $lastPage;
}
echo "<br />".$lastPage;

$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
echo "<br />".$pn;
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
$limit = "LIMIT ".($pn - 1)*$itemsPerPage.','.$itemsPerPage;

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
$result2 = mysql_query("SELECT * FROM news ORDER BY id ASC ".$limit);
$rows2 = mysql_num_rows($result2);
mysql_close();
echo "<br />".$rows2;

for($i=0; $i<$rows2; $i++) { 
    echo "<br />".mysql_result($result2,$i,"descrition");
    echo "<br />".mysql_result($result2,$i,"news");
    echo "<br />".mysql_result($result2,$i,"date");
    echo "<br />".mysql_result($result2,$i,"by");
}
?>

<? include 'footer.php'; ?>