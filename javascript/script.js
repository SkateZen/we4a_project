

$(document).ready(function() {
    // Lorsqu'un utilisateur modifie l'input de recherche
    $('#search_utilisateur').on('input', function() {
      
        // Récupération de la valeur de l'input de recherche
        var query_search = $(this).val();
  
        searchUser(query_search, 'utils/search_utilisateurs.php');
    });
});


$(document).ready(function() {
    // Lorsqu'un utilisateur modifie l'input de recherche
    $('#search_ami').on('input', function() {
      
        // Récupération de la valeur de l'input de recherche
        var query_search = $(this).val();

        searchUser(query_search, 'utils/search_amis.php');
  
        // Si l'input de recherche est vide, on ne fait rien
        

    });
});


function searchUser(query_search, link) {

    if (query_search === '') {
        $('#results').empty();
        return;
    }

    $.ajax({
        type: 'GET',
        url: link,
        data: 'id=' + encodeURIComponent(query_search),
        success: function(data){
            if(data != ""){
                $('#results').html(data);
            }else{
                document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun utilisateur</div>"
            }
        }
    });
}