

setInterval('load_messages_forum()', 1000);

function load_messages_forum() {

    const id_event = $("#id_evenement_forum").val();

    console.log("message forum");

    $.ajax({
        type: 'GET',
        url: "ajax_to_php/load_messages.php",
        cache: false,
        data: 'id_event=' + encodeURIComponent(id_event),
        success: function(data){

            if(data != ""){
                $('#messages-content-forum').html(data);
            }
        }
    });
} 


function sendMessage() {

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
    
    const sendButton = document.getElementById('send_message');

    console.log("sending message in forum");
    
    sendButton.addEventListener('click', function (event) {
        event.preventDefault();
        sendMessage(event);
    });
});


function showParticipants(event) {

    // const formData = new FormData(document.getElementById('infos-participants-form'));

    const id_event = $("#id_event_ajax").val();

    const bouton = event.target;

    if (bouton.id == 'fermer_participants') {
        $('#participants-content').empty();
        bouton.textContent = 'Voir les participants';
        bouton.id = 'infos_participants';
        return;
    }
    else{
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
    }
    // Remplacer texte et id du bouton
    
    bouton.textContent = 'Effacer';
    bouton.id = 'fermer_participants';

    console.log("show participants");

    return false;
}



document.addEventListener("DOMContentLoaded", function () {
    
    const infosParticipantsButton = document.getElementById('infos_participants');
    
    infosParticipantsButton.addEventListener('click', function (event) {
        event.preventDefault();
        showParticipants(event);
    });
});

$(document).ready(function() {
    
    const modifyButton = document.getElementById('modify-button');

    var modifyEvent = document.getElementById('modify-event-form');
    //var pageProfil = document.getElementById('page-profil');

    const exitButton = document.getElementById('exit-button');
    
    modifyButton.addEventListener('click', function (event) {
        event.preventDefault();
        
        modifyEvent.classList.remove("hide");
        // pageProfil.classList.add("hide");

    });

    exitButton.addEventListener('click', function (event) {
        event.preventDefault();
        
        modifyEvent.classList.add("hide");
        // pageProfil.classList.add("hide");
    });
});


