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
<body>

    <?php
        include("./utils/database.php");
        connect_db();
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)
    
        if($accountStatus[0]){
            echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
    
            include("./pageparts/header.php");  
            include("./utils/gestion_event.php");
            
    ?>

    <h1>Infos evenement</h1>

    <?php
        $row_event = PageEvent();
        

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
                echo "<br>modifier";
                echo "<br>infos participants";
            }
            else if (UserInEvent($row_event)){

                //participant
                echo"<br>Vous êtes inscrits";
            }

            //createur et participant
            echo "<br>Conversation groupe";
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