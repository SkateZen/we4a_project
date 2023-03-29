<?php

    include ("./utils/database.php");

    if (isset($_POST["logout"])){
        DestroyLoginCookie();
    }

    unset($_POST);

    header('Location: ./index.php');
    Exit();
?>