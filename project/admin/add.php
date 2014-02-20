<?php 
$page='Add Information';
include 'header.php'; 
?>		
<div id="contents">
	<div class="pageTitle"> <?php echo $page; ?> </div>
	<p style="padding-top:20px">
		<center>
			<a class="submit" href="manage_room_add.php"> Add Room </a>
			<a class="submit" href="manage_boarders.php"> Add Boarder </a>
			<a class="submit" href="manage_register.php"> Add Users </a>
			<a class="submit" href="payments.php"> Add Payments </a>
		<center>
		<center>
	</p>
</div>
<? include 'sidebar.php'; ?>
<? include 'footer.php'; ?>