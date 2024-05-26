// Ajoute un gestionnaire d'événements de clic pour l'élément avec l'ID 'profilePic'.
document.getElementById('profilePic').addEventListener('click', function () {
    var submenu = document.getElementById('submenu');
    // Alterne l'affichage du sous-menu.
    if (submenu.style.display === 'none') {
        submenu.style.display = 'block';
    } else {
        submenu.style.display = 'none';
    }
});

// Ajoute un gestionnaire d'événements de clic pour l'élément avec l'ID 'searchBtn'.
document.getElementById('searchBtn').addEventListener('click', function () {
    if (subs === 'unsub') {
        // Affiche un message d'erreur si l'utilisateur n'est pas abonné.
        document.getElementById('errorMessage').style.display = "block";
        document.getElementById('errorMessage').innerText = "❌You need to be sub to use this feature❌";
    } else {
        // Ajoute un effet de flou et affiche la recherche si l'utilisateur est abonné.
        document.getElementById('content').classList.add('blur-effect');
        document.getElementById('displaySearch').style.display = 'block';
    }
});

// Ajoute un gestionnaire d'événements de clic pour l'élément avec l'ID 'sub'.
document.getElementById('sub').addEventListener('click', function () {
    // Ajoute un effet de flou et affiche les options d'abonnement.
    document.getElementById('content').classList.add('blur-effect');
    document.getElementById('opt1').style.display = 'block';
    document.getElementById('opt2').style.display = 'block';
});

// Ajoute un gestionnaire d'événements de clic global.
window.addEventListener('click', function (e) {
    // Cache les éléments et retire l'effet de flou si un clic se produit en dehors des zones spécifiées.
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

// Sélectionne les éléments avec les IDs 'silBtn' et 'gldBtn'.
var silBtn = document.getElementById('silBtn');
var gldBtn = document.getElementById('gldBtn');

// Ajoute un gestionnaire d'événements de clic pour 'silBtn'.
silBtn.addEventListener('click', function () {
    // Affiche les options de souscription argent et ajuste les marges.
    document.getElementById('silSubOptions').style.display = 'block';
    document.getElementById('silBtn').style.marginTop = '10%';
    document.getElementById('opt2').style.display = 'none';
});

// Ajoute des gestionnaires d'événements pour les effets de survol sur 'silBtn'.
silBtn.addEventListener('mouseover', function () {
    silBtn.innerHTML = "<i class='bx bxs-error'></i>";
});
silBtn.addEventListener('mouseout', function () {
    silBtn.innerHTML = "<i class='bx bx-badge-check'></i>";
});

// Ajoute un gestionnaire d'événements de clic pour 'gldBtn'.
gldBtn.addEventListener('click', function () {
    // Affiche les options de souscription or et ajuste les marges.
    document.getElementById('gldSubOptions').style.display = 'block';
    document.getElementById('gldBtn').style.marginTop = '10%';
    document.getElementById('opt1').style.display = 'none';
});

// Utilise jQuery pour gérer l'événement d'entrée de texte et le clic sur l'élément avec l'ID 'searchInput'.
$('#searchInput').on('input', function () {
    var input = $(this).val();
    $.get('look4Some.php', { i: input }, function (elem) {
        $('#Results').html(elem);
    });
}).on('click', function () {
    $(this).trigger('input');
});

// Ajoute un gestionnaire d'événements de clic pour 'silBtn' pour gérer les options de souscription argent.
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

// Ajoute un gestionnaire d'événements de clic pour 'gldBtn' pour gérer les options de souscription or.
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
