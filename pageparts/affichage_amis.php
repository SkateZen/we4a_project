<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script.js"></script>
    
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
        <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>">
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
    <form action="" method="get">

        <input type="hidden" id="pseudo_ami" name="pseudo_ami" value="<?php echo $row['pseudo']; ?>">

        <button type="submit" name="select_conversation" id="select_conversation"> <?php echo $row['pseudo']; ?> </button>
    </form>

    <?php
}


function ChatBox($row){

    global $conn, $userID;

    ?>
    <form action="" method="post">

         <input type="hidden" id="pseudo_ami_ajax" name="pseudo_ami_ajax" value="<?php echo $row['pseudo']; ?>">
        <h3><?php echo $row['pseudo']; ?></h3>


        <div id="messages"></div>


        <input type="hidden" name="pseudo_ami" value="<?php echo $row['pseudo']; ?>">

        <textarea name="message" id="message" placeholder="Message" required></textarea>
        <!-- <input type="text" name="message" id="message" placeholder="Message" required> -->
        <button type="submit" name="send_message_ami" id="send_message_ami"> Envoyer</button>
    </form>

    <?php
}

?>