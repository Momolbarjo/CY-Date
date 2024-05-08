

document.getElementById('optionsBtn').addEventListener('click', function () {
            var optionsMenu = document.getElementById('optionsMenu');
            if (optionsMenu.style.display === 'none') {
                optionsMenu.style.display = 'block';
            } else {
                optionsMenu.style.display = 'none';
            }
        });

var count = 1;

function changeImg(i){
	
	var image_pre = document.getElementById('img'+count);
	count += i;
	
	if(count > 6){
		count = 1;
	}
	
	if(count < 1){
		count = 6;
	}
	
	var image_new = document.getElementById('img'+count);
	
	image_pre.style.visibility = "hidden";
	image_new.style.visibility = "visible";
	
	
}
