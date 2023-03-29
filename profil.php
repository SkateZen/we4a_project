<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>



<body>
    
    <!-- photo -->

    <!-- nom, prénom -->

    <!-- pseudo -->

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

    <?php

    if ( isset($pseudo) || isset($userID) ) {
    ?>

    <div>
        <h1>Infos utilisateur</h1>
        
        <p> Nom : <?php echo $name; ?> </p>
        
        <p> Prénom : <?php echo $firstname; ?> </p>

        <p> Pseudo : <?php echo $pseudo; ?> </p>
        
    </div>


    <!-- <div>
        <h1>Modifier infos utilisateur</h1>
        
        <form action="./updateUser.php" method="POST">
            <input type="text" name="name" id="name" placeholder="Nom" value="<?php echo $name; ?>">
            <input type="text" name="firstname" id="firstname" placeholder="Prénom" value="<?php echo $firstname; ?>">

            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php echo $pseudo; ?>">


            <input type="text" name="password" id="password" placeholder="Mot de passe">
            <input type="text" name="confirm" id="confirm" placeholder="Confirmer mot de passe">

            <button type="submit" name="update" id="update"> Modifier</button>
        </form>
    </div> -->

    <div>
        
    
        <form action="./logout.php" method="POST">

            
            <div id="ID_logout">
                <input type="hidden" value="logout" name="logout"></input>
                <button type="submit">Se déconnecter</button>
            </div>
            
            <!-- <div style="clear:both"></div> -->
        </form>
    </div>
    <?php
    }
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