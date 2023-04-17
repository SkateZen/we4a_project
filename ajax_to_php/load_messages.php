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

        //Requete qui récupère toutes les invitations d'événements entre 2 utilisateurs à placé entre les messages

        // $query_test = "SELECT COUNT(*) FROM `invitation_evenement`";

        // echo "test =".$conn->query($query_test)->fetch_row()[0];

        $query_invitation = "SELECT * FROM `invitation_evenement` WHERE (id_utilisateur = '$userID' AND id_inviteur = '$id_ami')
                                                                    OR (id_utilisateur = '$id_ami' AND id_inviteur = '$userID') ORDER BY date_invitation ASC";
        $result_invitation = $conn->query($query_invitation);

        // echo "invitations =".$result_invitation->num_rows;


        if( !$result_messages && !$result_invitation )
        {
            echo "Aucun message enregistré";
        }
        else{ 

            $messages = array();
            $invitations = array();

            while( $row_message = $result_messages->fetch_assoc() ){
                $messages[] = $row_message;
            }
        
        
            while( $row_invitation = $result_invitation->fetch_assoc() ){
                $invitations[] = $row_invitation;
            }
            
            if ($invitations || $messages){

                $i = 0;
                $j = 0;

                $side = "left";

                // echo "<br>".count($messages);
                // echo "<br>".count($invitations);
                
                while( $i < count($messages) || $j < count($invitations) ){
                    
                    if ($i < count($messages) && $j < count($invitations)){
                        

                        if( $messages[$i]['date_envoi'] < $invitations[$j]['date_invitation'] ){ //si le message est plus ancien que l'invitation

                            //si c'est l'utilisateur qui a envoyé le message, on affiche le message à droite
                            //sinon on affiche le message à gauche
                            $side = SideMessage($messages[$i]['id_utilisateur_envoyeur']);

                            //On affiche le message
                            if (!empty($messages[$i]['contenu']))
                            {
                                ?>
                                <div class="<?php echo $side;?>">

                                    <p class="message">
                                        <?php echo $messages[$i]['contenu'];?>
                                    </p>
                                    
                                </div>
                                <?php
                                
                            }
                            else if (!empty($messages[$i]['image'])){
                                ?>

                                <div class="<?php echo $side;?>">

                                    <img src="images/messages/<?php echo $messages[$i]['image'];?>" alt="photo message">

                                </div>
                                <?php
                            }
                            $i++;
                        }
                        else{

                            //si c'est l'utilisateur qui a envoyé l'invitation', on affiche à droite
                            //sinon on affiche à gauche
                            $side = SideMessage($invitations[$j]['id_inviteur']);
                            
                            
                            //On affiche l'invitation

                            $query_event = "SELECT * FROM `evenement` WHERE id_evenement = '".$invitations[$j]['id_evenement']."'";
                            $result_event = $conn->query($query_event);
                            $row_event = $result_event->fetch_assoc();

                            ?>
                            <div class="<?php echo $side;?>">

                                <?php CardEvent($row_event); ?>
                            </div>
                            <?php
                            
                            $j++;
                        }
                    }
                    else if ($i < count($messages) && $j >= count($invitations)){
                        //Plus d'invitation mais des messages

                        $side = SideMessage($messages[$i]['id_utilisateur_envoyeur']);

                        if (!empty($messages[$i]['contenu']))
                        {
                            ?>
                            <div class="<?php echo $side;?>">

                                <p class="message">
                                    <?php echo $messages[$i]['contenu'];?>
                                </p>
                            </div>
                            <?php
                        }
                        else if (!empty($messages[$i]['image'])){

                            ?>
                            <div class="<?php echo $side;?>">

                                <img src="images/messages/<?php echo $messages[$i]['image'];?>" alt="photo message">

                            </div>
                            <?php
                        }
                        $i++;
                    }
                    else{

                        $side = SideMessage($invitations[$j]['id_inviteur']);

                        $query_event = "SELECT * FROM `evenement` WHERE id_evenement = '".$invitations[$j]['id_evenement']."'";
                        $result_event = $conn->query($query_event);
                        $row_event = $result_event->fetch_assoc();

                        ?>
                        <div class="<?php echo $side;?>">

                            <?php CardEvent($row_event); ?>
                        </div>
                        <?php
                        
                        $j++;
                    }
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
            if (!empty($row['contenu']))
            {
                echo "<br>".$row['contenu'];
            }
            else if (!empty($row['image'])){
                ?>
                <img src="images/forums/<?php echo $row['image'];?>" alt="photo message">
                <?php
            }
        }
    }
}


function SideMessage($id_envoyeur){

    global $userID;

    if ($id_envoyeur == $userID){ 
        return "right";
    }
    else{
        return "left";
    }
}

/*
"SELECT * FROM `message_prive` CROSS JOIN `invitation_evenement` WHERE ((id_utilisateur_envoyeur = '$userID' AND id_utilisateur_destinataire = '$id_ami') OR 
                                                                        (id_utilisateur_envoyeur = '$id_ami' AND id_utilisateur_destinataire = '$userID'))
                                                                    AND id_utilisateur_destinataire = id_utilisateur ORDER BY date_envoi, date_inivtation ASC"*/

?>

