

//Regarde lorsque on passe de public à privé ou inversement
//Pas forcément nécéssaire finalement

document.addEventListener("DOMContentLoaded", function () {
    
    const isPublicButton = document.getElementById('is_public');
    
    isPublicButton.addEventListener('change', function (event) {
        event.preventDefault();
        console.log("onchange public/privé");
    });
});

//Affichage amis lors d'appui sur le bouton

document.addEventListener("DOMContentLoaded", function () {
    
    const inviteButton = document.getElementById('invite_button');
    const exitButton = document.getElementById('exit-button-invite');

    var checkAmis = document.getElementById('invitation_amis');
    
    inviteButton.addEventListener('click', function (event) {
        event.preventDefault();
        //console.log("onchange public/privé");
        checkAmis.classList.remove("hide");
    });

    exitButton.addEventListener('click', function (event) {
        event.preventDefault();

        console.log("clicked");
        checkAmis.classList.add("hide");
        // pageProfil.classList.add("hide");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    
    const maxButton = document.getElementById('max_button');

    var maxParticipants = document.getElementById('max_participants');
    
    maxButton.addEventListener('click', function (event) {
        event.preventDefault();
        //console.log("onchange public/privé");

        if (maxParticipants.classList.contains("hide")) {
            console.log("show");
            maxParticipants.classList.remove("hide");
            maxParticipants.classList.add("show");
        } else {     
            console.log("hide");
            maxParticipants.classList.remove("show");
            maxParticipants.classList.add("hide");       
            
        }
    });
});