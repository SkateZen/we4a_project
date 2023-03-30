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

    <h1>Vos événements</h1>

    
    <h2>Événements proposés</h2>

    <?php
        include("./utils/gestion_event.php");
        ShowEventWithIdCreator();
    ?>

    <h2>Événements inscrits</h2>

    


    

    



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