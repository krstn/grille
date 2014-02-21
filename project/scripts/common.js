function loadPage(url, callback) {
    var xmlhttp;
    if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
    else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            callback(xmlhttp.responseText);
        }
    };
    
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function postPage(url, vars, callback){
    var xmlhttp;
    if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest(); // code for IE7+, Firefox, Chrome, Opera, Safari
    else xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); // code for IE6, IE5
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            callback(xmlhttp.responseText);
        }
    };
    
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(vars);
    //var vars = "firstname="+fn+"&lastname="+ln;
}

function getDivChildCount(element) {
    var count = 0;
    for (var i=0; i<element.childNodes.length; i++) {
        var node = element.childNodes[i];
        if (node.nodeType == Node.ELEMENT_NODE && node.nodeName == "DIV") count++;
    }
    return count;
}

//function log(text) {
//    logElement.innerHTML = text;
//}

function animate(options) {
    var start = new Date; 
    clearInterval(slideAnimInterval);
    slideAnimInterval = setInterval(function() {
        var timePassed = new Date - start;
        var progress = timePassed / options.duration;
        if (progress > 1) progress = 1;
        var delta = options.delta(progress);
        options.step(delta);
        
        if (progress == 1) clearInterval(slideAnimInterval);
    }, options.delay || 10);
}

function linear(progress) {
  return progress;
}

function easeIn(progress) {
  return Math.pow(progress, 2);
}

function easeOut(progress) {
  return (2 * progress) - Math.pow(progress, 2);
}

function getMonthName(month) {
    monthNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
    return monthNames[month];
}

function getMonthDays(year, month) {
    return new Date(year, month+1, 0).getDate();
}

function getMonthFirstWDay(date) {
    return new Date(date.getFullYear(), date.getMonth(), 1).getDay();
}

function addLeadingZero(num) {
    if(num < 10) num = "0" + num;
    return num;
}