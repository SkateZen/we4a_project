<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script_search_bar.js"></script>

    
    <link rel="stylesheet" href="./css/search-bar.css">
    <link rel="stylesheet" href="./css/effect.css">
    <link rel="stylesheet" href="./css/evenement.css">
    <link rel="stylesheet" href="./css/user.css">
    
    
    <title>Document</title>
</head>
<body>

    <?php
        include("./utils/database.php");
        connect_db();
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)
    
        if($accountStatus[0]){
            // echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
    
            include("./pageparts/header.php");  
    ?>

    <main>
        <header>
            <div class="search-bar">

                <!-- Recherche d'événements -->

                <div class="search-box">
                    <input class="search-text" type="text" id="search_evenement" name="search_evenement" placeholder="Chercher des événements">

                    <input class="search-text hide"  type="search" id="search_utilisateur" name="search_utilisateur" placeholder="Chercher des utilisateurs">


                    <a class="search-btn" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20px">
                            <!-- ! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    </a>
                </div>
    
                <!-- Recherche d'utilisateurs -->

                <button class="categorie selected" id="search_event_button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30"  viewBox="0 0 24 24">
                        <path d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>

                </button>

                <button class="categorie" id="search_user_button">
                    
                    <svg viewBox="0 0 640 512" width="30" xmlns="http://www.w3.org/2000/svg">
                        <path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"/></svg>
                </button>
            </div>
            <a href="ajout_event.php" class="categorie right">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30">
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
            </a>
            <!-- div dans laquelle les résultats de la recherche ajax s'afficheront -->
           
        </header>


        <?php 
            include("./utils/gestion_amis.php");
            AjoutAmi();

        ?>

        <!-- div dans laquelle les résultats de la recherche ajax s'afficheront -->
        <div id="results_event" class="container-event"></div>

        <!-- div resultat recherche utilisateurs -->
        <div id="results" class=""></div>

    
        <h2>Événements disponibles</h2>

        <?php
        include("./utils/gestion_event.php");
        ShowPublicEvent();
        ?>


    

    <!-- Recherche d'utilisateurs -->
    


    <!-- div dans laquelle les résultats de la recherche ajax s'afficheront -->
    



   


    <!-- Ajout d'événements -->
    <form action="./ajout_event.php" method="POST">

        <button type="submit">Ajouter événement</button>
        
        <!-- <div style="clear:both"></div> -->
    </form>


    <!-- Proposition d'événements -->
    

    </main>
    <!-- <aside class="rightside">
        <p>right</p>
    </aside> -->

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