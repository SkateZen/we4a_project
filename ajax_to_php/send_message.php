<?php

include("../utils/database.php");
connect_db();

global $conn;


if (isset($_POST["pseudo_ami_ajax"])){

    $pseudo = $_POST["pseudo_ami_ajax"];

    // $id_friend = $_SESSION["id_friend"];

    $query_id_ami = "SELECT id_utilisateur FROM `utilisateur` WHERE pseudo = '$pseudo'";
    $result_id_ami = $conn->query($query_id_ami);

    $id_ami = $result_id_ami->fetch_assoc()['id_utilisateur'];

    $userID = GetIdWithCookie();

    echo $_POST["message"];


    if ( !empty($_POST["message"])){

        //code pour envoyer image

        // if (isset($_FILES["picture"]['name']) && !empty($_FILES["picture"]['name'])){

        //     $img_name = $_FILES['picture']['name'];
        //     $tmp_name = $_FILES['picture']['tmp_name'];
        //     $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //     $img_ex_to_lc = strtolower($img_ex);
        //     $extensions = ["jpeg", "png", "jpg"];
        //     if(in_array($img_ex_to_lc, $extensions)){
        //         $new_img_name = uniqid("IMG-", true).'.'.$img_ex_to_lc;
        //         $img_upload_path = '../images/messages/'.$new_img_name;
        //         move_uploaded_file($tmp_name, $img_upload_path);
        //     }

        // } else {
        //     $img_upload_path = NULL;
        // }

        $message = mysqli_real_escape_string($conn, $_POST["message"]);

        $query = "INSERT INTO `message_prive`(`id_message`, `id_utilisateur_envoyeur`, `id_utilisateur_destinataire`, `date_envoi`, `contenu`) VALUES (NULL,'$userID', '$id_ami', CURRENT_TIMESTAMP, '$message')";
        $conn->query($query);
    }
}
else if(isset($_POST["id_evenement_forum"])){

    $id_event = $_POST["id_evenement_forum"];

    // $id_friend = $_SESSION["id_friend"];


    $userID = GetIdWithCookie();

    echo $_POST["message"];


    if ( !empty($_POST["message"])){

        //code pour envoyer image

        // if (isset($_FILES["picture"]['name']) && !empty($_FILES["picture"]['name'])){

        //     $img_name = $_FILES['picture']['name'];
        //     $tmp_name = $_FILES['picture']['tmp_name'];
        //     $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //     $img_ex_to_lc = strtolower($img_ex);
        //     $extensions = ["jpeg", "png", "jpg"];
        //     if(in_array($img_ex_to_lc, $extensions)){
        //         $new_img_name = uniqid("IMG-", true).'.'.$img_ex_to_lc;
        //         $img_upload_path = '../images/messages/'.$new_img_name;
        //         move_uploaded_file($tmp_name, $img_upload_path);
        //     }

        // } else {
        //     $img_upload_path = NULL;
        // }

        $message = mysqli_real_escape_string($conn, $_POST["message"]);

        $query = "INSERT INTO `message_groupe`(`id_message`, `id_utilisateur_envoyeur`, `id_evenement`, `date_envoi`, `contenu`, `image`) 
                                        VALUES (NULL,'$userID', '$id_event', CURRENT_TIMESTAMP, '$message', NULL)";
        $conn->query($query);
    }

}