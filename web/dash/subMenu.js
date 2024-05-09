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
    document.getElementById('opt1').style.display = 'block';
    document.getElementById('opt2').style.display = 'block';
});

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('set').addEventListener('click', function () {
        document.getElementById('filters').style.display = 'block';
    });
});

window.addEventListener('click', function (e) {
    if (!document.getElementById('displaySearch').contains(e.target) && e.target.id !== 'searchBtn' && e.target.id !== 'sub' && !document.getElementById('opt1').contains(e.target) && !document.getElementById('opt2').contains(e.target)) {
        document.getElementById('content').classList.remove('blur-effect');
        document.getElementById('displaySearch').style.display = 'none';
        document.getElementById('opt1').style.display = 'none';
        document.getElementById('opt2').style.display = 'none';
        document.getElementById('silSubOptions').style.display = 'none';
        document.getElementById('gldSubOptions').style.display = 'none';
        document.getElementById('silBtn').style.marginTop = '30%';
        document.getElementById('gldBtn').style.marginTop = '30%';
    }
});

var silBtn = document.getElementById('silBtn');
var gldBtn = document.getElementById('gldBtn');

silBtn.addEventListener('click', function () {
    document.getElementById('silSubOptions').style.display = 'block';
    document.getElementById('silBtn').style.marginTop = '10%';
    document.getElementById('opt2').style.display = 'none';
});


silBtn.addEventListener('mouseover', function () {
    silBtn.innerHTML = "<i class='bx bxs-error'></i>";
});
silBtn.addEventListener('mouseout', function () {
    silBtn.innerHTML = "<i class='bx bx-badge-check'></i>";
});



gldBtn.addEventListener('click', function () {
    document.getElementById('gldSubOptions').style.display = 'block';
    document.getElementById('gldBtn').style.marginTop = '10%';
    document.getElementById('opt1').style.display = 'none';
});


$('#searchInput').on('input', function () {
    var input = $(this).val();
    $.get('look4Some.php', { i: input }, function (elem) {
        $('#Results').html(elem);
    });
}).on('click', function () {
    $(this).trigger('input');
});
