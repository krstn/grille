<div class="popup">
    <div id="debug">
        <?
$today = date_create();
$todayTxt = date_format($today, "Y-m-d");
//echo "<br />". date(Y);
//$nowMonth = date_format($now, "n");
//$nowYear = date_format($now, "n");
//echo "<br />". $month;
//$prevMonth = date_create();
//$nextMonth = date_create();
//date_date_set($prevMonth, 2001, 1, 28);
//date_date_set($nextMonth, 2001, 1, 28);
//date_sub($prevMonth, date_interval_create_from_date_string('1 months'));
//date_add($nextMonth, date_interval_create_from_date_string('1 months'));

//date_date_set($today, 2001, 8, 3);
//echo "<br />". date_format($now, "Y m d");
//echo "<br />". date_format($nextMonth, "Y m d");
//echo "<br />". date_format($prevMonth, "Y m d");

//echo "<br />". date_format($today, "Y m d N D");
?>
    </div>
    <div class="schedule">
        <div id="popout" class="clickable" onclick="hideSchedule()">
            <img src="images/close.png" />
        </div>
        <div class="title">Reservations Calendar</div>
        <div class="contents"> 
            <div class="head" >
                <div id="month" class="date">&nbsp;</div>
                <div class="controls" unselectable="on" onselectstart="return false;" onmousedown="return false;">
                    <a onclick="showToday('<?echo date('Y-m-d')?>')">TODAY</a> &nbsp;&nbsp;
                    <a onclick="changeMonth(false, '<?echo date('Y-m-d')?>')">Prev</a> &#8226;
                    <a onclick="changeMonth(true, '<?echo date('Y-m-d')?>')">Next</a>
                </div>
            </div>
            <div id="calendar" class="calendar table">
                <div class="days row">
                    <? for($i=0; $i<7; $i++) { ?>
                    <div class="day cell"> <?echo date("D", strtotime("2014-W01-".$i));?></div>
                    <? } ?>
                </div>
                <? for($i=0; $i<6; $i++) { ?>
                <div id="row_<?echo $i?>" class="dates row">
                    <? for($j=0; $j<7; $j++) { ?>
                    <div id="cell_<?echo $i.'_'.$j?>" class="date cell">
                        <div id="date_<?echo $i.'_'.$j?>">&nbsp;</div>
                        <div id="event" class="indicator">&nbsp;</div>
                    </div>
                    <? } ?>
                </div>
                <? } ?>
<!--
                <div class="dates row">
                    <div class="date cell">
                        <div>10</div>
                        <div class="indicator">&nbsp;</div>
                    </div>
                    <div class="date cell">
                        <div>10</div>
                        <div class="indicator">
                            <span class="colorConfirmed">&#9679;</span>
                            <span class="colorCancelled">&#9679;</span>
                            <span class="colorDone">&#9679;</span>
                            <span class="colorRejected">&#9679;</span>
                        </div>
                    </div>
                </div>
-->
            </div>
            <div>
                <span class="colorConfirmed">&#9679;</span> Confirmed &nbsp;
                <span class="colorCancelled">&#9679;</span> Cancelled &nbsp;
                <span class="colorDone">&#9679;</span> Done &nbsp;
                <span class="colorRejected">&#9679;</span> Rejected &nbsp;
            </div>
            <div class="events">
<!--
                <div class="head">
                    You have <span class="highlight">no scheduled reservations</span> for February 17, 2014.
                </div>
-->
                <div class="head">
                    <div id="eventDate" class="date">&nbsp;</div>
                </div>
                <div class="items table">
                    <div class="row">
                        <div class="cell">
                            <div class="type colorConfirmed">
                                <span class="time confirmed">10:00 AM</span>Confirmed
                                <span class="posted">2014-02-12</span>
                            </div>
                            <div class="details">
                                <b>Dining Room, 3 Guests</b><br />
                                Kenneth James Peromingan<br />
                                09123144553<br />
                                my.name@email.com
                            </div>
                        </div>
                        <div class="cell">
                            <div class="type colorCancelled">
                                <span class="time cancelled">10:00 AM</span>Cancelled
                                <span class="posted">2014-02-08</span>
                            </div>
                            <div class="details">
                                <b>Dining Room, 3 Guests</b><br />
                                Kenneth James Per dfsa fsd fsd f asf asdomingan<br />
                                09123144553<br />
                                my.name@email.com
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cell">
                            <div class="type colorDone">
                                <span class="time done">10:00 AM</span>Done
                                <span class="posted">2014-02-08</span>
                            </div>
                            <div class="details">
                                <b>Alfresco, 5 Guests</b><br />
                                Podrick Payne<br />
                                09123144553<br />
                                my.name@email.com
                            </div>
                        </div>
                        <div class="cell">
                            <div class="type colorRejected">
                                <span class="time rejected">10:00 AM</span>Rejected
                                <span class="posted">2014-02-12</span>
                            </div>
                            <div class="details">
                                <b>Dining Room, 3 Guests</b><br />
                                Daenerys Stormborne<br />
                                09123144553<br />
                                my.name@email.com
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>