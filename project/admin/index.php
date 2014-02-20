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
$query1= "SELECT * FROM products ORDER BY id DESC LIMIT 0, 1;";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
$query2= "SELECT * FROM bestseller ORDER BY id DESC LIMIT 0, 1;";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);
mysql_close();
?>
			<div id="contents">
					<div id="slider">
							<img src="images/2.jpg" />
							<img src="images/3.jpg" />
							<img src="images/4.jpg" />
							<img src="images/5.jpg" />
							<img src="images/6.jpg" />
						</div>
						<br />
				<table>
					<tr 	>
					<td style="width:10%;padding:10px;  ">
				<? if ($login==true) { ?>
				<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff; font-family:Prime;"> MENU </a> </div>
				<? if ($_COOKIE["type"]=="admin"){ ?>
				<div id="korn" style=" align:right; margin-left:20px; padding:10px; font-family:Prime;  ">
				<p> <a href="addnews.php" style="color:#000; "> Add News  </a> </p> <hr>
				<p> <a href="edit_news.php" style="color:#000;"> Update News  </a> </p> <hr>
				<p> <a href="add_product.php" style="color:#000;"> Add Products  </a> </p> <hr>
				<p> <a href="edit_product.php" style="color:#000;"> Update Products  </a> </p> <hr>
				<p> <a href="feedbacks.php" style="color:#000;"> Inquries/Feedbacks </a> </p> <hr>
				<p> <a href="add_best.php" style="color:#000;"> Add Best Seller </a> </p> <hr>
				
				</div>
				<? } }?>
				
				</td>
						
				<td style="width:30%; ">
				<? $i; for ($i=0; $i < $num; $i++) {?>
				<div id="brax" style="margin-left:50px;"> <div id="feat"><img src="<? echo mysql_result($result,$i,"image"); ?>" style="width:600px; height:500px;"/> </div> 
				<a href="news.php" style="font-size:14px; font-family:Times New Roman; color:#000;"> <i> &nbsp &nbsp >>Show all news </i> </a> </div>
				
				</td>
				<td style="width:30%; ">
				<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff; font-family:Prime;">LATEST NEWS </a> </div>
							<table>
									<tr>
								
								<td width="20%">
										 <br />
										<span ><b style="font-size:22px; font-family:Arial; color:#000;"> <? echo mysql_result($result,$i,"name"); ?> </b> </span> <br /> <br />
											<span style="font-size:14px; font-family:Lucida console; color:#000;"> <? echo mysql_result($result,$i,"description"); ?> </span>
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
						
						<div class="pageTitle" style="text-align:center;" ><a href="#" style="color:#fff; font-family:Prime;"> New Arrivals </a> </div>
						
						<? $i; for ($i=0; $i < $num1; $i++) {?>
						<center> <img src="<? echo mysql_result($result1,$i,"image"); ?>" height="220px;" width="310px;" style="margin-left:20px;" />  <br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:Brando; color:#000;"> <? echo mysql_result($result1,$i,"name"); ?> </b> </span>
						</center>
						<? } ?>
						</td>
						<td style="width:25%;">
						<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff; font-family:Prime;"> Best Seller </a> </div>
						<? $i; for ($i=0; $i < $num2; $i++) {?>
						<center> <img src="<? echo mysql_result($result2,$i,"image"); ?>" height="220px;" width="310px;" style="margin-left:20px;" /> <br />
						<span style="color:#191919;"><b style="font-size:22px; font-family:Brando; color:#000;"> <? echo mysql_result($result2,$i,"name"); ?> </b> </span>
						</center>
						<? } ?>
						</td>
						<td style="width:25%;">
						<div class="pageTitle" style="text-align:center;" > <a href="#" style="color:#fff; font-family:Prime;"> Our Products </a> </div>
						<center> <img src="images/1.jpg" height="220px;" width="310px;" style="margin-left:20px;" /> <br /> </center>
						<span style="color:#000;"><b style="font-size:16px; font-family:Tahoma; "> &nbsp &nbsp &nbsp CVKC is the number 1 wholesale and retailer of motorcycle parts
				on the Negros Island. We are completely dedicated to serving the needs of every Negrense and committed to do so for the next generations selling at the
				lowest rates with high quality products.   </b> </span>
						
						</td>
						
					</tr>
					
				</table>
				
			</div>
			<hr>
			<? include 'footer.php'; ?>
			