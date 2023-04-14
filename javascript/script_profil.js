

// Bouton pour spécifier le type de recherche

$(document).ready(function() {
    
    const modifyButton = document.getElementById('modify-button');

    var modifyProfil = document.getElementById('modify-profil-form');
    var pageProfil = document.getElementById('page-profil');

    const exitButton = document.getElementById('exit-button');
    

    
    modifyButton.addEventListener('click', function (event) {
        event.preventDefault();
        
        modifyProfil.classList.remove("hide");
        // pageProfil.classList.add("hide");

    });

    exitButton.addEventListener('click', function (event) {
        event.preventDefault();
        
        modifyProfil.classList.add("hide");
        // pageProfil.classList.add("hide");

    });

});