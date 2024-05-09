
document.getElementById('optionsBtn').addEventListener('click', function () {
	var optionsMenu = document.getElementById('optionsMenu');
	if (optionsMenu.style.display === 'none') {
		optionsMenu.style.display = 'block';
	} else {
		optionsMenu.style.display = 'none';
	}
});

var count = 1;
function changeImg(i) {
	var image_pre = document.getElementById('img' + count);
	var nextCount = count + i;


	if (nextCount < 1) {
		count = totalImages;
	} else if (nextCount > totalImages) {
		count = 1;
	} else {
		count = nextCount;
	}

	var image_new = document.getElementById('img' + count);

	document.body.style.backgroundImage = "url('" + image_new.src + "')";

	image_pre.style.visibility = "hidden";
}


