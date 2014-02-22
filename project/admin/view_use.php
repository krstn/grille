<?
$page='Account Details';
include 'header.php';
include 'db_access.php';
$login=false;
$errorMsg="";

if (isset ($_COOKIE["user"])){
	$login=true;
}

$showForm=true;
$errorMsg="";
$id=$_GET['id'];

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

$query= "SELECT * FROM users WHERE  id = '".$id."' ";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>
<div id="contents">
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<div class="pageTitle"> <?php echo $page; ?> </div>
			<? $i;
		for ($i=0; $i < $num; $i++){?>
			<table>
				<tr>
					<td> <img src="/<?echo mysql_result($result,$i,"image")?>" style="width:400px; height:440px;" alt="No Image Uploaded"/> </td>
					<td> <h3>Name: <?echo mysql_result($result,$i,"gender")?> <?echo mysql_result($result,$i,"fname")?> <?echo mysql_result($result,$i,"lname")?> </h3>
						 <h3>Address: <?echo mysql_result($result,$i,"address")?>  </h3>
						 <h3>Mobile: <?echo mysql_result($result,$i,"mobile")?>  </h3>
						 <h3>Email: <?echo mysql_result($result,$i,"email")?>  </h3>
						 <h3>Type: <?echo mysql_result($result,$i,"type")?>  </h3>
						 <h3>Username: <?echo mysql_result($result,$i,"username")?>  </h3>
						 <?
							$active = mysql_result($result,$i,"verify");
							if ($active == "1") {
						 ?>
						 <h3>Active User: Yes </h3>
						 <? } ?>
					</td>
				</tr>
			<table>
			
		<? } ?>
		<?}  else {?>
				<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
				<?}?>			
				<?}  else {?>
				<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
				<?}?>
</div>

<? include 'footer.php'; ?>