
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
            $('#results_event').empty();
            return;
        }
    
        console.log(query_search);
    
        $.ajax({
            type: 'GET',
            url: 'ajax_to_php/search_evenements.php',
            data: 'event=' + encodeURIComponent(query_search),
            success: function(data){
                if(data != ""){

                    $('#results_event').html(data);
                }                
            }
        });

    });
});



// Bouton pour spécifier le type de recherche

$(document).ready(function() {
    
    var searchEventButton = document.getElementById('search_event_button');
    var searchUserButton = document.getElementById('search_user_button');

    var searchEvent = document.getElementById('search_evenement');
    var searchUser = document.getElementById('search_utilisateur');

    var resultEvent = document.getElementById('results_event');
    var resultUser = document.getElementById('results');
    
    searchEventButton.addEventListener('click', function (event) {
        event.preventDefault();
        //console.log("onchange public/privé");

        if (searchEventButton.classList.contains("selected")) {
            console.log("nothing to do");
            
        } else {     
            console.log("hide");
            searchEventButton.classList.add("selected");
            searchUserButton.classList.remove("selected");
            
            searchEvent.classList.remove("hide");
            searchUser.classList.add("hide");

            resultEvent.classList.replace( "hide", "container-event");

            // resultEvent.classList.remove("hide");
            resultUser.classList.add("hide");
            
        }
    });

    searchUserButton.addEventListener('click', function (event) {
        event.preventDefault();
        //console.log("onchange public/privé");

        if (searchUserButton.classList.contains("selected")) {
            console.log("nothing to do");
            
        } else {     
            console.log("hide");
            searchEventButton.classList.remove("selected");
            searchUserButton.classList.add("selected");
            
            searchUser.classList.remove("hide");
            searchEvent.classList.add("hide");

            resultEvent.classList.replace("container-event", "hide");

            // resultEvent.classList.add("hide");
            resultUser.classList.remove("hide");
            //searchEvent.classList.add("show");
        }
    });
});




