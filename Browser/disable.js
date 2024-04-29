
//https://zguyun.com/blog/how-to-disable-back-button-in-browser-using-javascript/


window.onload = function () {
    disableBackBtn();
}

function disableBackBtn() {
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
}