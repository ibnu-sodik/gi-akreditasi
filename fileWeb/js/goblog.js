// waktu
window.setTimeout("waktu()",1000); 
function waktu() { 
	var tanggal = new Date(); 
	setTimeout("waktu()",1000);
	var jam 	= tanggal.getHours(); 
	var menit 	= tanggal.getMinutes();
	var detik 	= tanggal.getSeconds();
	var hasil 	= jam + ':' + menit +':'+ detik;
	$("#timestamp").html(hasil);
}

// fixed navbar
// window.onscroll = function() {myFunction()};

// var navbar = document.getElementById("main-nav");
// var sticky = navbar.offsetTop;

// function myFunction() {
// 	if (window.pageYOffset >= sticky) {
// 		navbar.classList.add("sticky")
// 	} else {
// 		navbar.classList.remove("sticky");
// 	}
// }