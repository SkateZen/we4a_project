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
    <link rel="stylesheet" href="./css/evenement.css">
    <link rel="stylesheet" href="./css/user.css">

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

    

    
    

    <!-- Formulaire ajout d'un évenement -->
    <div id="ajout-event" align="center"  class="form-ajout">
        <form action="" method="post"  class="formulaire" enctype="multipart/form-data" >

        <h1 class="ajout_event-title">Ajouter un événement</h1>

        <input class="titre ecart" type="text" name="titre" id="titre" placeholder="Nom de l'événement" required>

        <textarea class="ecart" name="description" id="description" placeholder="Description"></textarea>

        <label class="ecart " for="">
            Image :
            <input type="file" name="image_event" placeholder="Image">
        </label>

        <label class="ecart" for="">Categorie : 
            <select name="categorie" class="middle-button"  id="categorie" required>
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

        <div class="form-middle-buttons">
            <select class="ecart middle-button" name="is_public" id="is_public" required>
                <option value="1"> 
                    public
                </option>
                <option value="0"> 
                    privé
                </option>
            </select>

            <button class="ecart middle-button" type="button" id="invite_button">Inviter amis</button>
            <!-- <div id="invitation_amis" class="hide">
            <?php
                //ShowInvitationAmis();
            ?>
            </div> -->
            

            <button class="ecart middle-button" type="button" id="max_button">Max participants</button>
            <div id="max_participants" class="hide">
                <input type="number"  name="max_participants"  value='0' placeholder="Max participants">

            </div >
        </div>
        

        
        
            
        <button class="submit-button" type="submit" name="ajout_event" id="ajout_event"> Ajouter</button>
        </form>
    </div>
    
    <div id="invitation_amis" class="hide">
        <div class="invitation_amis">
            <button id="exit-button-invite" class="exit-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px">
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
            </button>
            
            <h2>Inviter amis</h2>
            <?php
                ShowInvitationAmis();
            ?>
                

        </div>
    </div>

    
    
    <?php
        include("./pageparts/footer.php");   
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