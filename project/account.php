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
            
            <div id="social">
                <a href="https://www.facebook.com/profile.php?id=100002584601251&fref=ts" target="-blank"><img src="images/social_facebook.png"></a>
                <a href="https://twitter.com/grillgurubcd" target="-blank"><img src="images/social_twitter.png"></a>
                <a href="index.php" target="-blank"><img src="images/social_instagram.png"></a>
            </div>
			
			<div id="info">
			</br>
                <div class="title"> My <span class="highlight">Profile</span></div>
                <div class="contents">
				<div id="acc">
                    <?  $i; for ($i=0; $i < $num; $i++){?>
						<h2> <b class="highlight"> <? echo mysql_result($result,$i,"gender"); ?> </b> <? echo mysql_result($result,$i,"fname"); ?> <b style="color:#fb0;"> <? echo mysql_result($result,$i,"lname"); ?> </b> </h2>
						<ul style="font-size:20px;">
							<li> Address: <? echo mysql_result($result,$i,"address"); ?> </li>
							<li> Mobile: <? echo mysql_result($result,$i,"mobile"); ?> </li>
							<li> Email : <? echo mysql_result($result,$i,"email"); ?> </li>
						</ul>
						
						<a href="view_summary.php"> VIEW MY RESERVATIONS </a> </br>
						<a href="view_msg.php"> VIEW MY MESSAGES </a> </br>
						<a href="#"> UPDATE ACCOUNT </a>
					<? } ?>
				
				</div>
                    <div class="right">
                        <div id="contact">
                            <div class="item">
                                <div><img src="images/contact_address.png" /></div>
                                <div>Kamunsil St., cor. C.L. Montelibano Ave., 6100 Bacolod City</div>
                            </div>
                            <div class="item">
                                <div><img src="images/contact_phone.png" /></div>
                                <div><a href="tel:+63-34-708-9520">(034) 708 9520</div>
                            </div>
                            <div class="item">
                                <div><img src="images/contact_email.png" /></div>
                                <div><a href="mailto:contact@grillguru.com">contact@grillguru.com</a></div>
                            </div>
							
                        
                    </div>
                </div>
            </div>
			
           </div>
        </center>
    </body>
    
</html>