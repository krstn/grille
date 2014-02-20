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


$query= "SELECT * FROM reservations WHERE id = '" . $id . "' ";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();

?>


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
			
			
			<div id="contents">
					<center>
						<h1 class="highlight"> Reservation Details </h1>
						</br>
					</center>
						<? $i; for ($i=0; $i < $num; $i++){
							
							$confirm = mysql_result($result,$i,"status");
							$stat = "";
							if ($confirm == 1) {
								$stat = "ACTIVE RESERVATION";
							}
							else  {
								$stat = "UNCONFIRMED RESERVATION";
							}					
						?>
						<center>
						</br>
						<h2 style="color:#fb0;"> <?echo $stat;?> </h1>
						
						</center>
						<p style="Font-size:18px;"> First Name: <b style="color:#fb0;"> <?echo mysql_result($result,$i,"fname");?> </b> </p>
						<p style="Font-size:18px;"> Last Name: <b style="color:#fb0;"> <?echo mysql_result($result,$i,"lname");?> </b> </p>
						<p style="Font-size:18px;"> Address	: <b style="color:#fb0;"> <?echo mysql_result($result,$i,"address");?> </b> </p>
						<p style="Font-size:18px;"> Email: <b style="color:#fb0;"> <?echo mysql_result($result,$i,"email");?> </b> </p>
						<p style="Font-size:18px;"> Date Reserved: <b style="color:#fb0;"> <?echo mysql_result($result,$i,"date");?> </b> </p>
						</br>
						<table class="list" >
							<center>
							<tr>
								<th> Reservation Id &nbsp </th> 		
								<th> Reservation Date &nbsp </th>
								<th> Start Time &nbsp </th>
								<th> End Time &nbsp </th>
								<th> Persons &nbsp </th>
								<th> Venue &nbsp </th>
							</tr>
							<tr style="text-align:center;">
								<td> <? echo mysql_result($result,$i,"rid"); ?> </td>
								<td> <? echo mysql_result($result,$i,"rdate"); ?> </td>
									 <? $x = mysql_result( $result,$i,"time"); ?>
									 <? $et = $x + 3; ?>
									 <? $h = ""; 
										if ($et == 1){
											$h = "01:00 AM";
										}
										if ($et == 2){
											$h = "02:00 AM";
										}
										if ($et == 3){
											$h = "03:00 AM";
										}
										if ($et == 4){
											$h = "04:00 AM";
										}
										if ($et == 5){
											$h = "05:00 AM";
										}if ($et == 6){
											$h = "06:00 AM";
										}if ($et == 7){
											$h = "07:00 AM";
										}if ($et == 8){
											$h = "08:00 AM";
										}if ($et == 9){
											$h = "09:00 AM";
										}if ($et == 10){
											$h = "10:00 AM";
										}if ($et == 11){
											$h = "11:00 AM";
										}if ($et == 12){
											$h = "12:00 AM";
										}if ($et == 13){
											$h = "01:00 PM";
										}if ($et == 14){
											$h = "02:00 PM";
										}if ($et == 15){
											$h = "03:00 PM";
										}if ($et == 16){
											$h = "04:00 PM";
										}if ($et == 17){
											$h = "05:00 PM";
										}if ($et == 18){
											$h = "06:00 PM";
										}if ($et == 19){
											$h = "07:00 PM";
										}if ($et == 20){
											$h = "08:00 PM";
										}if ($et == 21){
											$h = "09:00 PM";
										}if ($et == 22){
											$h = "10:00 PM";
										}if ($et == 23){
											$h = "11:00 PM";
										}
									 ?>
									 <?
										$hi = ""; 
										if ($x == 1){
											$hi = "01:00 AM";
										}
										if ($x == 2){
											$hi = "02:00 AM";
										}
										if ($x == 3){
											$hi = "03:00 AM";
										}
										if ($x == 4){
											$hi = "04:00 AM";
										}
										if ($x == 5){
											$hi = "05:00 AM";
										}if ($x == 6){
											$hi = "06:00 AM";
										}if ($x == 7){
											$hi = "07:00 AM";
										}if ($x == 8){
											$hi = "08:00 AM";
										}if ($x == 9){
											$hi = "09:00 AM";
										}if ($x == 10){
											$hi = "10:00 AM";
										}if ($x == 11){
											$hi = "11:00 AM";
										}if ($x == 12){
											$hi = "12:00 AM";
										}if ($x == 13){
											$hi = "01:00 PM";
										}if ($x == 14){
											$hi = "02:00 PM";
										}if ($x == 15){
											$hi = "03:00 PM";
										}if ($x == 16){
											$hi = "04:00 PM";
										}if ($x == 17){
											$hi = "05:00 PM";
										}if ($x == 18){
											$hi = "06:00 PM";
										}if ($x == 19){
											$hi = "07:00 PM";
										}if ($x == 20){
											$hi = "08:00 PM";
										}if ($x == 21){
											$hi = "09:00 PM";
										}if ($x == 22){
											$hi = "10:00 PM";
										}if ($x == 23){
											$hi = "11:00 PM";
										}
									 ?>
								 <td> <? echo $hi; ?> </td>
								<td> <?echo $h;?> </td>
								<td> <? echo mysql_result($result,$i,"persons"); ?> </td>
								<td> <? echo mysql_result($result,$i,"venue"); ?> </td> 
							</tr>
							<? } ?>	
						</table>
						</center>
					</center>
			</div>
        </div>	
        </center>
    </body>
</html>