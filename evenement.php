<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script_evenement.js"></script>
    <title>Document</title>
</head>
<body>

    <?php
        include("./utils/database.php");
        connect_db();
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)
    
        if($accountStatus[0]){
            echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
    
            include("./pageparts/header.php");  
            include("./utils/gestion_event.php");

            InscriptionIntoEvent();
            DesinscriptionFromEvent();
            ModifyEvent();
            
    ?>

    <h1>Infos evenement</h1>

    <?php
        $row_event = PageEvent();
        
        if ($row_event == false){
            echo "Erreur";
            header('Location: ./accueil.php');
        }

        echo "<div class='event'>";
        echo "<h2>".$row_event['titre']."</h2>";
        echo "<p>".$row_event['description']."</p>";
        echo "<p>".$row_event['date']."</p>";
        echo "<p>".$row_event['heure']."</p>";
        echo "<p>".$row_event['lieu']."</p>";
        echo "</div>";

        if (!UserInEvent($row_event) && !CreatorEvent($row_event)){

            //participants non inscrits
            
            InscriptionButton($row_event);
        }
        else{
            if (CreatorEvent($row_event)){

                //createur
                // echo "<br>modifier";
                ?>
                <!-- Ajout d'événements -->
                <form action="./modif_event.php" method="POST">
                    
        
                    <button type="submit">Modifier événement</button>
                
                </form>

                <?php 
                    ModifyEventForm($row_event);
                ?>
                

                <form id="infos-participants-form" action="">
        
                    <input type="hidden" id="id_event_ajax" name="id_event_ajax" value="<?php echo $row_event['id_evenement']; ?>" ></input>
                    <button type="button" id="infos_participants" name="infos_participants">Infos participants</button>
                    
                    <!-- <div style="clear:both"></div> -->
                </form>

                <div id=participants-content></div>

                <?php


                
            }
            else if (UserInEvent($row_event)){

                //participant
                
                DesinscriptionButton($row_event);
                echo"<br>Vous êtes inscrits";
            }

            //createur et participant
            ?>
                <h2>Forum</h2>
            <?php
            ForumBox($row_event);
        }
        ?>

  

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