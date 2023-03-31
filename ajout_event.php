<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
include("./utils/database.php");
include("./utils/gestion_event.php");
connect_db();
$newAccountStatus = CheckLogin();

AjoutEvent();

if($newAccountStatus[0]){
    echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
?>

<?php
include("./pageparts/header.php");  
?>





<body>

    <h1>Ajouter un événement</h1>


    <form action="" method="post">
        <input type="text" name="titre" id="titre" placeholder="Nom de l'événement" required>

        <textarea name="description" id="description" placeholder="Description"></textarea>

        <input type="date" name="date" id="date" placeholder="Date" required>
        <input type="time" name="heure" id="heure" placeholder="Heure" required>

        <input type="text" name="lieu" id="lieu" placeholder="Lieu" required>

        <button type="submit" name="ajout_event" id="ajout_event"> Ajouter</button>
    </form>
    
    
</body>

<?php
        }
        elseif ($newAccountStatus[2]){
            echo '<h3 class="errorMessage">'.$newAccountStatus[2].'</h3>';
        }
        else{
            echo"Vous n'êtes pas connecté";

            header('Location: ./index.php');
            Exit();
        }
    ?>

</html>