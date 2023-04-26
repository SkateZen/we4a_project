<?php

    include("./utils/database.php");
    connect_db();
    $accountStatus = CheckLogin();

    include("./utils/gestion_event.php");

    if (isset($_POST['send_invitation'])){
        InviteAmis($_POST['id_evenement']);
    }

    
    header('Location: ./evenement.php?id_event='.$_POST['id_evenement']);
    Exit();
?>