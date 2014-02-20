		<? if ($login==true) { ?>
		<div id="menu" onClick="showDropDown()">
			
			<div id="dropdown">
			
				<? if ($_COOKIE["type"]=="admin"){ ?>			
				<p> <a href="add.php"> Add  </a> </p>
				<p> <a href="search.php"> Search  </a> </p>
				<p> <a href="view.php"> View </a> </p>
				<p> <a href="news.php"> News </a> </p>
				<p> <a href="manage_rules.php"> Policies </a> </p>
				<p> <a href="feedback.php"> Feedbacks </a> </p>
				<p>	<a href="forms_year.php"> Reports </a> </p>
				<p>	<a href="codes.php"> Payment codes </a> </p>
				<p>	<a href="verify.php"> Verify Registrations </a> </p>
				<p> <a href="messages.php"> Inbox </a> </p>
				<p> <a href="messagesOut.php"> Outbox </a> </p>
				<? } ?>
				<? if ($_COOKIE["type"]=="boarder"){ ?>	
				<p> <a href="all_payments.php"> View all payments </a> </p>				
				<p> <a href="account.php"> My Account </a> </p>
				<p> <a href="mymessages.php"> Inbox </a> </p>
				<p> <a href="sendmsg.php"> Contact Admin </a> </p>
				<? } ?>
				<? if ($_COOKIE["type"]=="guest"){ ?>	
				<p> <a href="mymessages.php"> Inbox </a> </p>
				<p> <a href="sendmsg.php"> Contact Admin </a> </p>
				<? } ?>
				
			</div>
		</div>
		<? } ?>