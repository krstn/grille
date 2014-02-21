var EVENT_STATUS = new Array("Unconfirmed","Confirmed","Cancelled","Done","Rejected");
var currDate, schedule, prevCell="";

function showSchedule(todayTxt) {
    loadPage("schedule.php", function(response) {
        document.getElementById("schedule").innerHTML = response;
        showToday(todayTxt);
    });
}

function hideSchedule() {
    document.getElementById("schedule").innerHTML = "";
}

function showEvents(cell, dateTxt) {
    var date = new Date(dateTxt);
    if(highlightCell(cell)) loadEvents(date);
}

function showToday(todayTxt) {
    setCalendar(new Date(todayTxt), new Date(todayTxt), true);
}

function changeMonth(isNext, todayTxt) {
    var date = currDate;
    date.setDate(1);
    date.setMonth(currDate.getMonth() + (isNext?1:-1));
//  document.getElementById("debug").innerHTML = "<br />"+date;
    setCalendar(date, new Date(todayTxt));
}

function loadSchedule() {
    var requestParams = "request=get_schedule&date="+(currDate.getFullYear()+ "-" +addLeadingZero(currDate.getMonth()+1)+ "-01");
    postPage("db_functions.php", requestParams, function(response) {
        parseScheduledEvents(response);
        setMonthEvents();
    });
}

function loadEvents(date) {
    var requestParams = "date="+formatDate(date);
    postPage("schedule_events.php", requestParams, function(response) {
        document.getElementById("events").innerHTML = response;
    });
}

function setCalendar(date, today, isShowToday) {
    currDate = date;
    var day = currDate.getDate();
    var month = currDate.getMonth();
    var year = currDate.getFullYear();
    var isCurrMonth = (today.getFullYear()==year && today.getMonth()==month);
    
    document.getElementById("month").innerHTML = getMonthName(month) + " " + year;
    setDays(getMonthFirstWDay(currDate), getMonthDays(year, month), isCurrMonth?today.getDate():0, isShowToday);
    setMonthEvents();
}

function setDays(firstWDay, numDays, today, isShowToday) {
    var dayCount = 0, cellCount = 0;
    var numWeeks = Math.ceil((firstWDay + numDays) / 7);
    prevCell = "";
    
    for(i=0; i<6; i++) {
        if(i>numWeeks-1) document.getElementById("row_"+i).style.display = "none";
        else {
            document.getElementById("row_"+i).style.display = "table-row";
            for(j=0; j<7; j++) {
                cellCount++;
                var cell = document.getElementById("cell_"+cellCount);
                cell.className = "date cell";
                document.getElementById("event_"+cellCount).innerHTML = "&nbsp;";
                
                if(i==0 && j>=firstWDay || i>0 && dayCount<numDays) {
                    ++dayCount;
                    var cellDate = currDate;
                    cellDate.setDate(dayCount);
                    document.getElementById("date_"+cellCount).innerHTML = dayCount;  
                    cell.setAttribute("onclick","showEvents(this,'"+cellDate+"')");
                    
                    if(today>0 && dayCount==today) {
                        cell.className += " today";
                        if(isShowToday) showEvents(cell, cellDate);
                    }
                }
                else {
                    document.getElementById("date_"+cellCount).innerHTML = "&nbsp;";
                    cell.onclick = "";
                }
            }
        }
    }
}

function setMonthEvents() {
    if(schedule==undefined) loadSchedule();
    else {
        var startDate = new Date(schedule.start);
        var endDate = new Date(schedule.end);
        if(currDate < startDate || currDate > endDate) loadSchedule();
        else {
            var firstWDay = getMonthFirstWDay(currDate);
            var monthEvents = getCurrMonthEvents();
            if(monthEvents != null) {
                for(i=0; i<monthEvents.length; i++) {
                    var eventDate = monthEvents[i].date;
                    var eventItems = monthEvents[i].items;
                        for(j=0; j<eventItems.length; j++) {
                            if(j==0) document.getElementById("event_"+(eventDate+firstWDay)).innerHTML = "";
                            document.getElementById("event_"+(eventDate+firstWDay)).innerHTML += "<span class='color"+ EVENT_STATUS[eventItems[j].status] +"'> &#9679; </span>";
                        }
                }
            }
        }
    }
}

function getCurrMonthEvents() {
    var currMonthDate = currDate;
    currMonthDate.setDate(1);
    var currMonthDateTxt = formatDate(currMonthDate);
    for (var i=0; i<schedule.events.length; i++){
        if (schedule.events[i].month == currMonthDateTxt) return schedule.events[i].dates;
    }
    return null;
}

function parseScheduledEvents(scheduleTxt) {
    schedule = eval ("(" + scheduleTxt + ")");;
}

function highlightCell(cell) {
    if(cell != prevCell) {
        cell.className += " sel";
        if(typeof prevCell==typeof cell) prevCell.className = prevCell.className.replace(" sel", "");
        prevCell = cell;
        return true;
    }
    return false;
}

function formatDate(date) {
    return date.getFullYear()+ "-" +addLeadingZero(date.getMonth()+1)+ "-" + addLeadingZero(date.getDate());
}