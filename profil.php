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
    <title>Document</title>
</head>



<body>

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
    ?>

    <main id="page-profil">

    <?php 

        $row_user = PageProfil();
        DisplayProfil($row_user);

        
    ?>
    
<!-- 
    <div>
        <form action="./logout.php" method="POST">
            
            <div id="ID_logout">
                <input type="hidden" value="logout" name="logout"></input>
                <button type="submit">Se déconnecter</button>
            </div>
            
        </form>
    </div> -->

    <div>
        <h2>Amis</h2>
        <?php ShowAmis();?>

        <h2>Amis en attente</h2>

        <?php ShowDemandeAmis();?>
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