
function verif(max) {
	max = parseInt(max);
	if (max == 0) {
		document.getElementById("btn1").style.visibility = "hidden";
		document.getElementById("btn2").style.visibility = "hidden";
		document.getElementById("p3").style.visibility = "visible";
	}
}



document.getElementById('optionsBtn').addEventListener('click', function () {

	var optionsMenu = document.getElementById('optionsMenu');

	if (optionsMenu.style.display === 'none') {
		optionsMenu.style.display = 'block';
	}
	else {
		optionsMenu.style.display = 'none';
	}
});

document.getElementById('report').addEventListener('click', function () {
	document.getElementById('profile').classList.add('blur-effect');
	document.getElementById('reportForm').style.display = 'block';
});

$(document).ready(function () {
	$("#reportBtn").click(function () {
		var reportReason = $("#reportReason").val();
		$.ajax({
			url: '../../admin/report.php',
			type: 'post',
			data: {
				'reporter': userName,
				'reported': recipientName,
				'reason': reportReason
			},
			success: function (response) {

			}
		});
	});
});

window.addEventListener('click', function (e) {
	if (!document.getElementById('reportForm').contains(e.target) && e.target.id !== 'report') {
		document.getElementById('reportForm').style.display = 'none';
		document.getElementById('profile').classList.remove('blur-effect');
	}
});

document.getElementById('add').addEventListener('click', function () {

	if (subRecipient !== "unsub" && recipientRole !== 'banned') {
		if (this.className == "bx bx-user-plus") {
			this.className = "bx bx-user-minus";
			$.ajax({
				url: '../../subscription/addContact.php',
				type: 'post',
				data: {
					'asker': userName,
					'receiver': recipientName
				},
				success: function (response) {

				}
			});
		}
		else {
			this.className = "bx bx-user-plus";
			$.ajax({
				url: '../../subscription/removeContact.php',
				type: 'post',
				data: {
					'asker': userName,
					'receiver': recipientName
				},
				success: function (response) {

				}
			});
		}
	} else {
		document.getElementById('errorMessage').style.display = "block";
		document.getElementById('errorMessage').innerText = "❌The user is not sub or he is banned❌";
	}
});

window.addEventListener('mousedown', function (event) {
	if (event.target.id !== 'add' && document.getElementById('errorMessage').style.display == "block") {
		document.getElementById('errorMessage').style.display = "none";
	}
})

var count = 1;

function changeImg(i, max) {

	maximum = parseInt(max);

	var image_pre = document.getElementById('img' + count);
	var nextCount = count + i;

	count++;
	if (count > maximum) {
		count = 1;
	}
	if (count < 1) {
		count = maximum;
	}


	alert
	var image_new = document.getElementById('img' + count);

	image_pre.style.visibility = "hidden";
	image_new.style.visibility = "visible";
}


var state = 0;


function zoom(max) {

	maximum = parseInt(max)
	if (max == 0) {
		return;
	}

	if (state == 0) {
		state = 1;
		document.getElementById("profile").style.visibility = "hidden";
		document.getElementById("btn3").style.visibility = "visible";
		document.getElementById("btn4").style.visibility = "visible";
		for (x = 1; x <= maximum; x++) {
			document.getElementById('img' + x).style.left = '-8%';
			document.getElementById('img' + x).style.bottom = '3%';
			document.getElementById('img' + x).style.height = '80%';
			document.getElementById('img' + x).style.width = '80%';
		}
	}

	else if (state == 1) {

		state = 0;
		document.getElementById("profile").style.visibility = "visible";
		document.getElementById("btn3").style.visibility = "hidden";
		document.getElementById("btn4").style.visibility = "hidden";
		for (y = 1; y <= maximum; y++) {

			document.getElementById('img' + y).style.left = '42.5%';
			document.getElementById('img' + y).style.bottom = '20%';
			document.getElementById('img' + y).style.height = '20%';
			document.getElementById('img' + y).style.width = '20%';
		}

	}


}
