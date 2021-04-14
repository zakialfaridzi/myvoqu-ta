// ambil elements yg di buutuhkan
var keyword = document.getElementById("keyword");

var container = document.getElementById("container");

// tambahkan event ketika keyword ditulis

keyword.addEventListener("keyup", function () {
	//buat objek ajax
	var xhr = new XMLHttpRequest();

	// cek kesiapan ajax
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			container.innerHTML = xhr.responseText;
		}
	};

	xhr.open(
		"GET",
		"http://7600f3cd41b5.ap.ngrok.io/myvoqu/friend/getUserByName/" + keyword.value,
		true
	);
	xhr.send();
});
