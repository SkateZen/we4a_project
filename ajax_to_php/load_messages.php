<?php

include("../utils/database.php");
connect_db();


global $conn;

if (isset($_GET['pseudo'])) {

    $pseudo_ami = $_GET['pseudo'];

    // echo $pseudo_ami;

    $query = "SELECT * FROM `utilisateur` WHERE pseudo = '$pseudo_ami'";

    $result = $conn->query($query);

    $row = $result->fetch_assoc();

    $id_ami = $row['id_utilisateur'];

    if (isset($_COOKIE['mail'])) {
        $mail = $_COOKIE['mail'];
    }

    $query_userID = "SELECT id_utilisateur FROM `utilisateur` WHERE email = '$mail'";
    $result_userID = $conn->query($query_userID);

    $userID = $result_userID->fetch_assoc()['id_utilisateur'];

    $query2 = "SELECT * FROM `message_prive` WHERE (id_utilisateur_envoyeur = '$userID' AND id_utilisateur_destinataire = '$id_ami') OR 
                                                    (id_utilisateur_envoyeur = '$id_ami' AND id_utilisateur_destinataire = '$userID') ORDER BY date_envoi ASC";

    $result2 = $conn->query($query2);

    if( mysqli_affected_rows($conn) == 0 )
    {
        echo "Aucun message enregistré";
    }
    else{
        while($row2 = mysqli_fetch_array($result2)){
            echo "<br>".$row2['contenu'];
        }
    }
    
}



?>