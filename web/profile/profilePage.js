
function verif(max){
	max = parseInt(max);
	if (max == 0){
		document.getElementById("btn1").style.visibility = "hidden";
		document.getElementById("btn2").style.visibility = "hidden";
		document.getElementById("p3").style.visibility = "visible";
	}
}



document.getElementById('optionsBtn').addEventListener('click', function () {
	var optionsMenu = document.getElementById('optionsMenu');
	if (optionsMenu.style.display === 'none') {
		optionsMenu.style.display = 'block';
	} else {
		optionsMenu.style.display = 'none';
	}
});

var count = 1;

function changeImg(i,max) {
	
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
		for (x=1;x<=maximum;x++) {
				document.getElementById('img' + x ).style.left = '-8%';
				document.getElementById('img' + x ).style.bottom = '3%';
				document.getElementById('img' + x ).style.height = '80%';
				document.getElementById('img' + x ).style.width = '80%';
		}		
	}
	
	else if (state == 1) {
		
		state = 0;
		document.getElementById("profile").style.visibility = "visible";
		document.getElementById("btn3").style.visibility = "hidden";
		document.getElementById("btn4").style.visibility = "hidden";
		for (y=1;y<=maximum;y++) {
		
			document.getElementById('img' + y ).style.left = '42.5%';
			document.getElementById('img' + y ).style.bottom = '20%';
			document.getElementById('img' + y ).style.height = '20%';
			document.getElementById('img' + y ).style.width = '20%';
		}
		
	}


}
