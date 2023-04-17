

//Gestion messagerie

setInterval('load_messages()', 1000);

function load_messages() {

    var pseudo_ami = $("#pseudo_ami_ajax").val();

    // document.getElementById("content-messages").scrollTop = document.getElementById("content-messages").scrollHeight;

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

