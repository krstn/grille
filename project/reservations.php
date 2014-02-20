<? include 'header.php'; ?>

<div id="terms" >
    <div class="title">Our Terms and Conditions for <span class="highlight">RESERVATION</span></div>
    <p><i>Please read these Terms and Conditions <b>thoroughly before</b> placing your Reservations. Thank you.</i></p>
    <ul class="contents">
        <li><span class="subject">Membership</span>
            <div>Before anything else, we would like you to be a registered <span class="highlight"><b>Grill Guru</b></span> Member before placing a Reservation. Please <a href="login.php">Login</a> to your Account or <a href="registration.php">Sign up</a> if you haven't got one yet.</div>
        </li>
        <li><span class="subject">Approval</span>
            <div>All Reservations are subject for <b>approval by the Management</b>. Thorough review of the Reservation details is necessary to ensure customer satisfaction.</div>
            <div>A <b>valid contact number</b> must be provided in the Reservation Forms. <span class="highlight"><b>Grill Guru</b></span> will confirm  your Reservation status within a <b>full business cycle</b> or <b>a day</b>.</div>
        </li>
        <li><span class="subject">Date &amp; Time</span>
            <div>All Reservations must be booked at least <b>3 days prior</b> to the desired Reservation date. </div>
        </li>
        <li><span class="subject">Packages and Fees</span>
            <div>Reservations with less than <b>10 persons</b> are not eligible to avail of our Reservation Packages. Reservation Fees are also waived.</div>
            <div>A <b>minimum of 10 persons</b> is required in order to avail of any of our <b>Reservation Packages</b>. A Reservation Fee of <b>Php100 per person</b> is charged thereupon.</div>
        </li>
        <li><span class="subject">Duration</span>
            <div>All Reservations are booked for a maximum of <b>3 hours</b> only. For events that would need <b>extra time</b>, an additional <b>Php0.50 per person per hour</b> will be charged.</div>
        </li>
        <li><span class="subject">No-Show Cancellation</span>
            <div>All Reservations are allowed <b>1 hour grace time</b> before getting forfeited.</div>
        </li>
    </ul>
</div>

<div class="confirmation">
    <div class="proceed">
        <?if (!$login){ ?>
            <a href="login.php">Login</a> or <a href="registration.php"> Sign Up </a> now to Reserve!
        <? } else { ?>
<!--if ($_COOKIE["type"]=="admin")-->
            Proceed to <a href="reserve.php">Reservations</a> now!
        <? }  ?>
    </div>
    <div>
        <a onclick="showSchedule('<?echo date('Y-m-d')?>')"><img src="images/calendar.png" /></a><br />
        or see our <a onclick="showSchedule('<?echo date('Y-m-d')?>')">Available Dates</a>
    </div>
</div>

<? include 'footer.php'; ?>
<div id="schedule"></div>