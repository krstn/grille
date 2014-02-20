<?
session_start();
include 'header.php';
include_once 'db_access.php';

$showForm=true;
$date = date("Y-m-d");
$minDate = date("Y-m-d", strtotime($date. " + 1 days"));

if (!isset ($_POST["submit"])){
    $rdate = $minDate;
    $user = $_COOKIE['user'];
    $query="SELECT * FROM users WHERE username ='".$user."' ";
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    
    if($num==1) {
        $fname = ucwords(mysql_result($result,0,"fname"));
        $lname = ucwords(mysql_result($result,0,"lname"));
        $address = ucwords(mysql_result($result,0,"address"));
    }
} 
else{
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$address=$_POST["address"];
	$mobile=$_POST["mobile"];
	$email=$_POST["email"];
	$rdate=$_POST["rdate"];
	$time=$_POST["time"];
	$venue=$_POST["venue"];
	$persons=$_POST["persons"];
	$rid=$_POST["rid"];
	$status=$_POST["status"];
    
    //TODO:
    $timeEnd=substr($time, 0, 2) + 3 . ":00:00";
    $penalty=0;
    $total=0;
    
    if($rid == $_SESSION['transactionId']) {
        $showForm=false;
    }
    else if ($rdate < $minDate) {
        $errorMsg = "Error: The date you are trying to reserve has already passed or invalid. For more info, contact us @<a href='tel:+63-34-708-9520'>(034) 708 9520</a>. Thank you.";
    }
    else if ((strlen($fname)>0) && (strlen($lname)>0) && (strlen($address)>0) && (strlen($mobile)>0) && (strlen($email)>0)) {
        $query = "INSERT INTO reservations VALUES ('','" . $rid . "', '" . $persons . "', '" . $fname . "', '" . $lname . "', '" . $address . "', '" . $date. "', '" . $mobile . "', '" . $email . "', '" . $rdate . "', '" . $time . "', '" . $timeEnd . "', '" . $venue . "', '" . $status . "', '" . $penalty . "', '" . $total . "')";
       if (!mysql_query($query,$con)){
            $errorMsg="Sorry. We cannot process your Reservation at this time. Please contact us @<a href='tel:+63-34-708-9520'>(034) 708 9520</a> for assistance. <br /><br />
            Error: ".mysql_error().".";
        }
        else {
            $showForm=false;
            $_SESSION['transactionId']=$rid;
        }
    }
    else $errorMsg="Error: Please fill in all the required fields.";
    mysql_close();
}
?>
            
<div id="reserve">
    <?php if ($showForm){ ?>				
        <form  method="post" action="reserve.php">
            <div class="title">Reservation Form</div>
            <div>
                <a onclick="showSchedule('<?echo date('Y-m-d')?>')"><img  class="middle" src="images/calendar_small.png" /></a>
                See <a onclick="showSchedule('<?echo date('Y-m-d')?>')">Available Dates</a>
            </div>
            <span class="contents">
                <div class="inputs">
                    <div><div class="error cell"><?php echo $errorMsg; ?></div></div>
                    <div class="row">
                        <div class="cell">
                            <div>First Name <span class="highlight">*</span></div>
                            <input class="text" type="text" name="fname" value="<?echo $fname;?>" />
                        </div>
                        <div class="cell">
                            <div>Last Name <span class="highlight">*</span></div>
                            <input class="text" type="text" name="lname" value="<?echo $lname;?>" />
                        </div>
                    </div>
                    <div>
                        <div class="cell">
                            <div>Address <span class="highlight">*</span></div>
                            <input class="text long" type="text" name="address" value="<?echo $address;?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell">
                            <div>Phone / Mobile <span class="highlight">*</span></div>
                            <input class="text" type="tel" name="mobile" value="<?echo $mobile;?>" />
                        </div>
                        <div class="cell">
                            <div>Email <span class="highlight">*</span></div>
                            <input class="text" type="email" name="email" value="<?echo $email;?>" />
                        </div>
                    </div>
                    <div>
                        <div class="cell">
                            <div>Reservation Date</div>
                            <input class="text" type="date" name="rdate" value="<?echo $rdate;?>" min="<?echo $minDate;?>" />
                        </div>
                        <div class="cell">
                            <div>Reservation Time</div>
                            <select name="time">
                                <? for($i=10; $i<=20; $i++){ 
                                    $val = $i.":00:00";
                                    if($i>12) $text = ($i-12).":00:00 PM";
                                    else $text = $val." AM";
                                ?>
                                    <option value="<? echo $val; ?>" <? if($time == $val){?> selected="selected" <?}?> >
                                        <?echo $text; ?>
                                    </option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell">
                            <div>Preferred Room </div>
                            <select name="venue"> 
                                <option value="Dining Room" <? if($venue == "Dining Room"){?> selected="selected" <?}?> >Dining Room</option>
                                <option value="Function Room" <? if($venue == "Function Room"){?> selected="selected" <?}?> >Function Room</option>
                                <option value="Alfresco" <? if($venue == "Alfresco"){?> selected="selected" <?}?> >Al Fresco</option>
                            </select>
                        </div>
                        <div class="cell">
                            <div>Guests</div>
                            <select name="persons">
                                <? for($i=1; $i<=9; $i++){ ?>
                                <option value="<? echo $i; ?>" <? if($persons == $i){?> selected="selected" <?}?>  > <? echo $i; ?> </option>
                                <? } ?>
                            </select> 
                        </div>
                    </div>
                
                    <div><div class="cell">
                        <input type="hidden" name="rid" value="<?echo rand() ."\n";?>" />
                        <input type="hidden" name="status" value="0" />
                        <input type="hidden" name="penalty" value="0" />
                    </div></div>
                    
                    <div class="action"><input class="button" type="submit" name="submit" value="Continue" /></div>
                </div>
            </span>
        </form>
        <div class="confirmation">
            <div class="proceed">Party of <span class="highlight">10+</span>?</div>
            <div>For <b>Events Planning</b> or Reservations with <b>10</b> or <b>more</b> persons, please <b>contact us</b> so we could better accommodate your specific needs.</div>
            <center>
                <div class="contact">
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
            </center>
        </div>
    <? } else { ?>
        <div class="confirmation">
            <div class="title">Your Reservation was <span class="highlight">Successfully Sent!</span></div>
            <p>We assure you that you will get your <b>confirmation</b> at your provided <b>contact no.</b> as soon as possible. Thank you.</p>
            <div class="proceed">Go to <a href="view_summary.php">My Reservations</a></div>
        </div>
    <?  } ?>	   
</div>			 

<? include 'footer.php'; ?>
<div id="schedule"></div>