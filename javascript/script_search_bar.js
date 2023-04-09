
//Recherche d'utilisateurs

$(document).ready(function() {
    // Lorsqu'un utilisateur modifie l'input de recherche
    $('#search_utilisateur').on('input', function() {
      
        // Récupération de la valeur de l'input de recherche
        var query_search = $(this).val();
  
        searchUser(query_search, 'ajax_to_php/search_utilisateurs.php');
    });
});


$(document).ready(function() {
    // Lorsqu'un utilisateur modifie l'input de recherche
    $('#search_ami').on('input', function() {
      
        // Récupération de la valeur de l'input de recherche
        var query_search = $(this).val();

        searchUser(query_search, 'ajax_to_php/search_amis.php');
  
        // Si l'input de recherche est vide, on ne fait rien
    });
});


function searchUser(query_search, link) {

    if (query_search === '') {
        $('#results').empty();
        return;
    }

    console.log(query_search);

    $.ajax({
        type: 'GET',
        url: link,
        data: 'user=' + encodeURIComponent(query_search),
        success: function(data){
            if(data != ""){
                $('#results').html(data);
            }else{
                document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun utilisateur</div>"
            }
        }
    });
}


//Recherche d'événements

$(document).ready(function() {
    // Lorsqu'un utilisateur modifie l'input de recherche
    $('#search_evenement').on('input', function() {
      
        // Récupération de la valeur de l'input de recherche
        var query_search = $(this).val();
  
        // Si l'input de recherche est vide, on ne fait rien
        
        if (query_search === '') {
            $('#results').empty();
            return;
        }
    
        console.log(query_search);
    
        $.ajax({
            type: 'GET',
            url: 'ajax_to_php/search_evenements.php',
            data: 'event=' + encodeURIComponent(query_search),
            success: function(data){
                if(data != ""){

                    // Créer un nouvel élément HTML avec la propriété innerHTML
                    var newElement = $('<div>')[0];
                    newElement.innerHTML = data;

                    // Conserver les propriétés de l'élément #results_event existant
                    var oldElement = $('#results_event')[0];
                    $.each(oldElement.attributes, function() {
                    newElement.setAttribute(this.name, this.value);
                    });

                    // Remplacer l'élément #results_event existant par le nouvel élément
                    $('#results_event').replaceWith(newElement);

                    //$('#results_event').html(data);
                }
            }
        });

    });
});




