

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

document.addEventListener("DOMContentLoaded", function () {
    
    const inscriptionButton = document.getElementById('inscription_event');
    const desinscriptionButton = document.getElementById('desinscription_event');
    
    // inscriptionButton.addEventListener('click', function (event) {
    //     event.preventDefault();
    //     location.reload();
    // });
    // desinscriptionButton.addEventListener('click', function (event) {
    //     event.preventDefault();
    //     location.reload();
    // });
});