document.getElementById('profilePic').addEventListener('click', function () {
    var submenu = document.getElementById('submenu');
    if (submenu.style.display === 'none') {
        submenu.style.display = 'block';
    } else {
        submenu.style.display = 'none';
    }
});



document.getElementById('searchBtn').addEventListener('click', function () {
    document.getElementById('content').classList.add('blur-effect');
    document.getElementById('displaySearch').style.display = 'block';
});


window.addEventListener('click', function (e) {
    if (!document.getElementById('displaySearch').contains(e.target) && e.target.id !== 'searchBtn') {
        document.getElementById('content').classList.remove('blur-effect');
        document.getElementById('displaySearch').style.display = 'none';
    }
});


$('#displaySearch').on('input', function () {
    var input = $(this).val();
    $.get('look4Some.php', { i: input }, function (elem) {
        $('#Results').html(elem);
    });
}).on('click', function () {
    $(this).trigger('input');
});
