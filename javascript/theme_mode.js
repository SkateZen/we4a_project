function changeMode() {
    // Envoi de la valeur du toggleTheme à la base de données via AJAX
    $.ajax({
        url: 'ajax_to_php/update_theme.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            let new_theme = response;
            setThemeMode(new_theme);

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


function setThemeMode(theme) {
    if(theme == 0) {
        // Thème clair

        // Changer la couleur des caractères
        document.documentElement.style.setProperty('--default-text', '#000000');

        // Changer la couleur des lignes séparant les différentes sections
        document.documentElement.style.setProperty('--ligneSection', '#352f2f8a');

        // Changer la couleur du background
        document.documentElement.style.setProperty('--color1', '#fcfaff');

        // Changer la visibilité des icones associés au thème clair
        const icons = document.getElementsByClassName("theme-mode");
        icons[1].setAttribute("class", "theme-mode show");
        icons[0].setAttribute("class", "theme-mode hide");

    } else {
        // Thème sombre

        // Changer la couleur des caractères
        document.documentElement.style.setProperty('--default-text', '#fff');

        // Laisser la couleur noir des caractères pour les formulaires
        document.documentElement.style.setProperty('--black', '#000000');

        // Changer la couleur des lignes séparant les différentes sections
        document.documentElement.style.setProperty('--ligneSection', '#fcfaff');

        // Changer la couleur du background
        document.documentElement.style.setProperty('--color1', '#262626');

        // Changer la visibilité des icones associés au thème clair
        const icons = document.getElementsByClassName("theme-mode");
        icons[1].setAttribute("class", "theme-mode hide");
        icons[0].setAttribute("class", "theme-mode show");

    }
    
}
