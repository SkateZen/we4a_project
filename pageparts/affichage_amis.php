<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script.js"></script> -->
    
    <title>Document</title>
</head>

<?php   


function AjoutAmiButton($row){
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>">
        <button type="submit" name="ajout_ami" id="ajout_ami"> Ajouter</button>
    </form>

    <?php
}


function ContactAmiButton($row){
    ?>
    <form action="" method="post">
        <input type="hidden" id="pseudo_ami" name="pseudo_ami" value="<?php echo $row['pseudo']; ?>">
        <button type="submit" name="contact_ami" id="contact_ami"> Contacter</button>
    </form>

    <?php
}



function AcceptAmiButton($row){
    ?>
    <form action="" method="post">
        <!-- <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>"> -->
        <button type="submit" name="accept_ami" id="accept_ami"> Accepter</button>
    </form>

    <?php
}

function SelectConversation($row){
    ?>
    <form action="" method="post">

        <input type="hidden" id="pseudo_ami" name="pseudo_ami" value="<?php echo $row['pseudo']; ?>">

        <button type="submit" name="select_conversation" id="select_conversation"> <?php echo $row['pseudo']; ?> </button>
    </form>

    <?php
}


function ChatBox($row){

    global $conn, $userID;

    ?>
    

    <h3><?php echo $row['pseudo']; ?></h3>

    <!-- <input type="hidden" id="pseudo_ami_ajax" name="pseudo_ami_ajax" value="<?php echo $row['pseudo']; ?>"> -->
    <div id="messages-content"></div>

    <form id="message-form" enctype="multipart/form-data">

        <input type="hidden" id="pseudo_ami_ajax" name="pseudo_ami_ajax" value="<?php echo $row['pseudo']; ?>">
        
        <input type="file" id="img" name="picture" accept="image/png, image/jpeg"><br>

        <textarea  id="msg" name="message" placeholder="Message" required></textarea>

        <button type="button" id="send_message">Send</button>

    </form>

    <div id="debug"></div>

    <?php
}

?>