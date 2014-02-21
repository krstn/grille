<div class="popup">
    <div id="debug"></div>
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
                    <? 
                    $cellCount=0;
                    for($i=0; $i<7; $i++) { 
                    ?>
                        <div class="day cell"> <?echo date("D", strtotime("2014-W01-".$i));?></div>
                    <? } ?>
                </div>
                <? for($i=0; $i<6; $i++) { ?>
                <div id="row_<?echo $i?>" class="dates row">
                    <? 
                    for($j=0; $j<7; $j++) { 
                        $cellCount++;
                    ?>
                        <div id="cell_<?echo $cellCount?>" class="date cell">
                            <div id="date_<?echo $cellCount?>">&nbsp;</div>
                            <div id="event_<?echo $cellCount?>" class="indicator">&nbsp;</div>
                        </div>
                    <? } ?>
                </div>
                <? } ?>
            </div>
            <div>
                <span class="colorConfirmed">&#9679;</span> Confirmed &nbsp;
                <span class="colorCancelled">&#9679;</span> Cancelled &nbsp;
                <span class="colorDone">&#9679;</span> Done &nbsp;
                <span class="colorRejected">&#9679;</span> Rejected &nbsp;
            </div>
            <div id="events" class="events"></div>
        </div>
    </div>
</div>