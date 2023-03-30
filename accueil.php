<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <?php
        include("./utils/database.php");
        connect_db();
        $newAccountStatus = CheckLogin();
    
        if($newAccountStatus[0]){
            echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
    ?>

    <?php
        include("./pageparts/header.php");  
    ?>

    <h1>Eventum</h1>

    <p>Bravo, vous vous êtes connecté sur notre réseau social. Vous êtes censé pouvoir accéder à des évènements, vous y inscrire, ajouter des évènements, des amis, être heureux et faire la fête !</p>
    
    

    <!-- Recherche d'événements ou amis -->
    <button>
        
        <input type="search" placeholder="Cherchez des évènements ou amis">
    </button>


    <!-- Ajout d'événements -->

    <form action="./ajout_event.php" method="POST">

            
        <div id="ID_logout">
            <!-- <input type="hidden" value="logout" name="logout"></input> -->
            <button type="submit">Ajouter</button>
        </div>
        
        <!-- <div style="clear:both"></div> -->
    </form>

    <!-- Proposition d'événements -->

    <h2>Événements disponibles</h2>

    <?php
        include("./utils/gestion_event.php");
        InscriptionIntoEvent();
        ShowEvent();
    ?>

    



    <?php
        }
        elseif ($newAccountStatus[2]){
            echo '<h3 class="errorMessage">'.$newAccountStatus[2].'</h3>';
        }
        else{
            echo"Vous n'êtes pas connecté";
        }
    ?>
    
</body>
</html>