// Exécuter le code lorsque le document est prêt
$(document).ready(function(){
    // Récupérer les éléments DOM nécessaires et les stocker dans des variables
    const table = $(".visitsTableContainer"); // Conteneur de la table des visites
    const button = $("#visited"); // Bouton pour afficher la table des visites
    const form = $("form"); // Formulaire de la page
    
    // Fonction pour afficher la table des visites et flouter le formulaire
    function showTable(){
        table.show(); // Afficher la table des visites
        form.addClass("blurred"); // Ajouter la classe 'blurred' au formulaire pour appliquer un effet de flou
    }

    // Vérifier si l'utilisateur a un abonnement 'gld' et afficher le bouton si c'est le cas
    if(sub == 'gld'){
        button.show(); // Afficher le bouton des visites
    }

    // Fonction pour cacher la table des visites et enlever l'effet de flou du formulaire
    function hideTable(){
        table.hide(); // Masquer la table des visites
        form.removeClass("blurred"); // Enlever la classe 'blurred' du formulaire
    }

    // Ajouter un écouteur d'événement au bouton pour afficher la table des visites lors du clic
    button.click(function(){
        showTable(); // Appeler la fonction pour afficher la table des visites
    });

    // Ajouter un écouteur d'événement pour le document pour masquer la table des visites lors d'un clic en dehors de celle-ci
    $(document).click(function(event){
        // Vérifier si le clic ne se produit pas à l'intérieur de la table des visites ou sur le bouton des visites
        if (!$(event.target).closest(".visitsTableContainer").length && !$(event.target).is("#visited")){
            hideTable(); // Appeler la fonction pour masquer la table des visites
        }
    });
});
