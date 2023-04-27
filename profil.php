<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./javascript/script_profil.js"></script>

    <link rel="stylesheet" href="./css/profil.css">
    <link rel="stylesheet" href="./css/formulaire.css">
    <link rel="stylesheet" href="./css/effect.css">
    <link rel="stylesheet" href="./css/user.css">
    <title>Document</title>
</head>



<body>

<main id="page-profil">

    <?php
        include("./utils/database.php");
        include("./utils/gestion_profil.php");
        connect_db();
        
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)
    
        

        if($accountStatus[0]){
            // echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
    
            include("./pageparts/header.php");  
            include("./utils/gestion_amis.php");
            include("./pageparts/affichage_profil.php");  

            AjoutAmi();
            AcceptAmi();
            RetireAmi();
    ?>

    

    <?php 

        $row_user = PageProfil();
        DisplayProfil($row_user);

        if ($row_user['id_utilisateur'] == $userID){
        
    ?>

    <div class="demande-amis">
        <?php ShowDemandeAmis();?>
    </div>

    <?php
        }?>

    <div id="amis-content" class="hide">
    
        <div class="invitation_amis">
            <button id="exit-button-amis" class="exit-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px">
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
            </button>
            <h2>Amis</h2>
            <?php ShowAmis();?>
        </div>
    </div>
    <?php
        }
        elseif ($accountStatus[2]){
            echo '<h3 class="errorMessage">'.$accountStatus[2].'</h3>';
        }
        else{
            echo"Vous n'êtes pas connecté";

            header('Location: ./index.php');
            Exit();
        }
    ?>
    </main>

    <?php
        ModifyProfilForm();
    ?>


</body>
</html>