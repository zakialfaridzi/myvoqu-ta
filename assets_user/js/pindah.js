// ambil elements yg di buutuhkan
var keyword = document.getElementById("pbi");

var container = document.getElementById("ctn");

// tambahkan event ketika keyword ditulis

keyword.addEventListener("click", function () {
	//buat objek ajax
	var xhr = new XMLHttpRequest();

	// cek kesiapan ajax
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			container.innerHTML = xhr.responseText;
		}
	};

	xhr.open("GET", "http://localhost/myvoqu/profile/editProfileImage", true);
	xhr.send();
});

var keyword2 = document.getElementById("bi");
var ctn = document.getElementById("ctn");

var keyword2 = document.getElementById('bi');
var ctn = document.getElementById('ctn');


keyword2.addEventListener('click', function () {

	//buat objek ajax
	var xhr = new XMLHttpRequest();

	// cek kesiapan ajax
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			ctn.innerHTML = xhr.responseText;
		}
	};

	xhr.open('GET', 'http://localhost/myvoqu/profile/editProfile2', true);
	xhr.send();

});
