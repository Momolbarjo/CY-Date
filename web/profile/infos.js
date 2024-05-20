
function deleteAccount(state) {

	if (state == 0) {
		document.getElementById("settings").style.visibility = "hidden";
		document.getElementById("deleteMenu").style.visibility = "visible";
	} else {
		document.getElementById("settings").style.visibility = "visible";
		document.getElementById("deleteMenu").style.visibility = "hidden";
	}
}

