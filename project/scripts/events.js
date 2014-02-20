var currDate;
var prevCell="";

function showSchedule(todayTxt) {
    loadPage("schedule.php", function(response) {
        document.getElementById("schedule").innerHTML = response;
//      dateTxt = "2014-1-5";
        showToday(todayTxt);
    });
}
function hideSchedule() {
    document.getElementById("schedule").innerHTML = "";
}
function showEvents(cell, dateTxt) {
    var date = new Date(dateTxt);
    highlightCell(cell);
    document.getElementById("eventDate").innerHTML = getMonthName(date.getMonth()) + " " + date.getDate() + ", " + date.getFullYear();
}
function showToday(todayTxt) {
    setCalendar(new Date(todayTxt), new Date(todayTxt), true);
}
function changeMonth(isNext, todayTxt) {
    var date = currDate;
    date.setDate(1);
    date.setMonth(currDate.getMonth() + (isNext?1:-1));
//    document.getElementById("debug").innerHTML = "<br />"+date;
    setCalendar(date, new Date(todayTxt));
}
function setCalendar(date, today, isShowToday) {
    currDate = date;
    var day = currDate.getDate();
    var month = currDate.getMonth();
    var year = currDate.getFullYear();
    var isCurrMonth = (today.getFullYear()==year && today.getMonth()==month);
    document.getElementById("month").innerHTML = getMonthName(month) + " " + year;
    setDays(getMonthFirstWDay(year, month), getMonthDays(year, month), isCurrMonth?today.getDate():0, isShowToday);
}
function setDays(firstWDay, numDays, today, isShowToday) {
    var dayCount = 0;
    var numWeeks = Math.ceil((firstWDay + numDays) / 7);
    prevCell = "";
    for(i=0; i<6; i++) {
        if(i>numWeeks-1) document.getElementById("row_"+i).style.display = "none";
        else {
            document.getElementById("row_"+i).style.display = "table-row";
          for(j=0; j<7; j++) {
                var cell = document.getElementById("cell_"+i+"_"+j);
                cell.className = "date cell";
                if(i==0 && j>=firstWDay || i>0 && dayCount<numDays) {
                    ++dayCount;
                    var cellDate = currDate;
                    cellDate.setDate(dayCount);
                    document.getElementById("date_"+i+"_"+j).innerHTML = dayCount;  
                    cell.setAttribute("onclick","showEvents(this,'"+cellDate+"')");
                    if(today>0 && dayCount==today) {
                        cell.className += " today";
                        if(isShowToday) showEvents(cell, cellDate);
                    }
                }
                else {
                    document.getElementById("date_"+i+"_"+j).innerHTML = "&nbsp;";
                    cell.onclick = "";
                }
            }
        }
    }
}
function highlightCell(cell) {
    if(cell != prevCell) {
        cell.className += " sel";
        if(prevCell!=cell) {
            if(typeof prevCell==typeof cell) prevCell.className = prevCell.className.replace(" sel", "");
            prevCell = cell;
        }
    }
}