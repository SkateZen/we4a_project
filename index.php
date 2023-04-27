<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script_search_bar.js"></script>
    <script src="./javascript/theme_mode.js"></script>

    
    <link rel="stylesheet" href="./css/search-bar.css">
    <link rel="stylesheet" href="./css/effect.css">
    <link rel="stylesheet" href="./css/evenement.css">
    <link rel="stylesheet" href="./css/user.css">
    
    
    
    <title>Eventum</title>
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

                <div class="search-bar-rightside">
                    <button class="categorie theme-btn" onclick="changeMode()">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 512 512" class="theme-mode hide">
                            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" viewBox="0 0 512 512" class="theme-mode show" id="moon">
                            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"/>
                        </svg>
                    </button>

                    <a href="ajout_event.php" class="categorie right">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30">
                            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                    </a>
                </div>

            
            
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

    
        <h1 class="title">Événements disponibles</h1>

        <div class="container-event">
            <?php
            include("./utils/gestion_event.php");
            ShowPublicEvent();
            ?>
        </div>
    

    </main>
    

    <?php
        include("./pageparts/footer.php");      
        echo "<script>setThemeMode(".getThemeFromDB().");</script>";
        }
        
        else{
            
            //echo"Vous n'êtes pas connecté";
            //header('Location: ./index.php');
            //include("./pageparts/header.php");  
            
            ?>
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <!-- <script src="./javascript/script_accueil.js"></script> -->
            

                <link rel="stylesheet" href="./css/base.css">
                <link rel="stylesheet" href="./css/visiteur.css">
                <link rel="stylesheet" href="./css/evenement.css">
                <link rel="stylesheet" href="./css/formulaire.css">
            </head>


            <?php
                if ($accountStatus[2]){
                    echo '<p class="alert alert-fail">'.$accountStatus[2].'</p>';
                }
                // include("./utils/database.php");
                // connect_db();
                $newAccountStatus = CheckNewAccountForm(); // <-- array($creationAttempted, $creationSuccessful, $error)
            
                // Redirection vers la page connexion si l'inscription est réussie
                if($newAccountStatus[1]){
                    echo '<h3 class="alert alert-success">Nouveau compte crée avec succès!</h3>';
                    header('Location: ./index.php?connexion=');
                }
                elseif ($newAccountStatus[0]){
                    echo '<h3 class="alert alert-fail">'.$newAccountStatus[2].'</h3>';
                }
            ?>

            <aside class="leftside ">
            </aside>
            
            <main>

                <!-- <p>Page accueil visiteur</p> -->

                <div class="page-visiteur">

               

                <div class="accueil">
                    <!-- Titre de notre Réseau social -->

                    <img src="./images/front/eventum_transparent.png" width="500px"alt="">

                    <?php
                        if (!isset($_GET['connexion']) && !isset($_GET['inscription']))
                        {
                    ?>

                    <div class="accueil-infos">
                        <h1>Bienvenue sur Eventum</h1>

                        <p>Ceci est la page d'acceuil de notre réseau social. L'idée est de faire un site permettant de faciliter la recherche, 
                            la création et l'organisation d'évènements ! </p>
                        
                        <div class="buttons">
                            <form action="" method="get">
                                <input type="hidden" name="inscription">
                                <button class="accueil-button" id="inscription-button">S'inscrire</button>
                            </form>

                            <form action="" method="get">
                                <input type="hidden" name="connexion">
                                <button class="accueil-button" id="connexion-button">Se connecter</button>
                            </form>
                        </div>

                    </div>

                    <?php
                        }
                        ?>
                    
                </div>
                <div class="accueil-content">
                    <h2 class="title">Aperçu événements</h2>

                    <div class="container-apercu-event">
                        <?php
                        include("./utils/gestion_event.php");
                        ShowPublicEvent();
                        ?>
                    </div>
                </div>
                </div>
            
                <!-- Formulaire par dessus la page -->

                <?php 
                    if (isset($_GET['inscription'])){
                        
                    
                ?>

                <div class="form-on-top-accueil" id="inscription-form">
                    <form action="" method="post" class="formulaire" >

                        <a href="./index.php" class="exit-button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px">
                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                        </a>

                        <h1>S'inscrire</h1>
                        
                        <input type="text" name="name" id="name" placeholder="Nom" required>
                        <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>
                        
                        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
                        <input type="email" name="mail" id="mail" placeholder="Mail" required>

                        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                        <input type="password" name="confirm" id="confirm" placeholder="Confirmer mot de passe" required>

                        <button type="submit" class="submit-button" name="sign_up" id="sign_up">Inscription</button>
                        <br>
                        <a id="inscription-to-connexion" href="./index.php?connexion=">Vous avez déjà un compte, c'est par ici !</a>
                    </form>
                </div>

                <?php
                    }
                    elseif(isset($_GET['connexion'])){

                ?>

                <div class="form-on-top-accueil" id="connexion-form">
                    <form action="" method="post" class="formulaire">

                        
                            <a href="./index.php" class="exit-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px">
                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                            </a>
                        

                        <h1>Se connecter</h1>

                        
                        <input type="email" name="mail" id="mail" placeholder="Mail" required>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" required>

                        <button type="submit" class="submit-button" name="login" id="login">Connexion</button>
                        <br>
                        <a id="connexion-to-inscription" href="./index.php?inscription=">Vous n'avez pas de compte, c'est par ici !</a>
                    </form>
                </div>

                <?php
                    }
                ?>
                

                
                

            </main>
            <aside class="rightside ">
            </aside>
            <?php
        }
    ?>
</body>
</html>