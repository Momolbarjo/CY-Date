$(document).ready(function () {
    // Exécuter le code une fois que le document est entièrement chargé.
    
    $(".navigationBar a").click(function (e) {
        // Ajouter un gestionnaire d'événements pour les clics sur les liens de la barre de navigation.
        
        if (!$(this).is("#out")) {
            e.preventDefault();
            // Empêcher le comportement par défaut des liens (comme la navigation vers une nouvelle page),
            // sauf si l'élément cliqué a l'ID 'out'.
        }
        
        $(".navigationBar a").removeClass('active');
        // Supprimer la classe 'active' de tous les liens de la barre de navigation.
        
        $(this).addClass('active');
        // Ajouter la classe 'active' au lien cliqué pour le mettre en surbrillance.
        
        if ($(this).is("#allUsers")) {
            // Si le lien cliqué a l'ID 'allUsers',
            $.get("getData/allUsers.php", function (data) {
                // Envoyer une requête GET pour obtenir les données des utilisateurs,
                // puis insérer les données reçues dans l'élément avec l'ID 'userTable'.
                $("#userTable").html(data);
            });
        }
        else if ($(this).is("#report")) {
            // Si le lien cliqué a l'ID 'report',
            $.get("getData/allReports.php", function (data) {
                // Envoyer une requête GET pour obtenir les rapports,
                // puis insérer les données reçues dans l'élément avec l'ID 'userTable'.
                $("#userTable").html(data);
            });
        }
        else if ($(this).is("#ban")) {
            // Si le lien cliqué a l'ID 'ban',
            $.get("getData/allBanned.php", function (data) {
                // Envoyer une requête GET pour obtenir les utilisateurs bannis,
                // puis insérer les données reçues dans l'élément avec l'ID 'userTable'.
                $("#userTable").html(data);
            });
        }
        else if ($(this).is("#unban")) {
            // Si le lien cliqué a l'ID 'unban',
            $.get("getData/allUnbanedRequest.php", function (data) {
                // Envoyer une requête GET pour obtenir les demandes de débanissement,
                // puis insérer les données reçues dans l'élément avec l'ID 'userTable'.
                $("#userTable").html(data);
            });
        }
    });

    $(".logo").click(function () {
        // Ajouter un gestionnaire d'événements pour les clics sur l'élément avec la classe 'logo'.
        $("#userTable").empty();
        // Vider le contenu de l'élément avec l'ID 'userTable'.
        $(".navigationBar a").removeClass('active');
        // Supprimer la classe 'active' de tous les liens de la barre de navigation.
    });
});
