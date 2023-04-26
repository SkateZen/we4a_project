<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script_evenement.js"></script>
    <script src="./javascript/script_ajout_event.js"></script>

    <link rel="stylesheet" href="./css/effect.css">
    <link rel="stylesheet" href="./css/evenement.css">
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="./css/messagerie.css">
    <link rel="stylesheet" href="./css/formulaire.css">
    <title>Document</title>
</head>
<body>
<main>

    <?php
        include("./utils/database.php");
        connect_db();
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)
    
        if($accountStatus[0]){
            // echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
    
            
            include("./utils/gestion_event.php");
            include("./utils/gestion_amis.php");

            InscriptionIntoEvent();
            DesinscriptionFromEvent();
            ModifyEvent();

            include("./pageparts/header.php");  

    ?>
    
    <!-- <h1>Infos evenement</h1> -->

    <div class="page-event">

    

    <?php
        $row_event = PageEvent();
        $row_createur = CreateurEvent($row_event['id_createur']);
        
        if ($row_event == false){
            echo "Erreur";
            header('Location: ./accueil.php');
        }

        if (isset($_POST['send_invitation'])){
            InviteAmis($row_event['id_evenement']);
        }

        ?>
        

        <div class="event">
            <?php
            if (!empty($row_event['image'])){
                ?>
                <img class="image-event" src=<?php echo $row_event['image']; ?> alt="">
                <?php
            }
            
            ?>
            

            <h1><?php echo $row_event['titre']; ?></h1>

            <p class="ecart"><?php echo $row_event['description']; ?></p>

            <div class="createur">
                <p> Organisateur : <?php CardAmi($row_createur);  ?></p>
            </div>

            <div>
                <p class="ecart"> Date : <?php echo $row_event['date']; ?></p>
                <p class="ecart"> Heure : <?php echo $row_event['heure']; ?></p>
                <p class="ecart"> Lieu : <?php echo $row_event['lieu']; ?></p>

                <p class="ecart"><?php echo NumberOfParticipants($row_event); ?> participants</p>

            </div>

            <div class="buttons">
        <?php

        if (!UserInEvent($row_event) && !CreatorEvent($row_event)){

            //participants non inscrits
            //Bouton pour s'inscrire si il reste de la place
            
            if (NumberOfParticipants($row_event) >= $row_event['nb_participants'] && $row_event['nb_participants'] != 0){
                echo "<br>Nombre de participants maximum atteint";
            }
            else{
                InscriptionButton($row_event);
            }
        }
        else{

            //participants ou organisateur

            if ($row_event['is_public'] == 1 || CreatorEvent($row_event)) //si l'événement est public ou si l'utilisateur est le créateur
            {
            ?>
                <!-- Bouton pour inviter des amis -->
                <form action="" method="post">
                    <button type="button" id="invite_button">Inviter amis</button>

                    <div id="invitation_amis" class="hide">
                        <?php
                            ShowInvitationAmis();
                        ?>
                        <button type="submit" name="send_invitation">Inviter</button>

                    </div>
                </form>
                
                <?php
            }

            if (CreatorEvent($row_event)){ //si l'utilisateur est le créateur

                //createur
                // Bouton pour modifier l'événement
                ?>
               
                <button type="submit" id="modify-button">Modifier événement</button>
                

                
                
                <!-- Boutons pour avoir les infos sur les participants -->

                <form id="infos-participants-form" action="">
        
                    <input type="hidden" id="id_event_ajax" name="id_event_ajax" value="<?php echo $row_event['id_evenement']; ?>" ></input>
                    <button type="button" id="infos_participants" name="infos_participants">Infos participants</button>
                    
                    <!-- <div style="clear:both"></div> -->
                </form>

                <div id=participants-content></div>

                <?php


                
            }
            else if (UserInEvent($row_event)){ //si l'utilisateur est un participant

                //participant
                echo"<br>Vous êtes inscrits";
                DesinscriptionButton($row_event);
                

                
            }
            //createur et participant

            //inviter amis
            
            
            //forum
            
            ?>
            </div>
            </div>
            
            <div class="forum">
                <h2>Forum</h2>
            <?php
            ForumBox($row_event);
        }
        ?>
            </div>
        </div>

    <div class="hide" id="modify-event-form">
        <?php 
            ModifyEventForm($row_event);
        ?>
    </div>
    
    </main>

    <?php
        }
        elseif ($accountStatus[2]){
            echo '<h3 class="errorMessage">'.$accountStatus[2].'</h3>';
        }
        else{
            echo"Vous n'êtes pas connecté";
            header('Location: ./index.php');
        }
    ?>
    
</body>
</html>