<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="./javascript/theme_mode.js"></script>

    <link rel="stylesheet" href="./css/evenement.css">
    <link rel="stylesheet" href="./css/user.css">
    <title>Eventum</title>
</head>
<body>


    <?php
        include("./utils/database.php");
        include("./utils/gestion_amis.php");
        connect_db();
        $newAccountStatus = CheckLogin();
    
        if($newAccountStatus[0]){
            // echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
    
            include("./pageparts/header.php");
            
            echo "<script>setThemeMode(".getThemeFromDB().");</script>";            
    ?>

    <main>

    <h1 class="title">Vos événements</h1>

    
    <h2 class="title">Événements proposés</h2>

    <div class="container-event">
    <?php
        include("./utils/gestion_event.php");
        ShowEventWithIdCreator($userID);
    ?>
    </div>

    

    <h2 class="title">Événements inscrits</h2>

    <div class="container-event">
    <?php
        //include("./utils/gestion_event.php");
        ShowEventWithIdUser();
    ?>
    </div>

    

    <?php
    include("./pageparts/footer.php"); 
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
    </main>

    
</body>
</html>