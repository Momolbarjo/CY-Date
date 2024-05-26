function deleteAccount(state) {
    // Vérifie la valeur de 'state'
    if (state == 0) {
        // Si 'state' est 0, cache l'élément avec l'ID "settings" et affiche l'élément avec l'ID "deleteMenu".
        document.getElementById("settings").style.visibility = "hidden";
        document.getElementById("deleteMenu").style.visibility = "visible";
    } else {
        // Sinon, affiche l'élément avec l'ID "settings" et cache l'élément avec l'ID "deleteMenu".
        document.getElementById("settings").style.visibility = "visible";
        document.getElementById("deleteMenu").style.visibility = "hidden";
    }
}
