<?php

include("../utils/database.php");
include("../pageparts/affichage_event.php");
connect_db();

//Code permettant de charger les messages dans la messagerie privée et dans les forums événements

global $conn;

if (isset($_GET['pseudo'])) {  //messagerie privée

    $pseudo_ami = $_GET['pseudo'];

    // echo $pseudo_ami;

    $query = "SELECT * FROM `utilisateur` WHERE pseudo = '$pseudo_ami'";

    $result = $conn->query($query);

    $row = $result->fetch_assoc();

    $id_ami = $row['id_utilisateur'];

    if (isset($_COOKIE['mail'])) {
        $mail = $_COOKIE['mail'];

        $query_userID = "SELECT id_utilisateur FROM `utilisateur` WHERE email = '$mail'";
        $result_userID = $conn->query($query_userID);

        $userID = $result_userID->fetch_assoc()['id_utilisateur'];

        //Requete qui récupère tous les messages entre 2 utilisateurs

        $query_messages = "SELECT * FROM `message_prive` WHERE (id_utilisateur_envoyeur = '$userID' AND id_utilisateur_destinataire = '$id_ami') OR 
                                                        (id_utilisateur_envoyeur = '$id_ami' AND id_utilisateur_destinataire = '$userID') ORDER BY date_envoi ASC";

        $result_messages = $conn->query($query_messages);

        //Requete qui récupère toutes les invitations d'événements entre 2 utilisateurs

        $query_invitation = "SELECT * FROM `invitation_evenement` WHERE id_utilisateur = '$userID' AND id_evenement IN (SELECT id_evenement FROM `evenement` WHERE id_createur = '$id_ami')
                                                                    OR id_utilisateur = '$id_ami' AND id_evenement IN (SELECT id_evenement FROM `evenement` WHERE id_createur = '$userID') ORDER BY date_invitation ASC";


        $result_invitation = $conn->query($query_invitation);

       // echo "tentative de chargement des invitations =".$result_invitation;


        if( !$result_messages && !$result_invitation )
        {
            echo "Aucun message enregistré";
        }
        else{ 
            if ($result_messages){
                //On affiche les messages privés avant les invitation aux événements
                while($row2 = mysqli_fetch_array($result_messages)){
                
                    echo "<br>".$row2['contenu'];
    
                    if ($result_invitation){
                        //On affiche les invitation aux événements avant les messages privés ayant été publiés après
                        while($row_invitation = $result_invitation->fetch_assoc()){
    
                            if ($row_invitation['date_invitation'] < $row2['date_envoi']){
                                //echo "<br>invitation à l'event ".$row_invitation['id_evenement'];
        
                                $query_event = "SELECT * FROM `evenement` WHERE id_evenement = '".$row_invitation['id_evenement']."'";
                                $result_event = $conn->query($query_event);
                                $row_event = $result_event->fetch_assoc();
        
                                CardEvent($row_event);
        
                            }
                            else{
                                echo "<br>message privé";
                            }
                        }
                    }
                }
            }
            else if ($result_invitation){
                while($row_invitation = $result_invitation->fetch_assoc()){

                    $query_event = "SELECT * FROM `evenement` WHERE id_evenement = '".$row_invitation['id_evenement']."'";
                    $result_event = $conn->query($query_event);
                    $row_event = $result_event->fetch_assoc();

                    CardEvent($row_event);
                }
            }
        }
    }   
}
else if(isset($_GET['id_event'])){

    $id_event = $_GET['id_event'];

    //echo "tentative de chargement des messages de l'event $id_event";

    $query = "SELECT * FROM `message_groupe` WHERE id_evenement = '$id_event' ORDER BY date_envoi ASC";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        echo "Aucun message enregistré";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            echo "<br>".$row['contenu'];
        }
    }
}


function DisplayInvitation($row_messages){

}

/*
"SELECT * FROM `message_prive` CROSS JOIN `invitation_evenement` WHERE ((id_utilisateur_envoyeur = '$userID' AND id_utilisateur_destinataire = '$id_ami') OR 
                                                                        (id_utilisateur_envoyeur = '$id_ami' AND id_utilisateur_destinataire = '$userID'))
                                                                    AND id_utilisateur_destinataire = id_utilisateur ORDER BY date_envoi, date_inivtation ASC"*/

?>

