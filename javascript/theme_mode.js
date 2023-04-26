function changeMode() {
    // Envoi de la valeur du toggleTheme à la base de données via AJAX
    $.ajax({
        url: 'ajax_to_php/update_theme.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            let new_theme = response;
            if(new_theme == 0) {
                // Thème clair
                document.documentElement.style.setProperty('--ecriture', '#262626');
                document.documentElement.style.setProperty('--default-text', '#000000');
                document.documentElement.style.setProperty('--ligneSection', '#352f2f8a');
                document.documentElement.style.setProperty('--color1', '#fcfaff');

            } else {
                // Thème sombre
                document.documentElement.style.setProperty('--ecriture', '#fcfaff');
                document.documentElement.style.setProperty('--default-text', '#fff');
                document.documentElement.style.setProperty('--ligneSection', '#fcfaff');
                document.documentElement.style.setProperty('--color1', '#262626');
            }

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
