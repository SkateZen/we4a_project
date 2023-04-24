<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./javascript/script_ajout_event.js"></script>

    <link rel="stylesheet" href="./css/effect.css">
    <link rel="stylesheet" href="./css/formulaire.css">

    <title>Document</title>
</head>


<body>
    <main>

    <?php
        include("./utils/database.php");
        include("./utils/gestion_event.php");
        include("./utils/gestion_amis.php");
        connect_db();
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)

        AjoutEvent();

        if($accountStatus[0]){
            // echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';

            include("./pageparts/header.php");  
    ?>

    

    
    <h1 class="ajout_event-title">Ajouter un événement</h1>

    <!-- Formulaire ajout d'un évenement -->
    
    <form action="" method="post"  class="formulaire-event" enctype="multipart/form-data">

        <input class="titre ecart" type="text" name="titre" id="titre" placeholder="Nom de l'événement" required>

        <textarea class="ecart" name="description" id="description" placeholder="Description"></textarea>

        <label class="ecart" for="">
            Image:
            <input type="file" name="image_event" placeholder="Image">
        </label>

        <label class="ecart" for="">Categorie : 
            <select name="categorie"  id="categorie" required>
                <?php 
                    ShowCategories();
                ?>
            </select>
        </label>
        

        <label class="ecart" for="">Date :
            <input type="date" name="date" id="date" placeholder="Date" required>
        </label>

        <label class="ecart" for="">
            Heure :
            <input type="time" name="heure" id="heure" placeholder="Heure" required>
        </label>
        

        <input class="lieu ecart" class="lieu" type="text" name="lieu" id="lieu" placeholder="Lieu" required>

            <!-- Evenements publics ou privés à actualiser avec ajax -->

        <select class="ecart choix" name="is_public" id="is_public" required>
            <option value="1"> 
                public
            </option>
            <option value="0"> 
                privé
            </option>
        </select>

        <button class="ecart choix" type="button" id="invite_button">Inviter amis</button>
        <div id="invitation_amis" class="hide">
        <?php
            ShowInvitationAmis();
        ?>
        </div>
        

        <button class="ecart choix" type="button" id="max_button">Max participants</button>
        <input type="number" class="hide" name="max_participants" id="max_participants" value='0' placeholder="Max participants">

        
        

        <button class="submit-button" type="submit" name="ajout_event" id="ajout_event"> Ajouter</button>
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
    </main>
</body>

</html>