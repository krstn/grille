<?php

$page='Home';
$login=false;

if (isset ($_COOKIE["user"])){
	$login=true;
}
include 'header.php';
include 'db_access.php';

$con = mysql_connect($dbHost,$dbUser,$dbPass);
@mysql_select_db($dbName) or die("Unable to open database");


$query= "SELECT * FROM news ORDER BY id DESC LIMIT 0, 1;";
$result=mysql_query($query);
$num=mysql_numrows($result);

$zero="0";
$query1= "SELECT * FROM reservations WHERE status = '".$zero."' ORDER BY id DESC LIMIT 0, 1;";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
$guest="guest";
$query2= "SELECT * FROM users WHERE type ='".$guest."' and verify = '".$zero."'  ORDER BY id DESC LIMIT 0, 1;";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
mysql_close();
?>
			<div id="contents">
					
				<table>
					<tr >
					<td style="width:10%;padding:10px;  ">
				<? if ($login==true) { ?>
				<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff; "> MENU </a> </div>
				<? if ($_COOKIE["type"]=="admin"){ ?>
				<div id="korn" style=" align:right; padding:10px;  font-family:'quicksand'; ">
				<b>
				<p> <a href="addnews.php" style="color:#fb0; "> Add News  </a> </p> <hr>
				<p> <a href="addprod.php" style="color:#fb0; "> Add Product  </a> </p> <hr>
				<p> <a href="add_inventory.php" style="color:#fb0; "> Add Inventory  </a> </p> <hr>
				<p> <a href="reg.php" style="color:#fb0;"> Registrations  </a> </p> <hr>
				<p> <a href="reserve.php" style="color:#fb0;"> Reservations  </a> </p> <hr>
				<p> <a href="sales.php" style="color:#fb0;"> Sales </a> </p> <hr>
				<p> <a href="inbox.php" style="color:#fb0;"> Messages </a> </p> <hr>
				<p> <a href="feedbacks.php" style="color:#fb0;"> Inquries/Feedbacks </a> </p> <hr>
				</b>
				</div>
				<? } ?>
				<? if ($_COOKIE["type"]=="clerk"){ ?>
				<div id="korn" style=" align:right; padding:10px;  font-family:'quicksand'; ">
				<b>
				<p> <a href="add_inventory.php" style="color:#fb0; "> Add Inventory  </a> </p> <hr>
				<p> <a href="inventory_logs.php" style="color:#fb0; "> Inventory Reports  </a> </p> <hr>
				<p> <a href="logs.php" style="color:#fb0; "> Inventory Logs  </a> </p> <hr>
				<p> <a href="inbox_clerk.php" style="color:#fb0;"> Messages </a> </p> <hr>
				</b>
				</div>
				<? } ?>
				<? if ($_COOKIE["type"]=="bookkeeper"){ ?>
				<div id="korn" style=" align:right; padding:10px;  font-family:'quicksand'; ">
				<b>
				<p> <a href="reserve.php" style="color:#fb0;"> Reservations  </a> </p> <hr>
				<p> <a href="edit_product.php" style="color:#fb0;"> Sales </a> </p> <hr>
				<p> <a href="inbox_book.php" style="color:#fb0;"> Messages </a> </p> <hr>
				</b>
				</div>
				<? } ?>
				<? }?>
				</td>			
				<td style="width:30%; ">
				<? $i; for ($i=0; $i < $num; $i++) {?>
				<div id="brax" style="margin-left:50px;"> <div id="feat"><img src="<? echo mysql_result($result,$i,"image"); ?>" style="width:600px; height:500px;"/> </div> 
				<a href="edit_news.php" style="font-size:14px; font-family:Times New Roman; color:#000;"> <i> &nbsp &nbsp >>Show all news </i> </a> </div>
				
				</td>
				<td style="width:30%; ">
				<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff;  ;">LATEST NEWS </a> </div>
							<table>
									<tr>
								
								<td width="20%">
										 <br />
										<span ><b style="font-size:22px; font-family:Arial; color:#000;"> <? echo mysql_result($result,$i,"descrition"); ?> </b> </span> <br /> <br />
											<span style="font-size:15px; font-family:arial; color:#000;"> <? echo mysql_result($result,$i,"news"); ?> </span>
									</a> <br />
									<? } ?>
								</td>
								
								</tr>	
							</table>
				</td>

					</tr>
					</table>
					<table>
					<tr `>
					
						<td style="width:25%;">
						
						<div class="pageTitle" style="text-align:center;" ><a href="#" style="color:#fff;  ;">Latest Reservation Requests </a> </div>
						<? if ($login == true) {?>
						<? $i; for ($i=0; $i < $num1; $i++) {?>
						<a href="reserve.php">
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">First Name: <? echo mysql_result($result1,$i,"fname"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Last Name: <? echo mysql_result($result1,$i,"lname"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Persons: <? echo mysql_result($result1,$i,"persons"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Reservation Date: <? echo mysql_result($result1,$i,"rdate"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Venue: <? echo mysql_result($result1,$i,"venue"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Time: <? echo mysql_result($result1,$i,"time"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Time End: <? echo mysql_result($result1,$i,"t_e"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">E-mail: <? echo mysql_result($result1,$i,"email"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">address: <? echo mysql_result($result1,$i,"address"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Mobile: <? echo mysql_result($result1,$i,"mobile"); ?> </b> </span>
						</a>
						<? }  }?>
						</td>
						<td style="width:25%;">
						<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff;  ;">Latest Registration Requests</a> </div>
						<?if ($login == true) {?>
						<? $i; for ($i=0; $i < $num2; $i++) {?>
						<a href="reg.php">
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">First Name: <? echo mysql_result($result2,$i,"gender"); ?> <? echo mysql_result($result2,$i,"fname"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Last Name: <? echo mysql_result($result2,$i,"lname"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Email: <? echo mysql_result($result2,$i,"email"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Address: <? echo mysql_result($result2,$i,"address"); ?> </b> </span>
						<br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:quicksand; color:#a50000;">Mobile: <? echo mysql_result($result2,$i,"mobile"); ?> </b> </span>
						</a>
						<? } }?>
						</td>
						<td style="width:25%;">
						<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff;  ;"> Our Goal </a> </div>
						<center> <img src="images/slide1.png" height="220px;" width="310px;" style="margin-left:20px;" /> <br /> </center>
						<span style="color:#000;"><b style="font-size:16px; font-family:arial; "> &nbsp &nbsp &nbsp Grill Guru is a casual dining restaurant located in La Salle Avenue known for its cosmopolitan menu which offers a mix of all Asian cuisine in an informal ambience. Since the establishment opened for business on May 30, 2011, its progress has been remarkable.   </b> </span>
						
						</td>
						
					</tr>
					
				</table>
				
			</div>
			<hr>
			<? include 'footer.php'; ?>
			