<?
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

$type = $_COOKIE["user"];
$query= "SELECT * FROM users WHERE username = '".$type."'";
$result=mysql_query($query);
$num=mysql_numrows($result);


for ($i=0; $i < $num; $i++){
$first=mysql_result($result,$i,"fname");
$last=mysql_result($result,$i,"lname");
}
$x = "0";
$query1= "SELECT * FROM reservations WHERE fname = '".$first."' and lname = '".$last."' and status = '".$x."' ";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);

$query2= "SELECT * FROM reservations WHERE fname = '".$first."' and lname = '".$last."' and status != '".$x."' ";
$result2=mysql_query($query2);
$num2=mysql_numrows($result2);

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
						<h1 class="highlight"> Reservation Summary </h1>
						</br>
						<center>
						<table class="list" >
						<h2 style="color:#fb0;"> Unconfirmed </h1>
							<tr>
								<th> Reservation Id &nbsp </th> 		
								<th> Reservation Date &nbsp </th>
								<th> Time &nbsp </th>
								<th> Persons &nbsp </th>
								<th> Venue &nbsp </th>
							</tr>
							<? $i; for ($i=0; $i < $num1; $i++){?>
							<tr style="text-align:center;">
								<td> <a href="view_details.php?id=<? echo mysql_result($result1,$i,"id"); ?>"> <? echo mysql_result($result1,$i,"rid"); ?> </td>
								<td> <? echo mysql_result($result1,$i,"rdate"); ?> </td>
								<td> <? echo mysql_result($result1,$i,"time"); ?> </td>
								<td> <? echo mysql_result($result1,$i,"persons"); ?> </td>
								<td> <? echo mysql_result($result1,$i,"venue"); ?> </td> 
							</tr>
							<? } ?>
							
						</table>
						<table class="list" >
						<h2 class="title"> Confirmed </h1>
							<tr>
								<th> Reservation Id &nbsp </th> 
								<th> Reservation Date &nbsp </th>
								<th> Time &nbsp </th>
								<th> Persons &nbsp </th>
								<th> Venue &nbsp </th>
							</tr>
							<? $i; for ($i=0; $i < $num2; $i++){?>
							<tr style="text-align:center;">
								<td> <a href="view_details.php?id=<? echo mysql_result($result2,$i,"id"); ?>"> <? echo mysql_result($result2,$i,"rid"); ?> </a> </td>
								<td> <? echo mysql_result($result2,$i,"rdate"); ?> </td>
								<td> <? echo mysql_result($result2,$i,"time"); ?> </td>
								<td> <? echo mysql_result($result2,$i,"persons"); ?> </td>
								<td> <? echo mysql_result($result2,$i,"venue"); ?> </td> 
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