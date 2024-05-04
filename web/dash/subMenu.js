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

document.getElementById('sub').addEventListener('click', function () {
    document.getElementById('content').classList.add('blur-effect');

});

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('set').addEventListener('click', function () {
        document.getElementById('filters').style.display = 'block';
    });
});

window.addEventListener('click', function (e) {
    if (!document.getElementById('displaySearch').contains(e.target) && e.target.id !== 'searchBtn' && e.target.id !== 'sub') {
        document.getElementById('content').classList.remove('blur-effect');
        document.getElementById('displaySearch').style.display = 'none';
    }
});


$('#searchInput').on('input', function () {
    var input = $(this).val();
    $.get('look4Some.php', { i: input }, function (elem) {
        $('#Results').html(elem);
    });
}).on('click', function () {
    $(this).trigger('input');
});
