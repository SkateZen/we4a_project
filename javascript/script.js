

$(document).ready(function() {
    // Lorsqu'un utilisateur modifie l'input de recherche
    $('#search_utilisateur').on('input', function() {
        
        //print("test");
        
      
        // Récupération de la valeur de l'input de recherche
        var query_search = $(this).val();
  
        // Si l'input de recherche est vide, on ne fait rien
        if (query_search === '') {
            $('#results').empty();
            return;
        }

        console.log(query_search);
  
                // Requête AJAX pour récupérer les résultats de recherche
                
                /* $.ajax({
            url: 'utils/gestion_amis.php',
            method: 'POST',
            data: {query: query_search},
            success: function(data) {
            // Affichage des résultats de recherche dans la div #results
            $('#results').html(data);
            }
        }); */
        $.ajax({
            type: 'GET',
            url: 'utils/search_amis.php',
            data: 'user=' + encodeURIComponent(query_search),
            success: function(data){
                if(data != ""){
                    $('#results').html(data);
                }else{
                    document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun utilisateur</div>"
                }
            }
        });
    });
});