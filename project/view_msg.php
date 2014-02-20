<?php 
include 'header.php'; 
include 'db_access.php';

$errorMsg="";
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
	$register=true;
}

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");

if (isset ($_GET["del"])){
	$del= $_GET["del"];
	$delete="DELETE FROM messages WHERE id ='". $del . "'";
	
	if (!mysql_query($delete,$con)){
		$errorMsg="Failed to delete user: ".mysql_error();
	}
}
$admin = "admin";
$query1= "SELECT * FROM users WHERE type = '".$admin."' ORDER BY id DESC";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
for ($i=0; $i < $num1; $i++){
$k =  mysql_result($result1,$i,"username");
}
$veri = "0";
$ver = "1";
$ken = $k;
$query= "SELECT * FROM messages WHERE sender != '".$ken."' and veri = '".$veri."' ORDER BY id DESC";
$result=mysql_query($query);
$num=mysql_numrows($result);

$query3= "SELECT * FROM messages WHERE sender != '".$ken."' and veri = '".$ver."' ORDER BY id DESC";
$result3=mysql_query($query3);
$num3=mysql_numrows($result3);


?>		
<div id="contents">
<div id="campaign">
                <div id="slides">
                    <div class="slide" style="background-image:url('images/slides/slide1.png')">
                        <span class="content">
                            <div class="title">Grill Guru Cheese Burger</div>
                            <div class="description">Charcoal grilled burger with cheese, onions, tomatoes and special house dressing</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                    <div class="slide" style="background-image:url('images/slides/slide2.png')">
                        <span class="content">
                            <div class="title">Char-grilled Salmon Steak</div>
                            <div class="description">Served over plain rice with sauteed vegetables and our sauce duo (lemon butter and asian soy)</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                    <div class="slide" style="background-image:url('images/slides/slide3.png')">
                        <span class="content">
                            <div class="title">Chocolate Cake</div>
                            <div class="description">Served over plain rice with sauteed vegetables and our sauce duo (lemon butter and asian soy)</div>
                            <a class="button" href="menu.php">View Menu</a>
                        </span>
                    </div>
                </div>
                <div class="arrow">
                    <img onclick="slidePrev()" class="left" src="images/slides_arrow_left.png" />
                    <img onclick="slideNext()" class="right" src="images/slides_arrow_right.png" />
                </div>
            </div>
			<br>
			<br>
			
<? if($login==true){ if ($_COOKIE["type"]=="admin") { ?>
	<h1 style="color:#fb0; text-align:center"> My Messages </h1>
	<table class="list" border="1">
		<tr >
			<th> Sender First Name </th>
			<th> Sender Last Name </th>
			<th> Subject </th>
			<th> Message </th>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		<? $i; 
			for ($i=0; $i < $num; $i++){?>
			<tr style="text-align:center;">
			
				<td> <a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:#fff;"><? echo mysql_result($result,$i,"fname"); ?></a> </td>
				<td><a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:fff"><? echo mysql_result($result,$i,"lname"); ?></a> </td>
				<td ><a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:fff"><?echo mysql_result($result,$i,"subject"); ?> </a></td>
				<td  ><a href="view_message.php?id=<? echo mysql_result($result,$i,"id"); ?>" style="color:fff;" ><textarea> <? echo mysql_result($result,$i,"message"); ?></textarea></a></td>
				
				
				<td >
				<a class="buttonz" href="messages_reply.php?fname=<? echo mysql_result($result,$i,"fname"); ?>&lname=<? echo mysql_result($result,$i,"lname"); ?>">Reply</a>
				<a class="buttonz" href="messages.php?del=<? echo mysql_result($result,$i,"id")?>">Delete</a> 
				</td>
			</tr>
			<? } ?>
		<? $i; 
			for ($i=0; $i < $num3; $i++){?>
			<tr style="text-align:center;">
				<td> <a href="view_message.php?id=<? echo mysql_result($result3,$i,"id"); ?>"> <? echo mysql_result($result3,$i,"fname"); ?> </a> </td>
				<td> <a href="view_message.php?id=<? echo mysql_result($result3,$i,"id"); ?>"><? echo mysql_result($result3,$i,"lname"); ?>  </a> </td>
				<td> <a href="view_message.php?id=<? echo mysql_result($result3,$i,"id"); ?>"><? echo mysql_result($result3,$i,"subject"); ?>  </a> </td>
				<td> <a href="view_message.php?id=<? echo mysql_result($result3,$i,"id"); ?>"><textarea> <? echo mysql_result($result3,$i,"message"); ?> </textarea> </a> </td>

				<td >
				<a class="buttonz" href="messages_reply.php?fname=<? echo mysql_result($result3,$i,"fname"); ?>&lname=<? echo mysql_result($result3,$i,"lname"); ?>">Reply</a>
				<a class="buttonz" href="messages.php?del=<? echo mysql_result($result3,$i,"id")?>">Delete</a> 
				</td>
			</tr>
			<? } ?>
	</table>
		<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
																
															<?}  else {?>
															<center><h2 style="color:#aaa;"> Sorry, you need to have administrative authority to access, login as <a href="login.php">admin </a> </h2></center>
														<?}?>
</div>
