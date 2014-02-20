<?php 
$page='About';
$login=false;

include "header.php";
include 'db_access.php';

$showForm=true;
$errorMsg="";

$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");



if (isset($_POST["fname"])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$email=$_POST["email"];
	$message=$_POST["message"];
	
	if ((strlen($fname)>0) && (strlen($lname)>0) && (strlen($email)>0) && (strlen($message)>0)){
		
		
		$query = "INSERT INTO contact VALUES ('','" . $fname . "', '" . $lname . "', '" . $email . "', '" . $message . "')";
		if (!mysql_query($query,$con)){
			$errorMsg="Cannot proceed with adding feedback: ".mysql_error();
		}
		else $showForm=false;
		mysql_close();
	}
	else $errorMsg="Error: Please fill in all the required fields.";
}
?>
		
        <div class="pageTitle">What to Expect </div>
					<div id="say" style="margin:10px; padding:4px; ">
					<p style="color:#fff;">&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp &nbsp       For those of us	who put so much of ourselves into <b style="color:#DE1B1B;">Grill Guru</b> it's more than our work - it's our home. And that's how
					 we try to  welcome you - as a guest in a home we love, 	that we're proud of and eager for you to love, too. We want you to feel special when you're here,
					 we want you to expect that everything, every last detail is taken care of for you so that you are welcomed, relaxed and at ease. And most of all happy.
					 Because that's really what it's all about. We don't want to impress you. We want to cook for you and make you happy.</p>
				</div>
				<div class="pageTitle" > Visit Us </div>
				<div>
					<iframe id="map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.ph/maps/ms?msa=0&amp;msid=213200117373848078899.0004ca446c6d6e4bf22ff&amp;hl=en&amp;ie=UTF8&amp;t=m&amp;ll=10.68005,122.964649&amp;spn=0.00738,0.00912&amp;z=16&amp;iwloc=lyrftr:m,3146620982582131211,10.678002,122.965137&amp;output=embed"></iframe>
					Kamunsil St. corner C.L. Montelibano Avenue <br />
					Bacolod City, Negros Occidental <br />
					Philippines 
					<hr style="color:#ccc;">
					Telephone number: 	(034) 708 9520 <br />
					<hr style="color:#ccc;">
					Hours of Operation: Mon - Sun: 11:00 am - 2:00 pm, 5:00 pm - 10:00 pm<br />
					<hr style="color:#ccc;">
					Culinary Team: Executive Chef Richard Ynayan<br />
					<hr style="color:#ccc;">
					General Manager: Joel Lerma<br />
					<hr style="color:#ccc;">
					<p>Like us on facebook</p>
					<a href="http://www.facebook.com/pages/Grill-Guru/196936233690495?ref=ts&fref=ts" target="_blank"> <img	 src="icons/facebook.png" style="height:60px; width:60px;"/> <img	 src="icons/t.png" style="height:62px; width:62px;"/> </a> <br><br><br><br><br>
					
				</div>
				
				<div class="pageTitle" style="clear:both; "> Contact Us </div>
				<form method="post" action="about.php">
					
					<div class="error"> <?php echo $errorMsg; ?> </div>
					<table >
						<tr>
							<td>First Name: </td>
							<td> <input type="text" name="fname"  /> </td>
						</tr>
						<tr>
							<td>Last Name: </td>
							<td> <input type="text"name="lname"  /> </td>
						</tr>
						<tr>
							<td>E-mail: </td>
							<td> <input type="text"name="email" /> </td>
						</tr>
						<tr>
							<td>Message: </td>
							<td> <textarea name="message" > </textarea> </td>
						</tr>
					</table> 
					</br>
					<input class="buttonz" type="submit" name="submit" value="Send"/>
					<input class="buttonz" type="reset"  value="Reset"/>
					
				</form>
        </div>
		
        </center>
    </body>
</html>