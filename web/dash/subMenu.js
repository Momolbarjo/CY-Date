document.getElementById('profilePic').addEventListener('click', function () {
    var submenu = document.getElementById('submenu');
    if (submenu.style.display === 'none') {
        submenu.style.display = 'block';
    } else {
        submenu.style.display = 'none';
    }
});


document.getElementById('searchBtn').addEventListener('click', function () {
    if (subs === 'unsub') {
        document.getElementById('errorMessage').style.display = "block";
        document.getElementById('errorMessage').innerText = "❌You need to be sub to use this feature❌";
    } else {
        document.getElementById('content').classList.add('blur-effect');
        document.getElementById('displaySearch').style.display = 'block';
    }
});

document.getElementById('sub').addEventListener('click', function () {
    document.getElementById('content').classList.add('blur-effect');
    document.getElementById('opt1').style.display = 'block';
    document.getElementById('opt2').style.display = 'block';
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
        document.getElementById('errorMessage').style.display = "none";
        document.getElementById('successMessage').style.display = "none";
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


document.getElementById('silBtn').addEventListener('click', function () {
    var selectedOption = $('input[type=radio][name=sil]:checked');
    if (selectedOption.length) {
        $.ajax({
            url: '../../subscription/sub.php',
            type: 'post',
            data: {
                'subscriptionType': selectedOption.attr('name'),
                'subscriptionClass': selectedOption.attr('class')
            },
            success: function (response) {
                if (response === "❌You are already following this option❌") {
                    document.getElementById('errorMessage').style.display = "block";
                    document.getElementById('errorMessage').innerText = response;
                } else {
                    document.getElementById('successMessage').style.display = "block";
                    document.getElementById('successMessage').innerText = response;
                }
            }
        });
    }
});

document.getElementById('gldBtn').addEventListener('click', function () {
    var selectedOption = $('input[type=radio][name=gld]:checked');
    if (selectedOption.length) {
        $.ajax({
            url: '../../subscription/sub.php',
            type: 'post',
            data: {
                'subscriptionType': selectedOption.attr('name'),
                'subscriptionClass': selectedOption.attr('class')
            },
            success: function (response) {
                if (response === "❌You are already following this option❌") {
                    document.getElementById('errorMessage').innerText = response;
                    document.getElementById('errorMessage').style.display = "block";
                } else {
                    document.getElementById('successMessage').innerText = response;
                    document.getElementById('successMessage').style.display = "block";
                }
            }
        });
    }
}); 
