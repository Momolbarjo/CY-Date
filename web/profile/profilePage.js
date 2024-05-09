
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

	if ((nextCount >= 1 && nextCount <= 6 && document.getElementById('img' + nextCount).src !== "../../Pictures/carréVide.png") ||
		(nextCount < 1 && document.getElementById('img6').src !== "../../Pictures/carréVide.png") ||
		(nextCount > 6 && document.getElementById('img1').src !== "../../Pictures/carréVide.png")) {
		count = nextCount;
	} else {
		if (i > 0) {
			count++;
			if (count > 6) {
				count = 1;
			}
		} else if (i < 0) {
			count--;
			if (count < 1) {
				count = 6;
			}
		}
	}

	var image_new = document.getElementById('img' + count);

	image_pre.style.visibility = "hidden";
	image_new.style.visibility = "visible";
}
