// ambil elements yg di buutuhkan
var keyword = document.getElementById("keyword");

var container = document.getElementById("container");

// tambahkan event ketika keyword ditulis

var pageURL = window.location.href;
var lastURLSegment = pageURL.substr(pageURL.lastIndexOf('/') + 1);
// console.log(lastURLSegment);

keyword.addEventListener("keyup", function () {
	//buat objek ajax


	var xhr = new XMLHttpRequest();

	// cek kesiapan ajax
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			container.innerHTML = xhr.responseText;
		}
	};

	if (lastURLSegment == 'friend') {

		xhr.open(
			"GET",
			"https://e24d4df0a322.ap.ngrok.io/myvoqu/friend/getUserByName/" + keyword.value,
			true
		);
	} else {
		xhr.open(
			"GET",
			"https://e24d4df0a322.ap.ngrok.io/myvoqu/infaq/getUserByNameMentor/" + keyword.value,
			true
		);
	}

	xhr.send();


});
