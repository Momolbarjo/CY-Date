// Ajoute un gestionnaire d'événements pour le changement de fichier sur l'élément avec l'ID 'imageUpload'.
document.getElementById('imageUpload').addEventListener('change', function (e) {
    // Sélectionne l'image qui sera mise à jour.
    const img = document.querySelector('.round-image');
    // Récupère le premier fichier sélectionné par l'utilisateur.
    const file = e.target.files[0];
    // Crée un nouvel objet FileReader pour lire le contenu du fichier.
    const reader = new FileReader();

    // Vérifie si un fichier a été sélectionné et si son type est autorisé (png, jpeg, gif).
    if (file && ['image/png', 'image/jpeg', 'image/gif'].includes(file.type)) {
        // Définir ce qui se passe lorsque la lecture du fichier est terminée.
        reader.onloadend = function () {
            // Met à jour la source de l'image avec le contenu du fichier lu.
            img.src = reader.result;
        }
        // Commence à lire le contenu du fichier sous forme de Data URL.
        reader.readAsDataURL(file);
    } else {
        // Affiche une alerte si le fichier n'est pas du type autorisé.
        alert('Please upload a jpg, a jpeg, a png, or a gif file!');
    }
});

// Boucle pour ajouter des gestionnaires d'événements de changement de fichier pour les éléments avec les IDs 'imageUpload1' à 'imageUpload6'.
for (let i = 1; i < 7; i++) {
    document.getElementById('imageUpload' + i).addEventListener('change', function (e) {
        // Sélectionne l'image correspondante qui sera mise à jour.
        const img = document.querySelector('.square-image' + i);
        // Récupère le premier fichier sélectionné par l'utilisateur.
        const file = e.target.files[0];
        // Crée un nouvel objet FileReader pour lire le contenu du fichier.
        const reader = new FileReader();

        // Vérifie si un fichier a été sélectionné et si son type est autorisé (png, jpeg, gif).
        if (file && ['image/png', 'image/jpeg', 'image/gif'].includes(file.type)) {
            // Définir ce qui se passe lorsque la lecture du fichier est terminée.
            reader.onloadend = function () {
                // Met à jour la source de l'image avec le contenu du fichier lu.
                img.src = reader.result;
            }
            // Commence à lire le contenu du fichier sous forme de Data URL.
            reader.readAsDataURL(file);
        } else {
            // Affiche une alerte si le fichier n'est pas du type autorisé.
            alert('Please upload a jpg, a jpeg, a png, or a gif file!');
        }
    });
}
