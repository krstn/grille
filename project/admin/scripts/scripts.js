function showDropDown(){
	if (document.getElementById('dropdown').style.display != "block"){
		document.getElementById('dropdown').style.display = "block";
	}else {
		document.getElementById('dropdown').style.display = "none";
	}
}

function showImage() {
	document.getElementById('preview').style.display='block';
	document.getElementById('overlay').style.display='block'
}

function hideImage() {
	document.getElementById('preview').style.display='none';
	document.getElementById('overlay').style.display='none';
}

function confirmation() {
	var answer = confirm("Are you sure you want to log out?")
	if (answer){
		window.location = "logout.php";
	}
	else{
	}
}

function confirmations() {
	var answer = confirm("Are you sure you want to continue?")
	if (answer){
		window.location = "index.php";
	}
	else{
	}
}

function displayResult()
  {
  document.getElementById("mySelect").multiple=true;
  }

function goTo(){
	var s = window.location = "search_tab.php";
}