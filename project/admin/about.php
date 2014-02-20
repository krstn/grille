<?php 
$page='About';
$login=false;

include "header.php";
include 'db_access.php';

$showForm=true;
$errorMsg="";

$con = mysql_connect($dbHost,$dbUser,$dbPass);
		@mysql_select_db($dbName) or die("Unable to open database");




?>		
			<div id="contents">
				<div id="slider">
						
							<img src="images/2.jpg" />
							<img src="images/3.jpg" />
							<img src="images/4.jpg" />
							<img src="images/5.jpg" />
							<img src="images/6.jpg" />
						</div>
				<table>
					<tr >
				<td style="width:30%; ">
				<div class="pageTitle" > <a href="#" style="color:#fff; font-family:Prime;">About CVKC </a> </div>
				<br />
				<p style="color:#000;"> <b style="color:#000;"> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp CVKC Motorcycle parts Center </b> is owned by <b style="color:#fea904;"> Mr. Danmar Capanas </b>  and is located at corner  Ln.
				Agustin Drive Molave St., Bacolod City. CVKC is formerly knowned  as Marparts Cycle. CVKC is the number 1 wholesale and retailer of motorcycle parts
				on the Negros Island. We are completely dedicated to serving the needs of every Negrense and committed to do so for the next generations selling at the
				lowest rates with high quality products. </p>
				<br />
				<div class="pageTitle" > <a href="#" style="color:#fff; font-family:Prime;">What to expect </a> </div>
					<p style="color:#000;">For those of us	who put so much of ourselves into <b style="color:#fea904;"> CVKC Motorcycle Parts Center</b> it's more than our work - it's our home. And that's how
					 we try to  welcome you - as a guest in a home we love, 	that we're proud of and eager for you to love, too. We want you to feel special when you're here,
					 we want you to expect that everything, every last detail is taken care of for you so that you are welcomed, relaxed and at ease. And most of all happy.
					 Because that's really what it's all about. We don't want to impress you. We want to serve you and make you happy.</p>		
				</td>
				<td style="width:30%; ">
				 
				<center> <img src="images/arloLo.jpg" style="width:600px; height:700px;"/>
				<br />
				<b style="color:#fea904;"> CVKC Moto Parts Center </b>
				</center>
				
				</td>
				</tr>
				</table>
				<hr style="width:50%;">
			</div>
	<? include 'sidebar.php'; ?>
	<? include 'footer.php'; ?>	