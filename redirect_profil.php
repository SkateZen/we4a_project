<?php

    include("./utils/database.php");
    connect_db();
    $accountStatus = CheckLogin();

    include("./utils/gestion_profil.php");

    ModifyProfil();

    header('Location: ./profil.php');
    Exit();
?>