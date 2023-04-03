

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


setInterval('load_messages()', 1000);



function load_messages() {

    var pseudo_ami = $("#pseudo_ami_ajax").val();

    $.ajax({
        type: 'GET',
        url: "ajax_to_php/load_messages.php",
        cache: false,
        data: 'pseudo=' + encodeURIComponent(pseudo_ami),
        success: function(data){

            if(data != ""){
                $('#messages-content').html(data);
            }
        }
    });
}   


function sendMessage() {

    console.log("sending message 2");

    const formData = new FormData(document.getElementById('message-form'));
    const messageInput = $('#msg');
    const fileInput = $('#img');

    $.ajax({
        type: 'POST',
        url: 'ajax_to_php/send_message.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            $('#debug').html(response);
            
            messageInput.val('');
            fileInput.val('');
            load_messages();
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
        }
    });
    return false;
}


document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('message-form');
    const sendButton = document.getElementById('send_message');

    console.log("sending message 1");
    
    sendButton.addEventListener('click', function (event) {
        event.preventDefault();
        sendMessage(event);
    });
});



function load_messages_forum() {

    var pseudo_ami = $("#pseudo_ami_ajax").val();

    $.ajax({
        type: 'GET',
        url: "ajax_to_php/load_messages.php",
        cache: false,
        data: 'pseudo=' + encodeURIComponent(pseudo_ami),
        success: function(data){

            if(data != ""){
                $('#messages-content').html(data);
            }
        }
    });
} 


function showParticipants(event) {

    // const formData = new FormData(document.getElementById('infos-participants-form'));

    const id_event = $("#id_event_ajax").val();

    // Remplacer texte et id du bouton
    const bouton = event.target;
    bouton.textContent = 'Effacer';
    bouton.id = 'fermer_participants';

    console.log("show participants");

    $.ajax({
        type: 'POST',
        url: 'ajax_to_php/infos_participants.php',
        data: 'id_event=' + encodeURIComponent(id_event),
        // processData: false,
        // contentType: false,
        success: function(data){

            if(data != ""){
                $('#participants-content').html(data);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
        }
    });
    return false;
}



document.addEventListener("DOMContentLoaded", function () {
    
    const infosParticipantsButton = document.getElementById('infos_participants');
    
    infosParticipantsButton.addEventListener('click', function (event) {
        event.preventDefault();
        showParticipants(event);
    });
});

