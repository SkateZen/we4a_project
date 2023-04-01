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
        include("./utils/gestion_event.php");
        connect_db();
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)

        AjoutEvent();

        if($accountStatus[0]){
            echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';

            include("./pageparts/header.php");  
    ?>


    <h1>Ajouter un événement</h1>

    <!-- Formulaire ajout d'un évenement -->
    <form action="" method="post">
        <input type="text" name="titre" id="titre" placeholder="Nom de l'événement" required>

        <textarea name="description" id="description" placeholder="Description"></textarea>

        <input type="date" name="date" id="date" placeholder="Date" required>
        <input type="time" name="heure" id="heure" placeholder="Heure" required>

        <input type="text" name="lieu" id="lieu" placeholder="Lieu" required>

        <button type="submit" name="ajout_event" id="ajout_event"> Ajouter</button>
    </form>
    
    
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