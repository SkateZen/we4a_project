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
    ?>

    <h1>Eventum</h1>

    <p>
        Bravo, vous vous êtes connecté sur notre réseau social. 
        Vous êtes censé pouvoir accéder à des évènements, vous y inscrire, ajouter des évènements, des amis, être heureux et faire la fête !
    </p>


    <!-- Recherche d'événements -->
    <form action="" method="POST">
        <input type="search" id="search_evenement" name="search_evenement" placeholder="Cherchez des événements">

        <!-- div dans laquelle les résultats de la recherche ajax s'afficheront -->
        <div id="results_event">

        </div>

    </form>



    <?php 
            include("./utils/gestion_amis.php");
            AjoutAmi();

    ?>

    <!-- Recherche d'utilisateurs -->
    <form action="" method="POST">
        <input type="search" id="search_utilisateur" name="search_utilisateur" placeholder="Cherchez des amis">

        <!-- div dans laquelle les résultats de la recherche ajax s'afficheront -->
        <div id="results">

        </div>

    </form>


    <!-- Ajout d'événements -->
    <form action="./ajout_event.php" method="POST">
        
        <!-- <input type="hidden" value="logout" name="logout"></input> -->
        <button type="submit">Ajouter événement</button>
        
        <!-- <div style="clear:both"></div> -->
    </form>


    <!-- Proposition d'événements -->
    <h2>Événements disponibles</h2>

    <?php
            include("./utils/gestion_event.php");
            ShowEvent();

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