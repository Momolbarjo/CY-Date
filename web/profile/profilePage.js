
// Fonction pour vérifier la valeur maximale et ajuster la visibilité des éléments en conséquence
function verif(max) {
    max = parseInt(max); // Convertir la valeur 'max' en entier
    if (max == 0) {
        document.getElementById("btn1").style.visibility = "hidden"; // Cacher le bouton avec l'ID 'btn1'
        document.getElementById("btn2").style.visibility = "hidden"; // Cacher le bouton avec l'ID 'btn2'
        document.getElementById("p3").style.visibility = "visible"; // Afficher l'élément avec l'ID 'p3'
    }
}

// Ajout d'un écouteur d'événement pour afficher/masquer le menu des options
document.getElementById('optionsBtn').addEventListener('click', function () {
    var optionsMenu = document.getElementById('optionsMenu'); // Récupérer l'élément du menu des options
    if (optionsMenu.style.display === 'none') {
        optionsMenu.style.display = 'block'; // Afficher le menu des options
    } else {
        optionsMenu.style.display = 'none'; // Masquer le menu des options
    }
});

// Ajout d'un écouteur d'événement pour afficher le formulaire de rapport et flouter le profil
document.getElementById('report').addEventListener('click', function () {
    document.getElementById('profile').classList.add('blur-effect'); // Ajouter un effet de flou au profil
    document.getElementById('reportForm').style.display = 'block'; // Afficher le formulaire de rapport
});

// Utilisation de jQuery pour gérer les événements une fois le document prêt
$(document).ready(function () {
    // Gestion de l'événement de clic sur le bouton de rapport
    $("#reportBtn").click(function () {
        var reportReason = $("#reportReason").val(); // Récupérer la raison du rapport
        $.ajax({
            url: '../../admin/report.php', // URL de destination pour l'Ajax
            type: 'post', // Méthode de requête
            data: {
                'reporter': userName,
                'reported': recipientName,
                'reason': reportReason
            },
            success: function (response) {
                // Action à effectuer en cas de succès (actuellement vide)
            }
        });
    });

    // Gestion de l'événement de clic pour le blocage d'utilisateur
    $("#block").click(function(){
        $.post(window.location.href, { blocker: userName, blocked: recipientName }); // Envoi des données de blocage via POST
    });
});

// Gestion de l'événement de clic pour fermer le formulaire de rapport si un clic est effectué en dehors de celui-ci
window.addEventListener('click', function (e) {
    if (!document.getElementById('reportForm').contains(e.target) && e.target.id !== 'report') {
        document.getElementById('reportForm').style.display = 'none'; // Masquer le formulaire de rapport
        document.getElementById('profile').classList.remove('blur-effect'); // Enlever l'effet de flou du profil
    }
});

// Ajout d'un écouteur d'événement pour ajouter/supprimer un contact
document.getElementById('add').addEventListener('click', function () {
    if (subRecipient !== "unsub" && recipientRole !== 'banned') { // Vérification des conditions pour ajouter un contact
        if (this.className == "bx bx-user-plus") {
            this.className = "bx bx-user-minus"; // Changer l'icône en utilisateur supprimé
            $.ajax({
                url: '../../subscription/addContact.php', // URL pour ajouter un contact
                type: 'post',
                data: {
                    'asker': userName,
                    'receiver': recipientName
                },
                success: function (response) {
                    // Action à effectuer en cas de succès (actuellement vide)
                }
            });
        } else {
            this.className = "bx bx-user-plus"; // Changer l'icône en utilisateur ajouté
            $.ajax({
                url: '../../subscription/removeContact.php', // URL pour supprimer un contact
                type: 'post',
                data: {
                    'asker': userName,
                    'receiver': recipientName
                },
                success: function (response) {
                    // Action à effectuer en cas de succès (actuellement vide)
                }
            });
        }
    } else {
        document.getElementById('errorMessage').style.display = "block"; // Afficher le message d'erreur
        document.getElementById('errorMessage').innerText = "❌The user is not sub or he is banned❌"; // Définir le message d'erreur
    }
});

// Gestion de l'événement de clic pour cacher le message d'erreur lorsque l'utilisateur clique en dehors du bouton 'add'
window.addEventListener('mousedown', function (event) {
    if (event.target.id !== 'add' && document.getElementById('errorMessage').style.display == "block") {
        document.getElementById('errorMessage').style.display = "none"; // Masquer le message d'erreur
    }
});

// Variable de compteur initialisée à 1
var count = 1;

// Fonction pour changer l'image affichée
function changeImg(i, max) {
    maximum = parseInt(max); // Convertir la valeur 'max' en entier

    var image_pre = document.getElementById('img' + count); // Récupérer l'image actuelle
    var nextCount = count + i;

    count++;
    if (count > maximum) {
        count = 1; // Réinitialiser le compteur si supérieur au maximum
    }
    if (count < 1) {
        count = maximum; // Réinitialiser le compteur si inférieur à 1
    }

    var image_new = document.getElementById('img' + count); // Récupérer la nouvelle image

    image_pre.style.visibility = "hidden"; // Masquer l'ancienne image
    image_new.style.visibility = "visible"; // Afficher la nouvelle image
}

// Variable d'état initialisée à 0
var state = 0;

// Fonction pour zoomer sur les images
function zoom(max) {
    maximum = parseInt(max); // Convertir la valeur 'max' en entier
    if (max == 0) {
        return; // Ne rien faire si max vaut 0
    }

    if (state == 0) {
        state = 1; // Mettre à jour l'état
        document.getElementById("profile").style.visibility = "hidden"; // Cacher le profil
        document.getElementById("btn3").style.visibility = "visible"; // Afficher le bouton 3
        document.getElementById("btn4").style.visibility = "visible"; // Afficher le bouton 4
        for (x = 1; x <= maximum; x++) {
            document.getElementById('img' + x).style.left = '-8%'; // Déplacer l'image vers la gauche
            document.getElementById('img' + x).style.bottom = '3%'; // Déplacer l'image vers le bas
            document.getElementById('img' + x).style.height = '80%'; // Agrandir la hauteur de l'image
            document.getElementById('img' + x).style.width = '80%'; // Agrandir la largeur de l'image
        }
    } else if (state == 1) {
        state = 0; // Mettre à jour l'état
        document.getElementById("profile").style.visibility = "visible"; // Afficher le profil
        document.getElementById("btn3").style.visibility = "hidden"; // Cacher le bouton 3
        document.getElementById("btn4").style.visibility = "hidden"; // Cacher le bouton 4
        for (y = 1; y <= maximum; y++) {
            document.getElementById('img' + y).style.left = '42.5%'; // Réinitialiser la position horizontale de l'image
            document.getElementById('img' + y).style.bottom = '20%'; // Réinitialiser la position verticale de l'image
            document.getElementById('img' + y).style.height = '20%'; // Réinitialiser la hauteur de l'image
            document.getElementById('img' + y).style.width = '20%'; // Réinitialiser la largeur de l'image
        }
    }
}

