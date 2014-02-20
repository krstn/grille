<?
include 'header.php';
?>
            
            <p style="color:#fff;">We at <b style="color:#DE1B1B;">Grill Guru</b> believes that Human Resource is one of the most valued assets to whom the company commits its encouragement and support in developing skills and personal initiatives while rewarding productivity and ingenuity.  </p> <br>
			<p style="color:#fff;">Moreover, Grill Guru continuously aims to provide equal opportunities to those deserving of such in our effort to be one of the significant contributors of change and in the elevation of the greater majority in the local community while boosting the local tourism industry. </p> <br>
			<p style="color:#fff;">Find out what opportunities that awaits every individual and how committed we are as a company. You take the initiative.We at Grill Guru provide endless opportunities. </p> <br>
			<p style="color:#fff;">You may submit your application letter and Curriculum Vitae with picture to:</p> 
			<h3 class="title" > contact@grillguru.com.ph </h3> <br>	
			<h3 style="color:#fb0;" > Thank you. </h3>
				<?echo date('H:i:s');?>
			
			
<div id="clockDisplay" class="clockStyle"></div>
<script type="text/javascript" language="javascript">
function renderTime() {
var currentTime = new Date();
var diem = "AM";
var h = currentTime.getHours();
var m = currentTime.getMinutes();
    var s = currentTime.getSeconds();
setTimeout('renderTime()',1000);
    if (h == 0) {
h = 12;
} else if (h > 12) { 
h = h - 12;
diem="PM";
}
if (h < 10) {
h = "0" + h;
}
if (m < 10) {
m = "0" + m;
}
if (s < 10) {
s = "0" + s;
}
    var myClock = document.getElementById('clockDisplay');
myClock.textContent = h + ":" + m + ":" + s + " " + diem;
myClock.innerText = h + ":" + m + ":" + s + " " + diem;
}
renderTime();
</script>
        </div>
		
        </center>
    </body>
</html>