<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./javascript/script_ajout_event.js"></script>

    <link rel="stylesheet" href="./css/effect.css">
    <title>Document</title>
</head>


<body>

    <?php
        include("./utils/database.php");
        include("./utils/gestion_event.php");
        include("./utils/gestion_amis.php");
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

        
        <select name="categorie"  id="categorie" required>
            <?php 
                ShowCategories();
            ?>
        </select>

        <input type="date" name="date" id="date" placeholder="Date" required>
        <input type="time" name="heure" id="heure" placeholder="Heure" required>

        <input type="text" name="lieu" id="lieu" placeholder="Lieu" required>

         <!-- Evenements publics ou privés à actualiser avec ajax -->

        <select name="is_public" id="is_public" required>
            <option value="1"> 
                public
            </option>
            <option value="0"> 
                privé
            </option>
        </select>

        <button type="button" id="invite_button">Inviter amis</button>
        <div id="invitation_amis" class="hide">
        <?php
            ShowInvitationAmis();
        ?>
        </div>
        

        <button type="button" id="max_button">Max participants</button>
        <input type="number" class="hide" name="max_participants" id="max_participants" value='0' placeholder="Max participants">

        
        

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