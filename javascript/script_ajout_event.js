

document.addEventListener("DOMContentLoaded", function () {
    
    const isPublicButton = document.getElementById('is_public');

    console.log("sending message in forum");
    
    isPublicButton.addEventListener('change', function (event) {
        event.preventDefault();
        console.log("onchange public/privé");
    });
});