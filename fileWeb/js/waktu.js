window.setTimeout("waktu()",1000); 
function waktu() { 
	var tanggal = new Date(); 
	setTimeout("waktu()",1000);
	var jam 	= tanggal.getHours(); 
	var menit 	= tanggal.getMinutes();
	var detik 	= tanggal.getSeconds();
	// document.getElementById("detik").innerHTML = tanggal.getSeconds();
	var time = jam + menit + detik;
}

