// Get the modal

function alert(){
	var modal = document.getElementById('myModal');
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks the button, open the modal 
	this.menu = function(cid,country,flag) {
	    modal.style.display = "block";
	    document.getElementById('dialog-title').innerHTML = country;
	    document.getElementById('dialog-id').innerHTML = cid;
	    document.getElementById('dialog-flag').innerHTML = flag;
	};
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	    document.getElementById('flag_hint').innerHTML = "Status";
	};
	
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	        document.getElementById('flag_hint').innerHTML = "Status";
	    }
	};
}

var Alert = new alert();

//Windows Side Menu

function openNav() {
	var winH = window.innerHeight;
    document.getElementById("mySidenav").style.width = "25%";
    document.getElementById("main").style.marginLeft = "25%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}