<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script_messagerie.js"></script>
    <script src="./javascript/script_search_bar.js"></script>

    <link rel="stylesheet" href="./css/search-bar.css">
    <link rel="stylesheet" href="./css/messagerie.css">
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="./css/evenement.css">
    
    <title>Document</title>
</head>
<body>
    <?php
        include("./utils/database.php");
        connect_db();
        $newAccountStatus = CheckLogin();
    
        if($newAccountStatus[0]){
            // echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
  
            include("./pageparts/header.php");  
            include("./utils/gestion_amis.php");
    ?>

    <main class="d-flex">
    <section class="messagerie-left">
        <div class="search-bar">
            <!-- Recherche d'événements -->

            <div class="search-box">
            <input class="search-text" type="search" id="search_ami" name="search_ami" placeholder="Chercher vos amis">

                <a class="search-btn" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20px">
                        <!-- ! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </a>
            </div>
        </div>

        <div id="results">
    
        </div>

        <h2>Conversations</h2>

        <?php ShowAmisWithConversation();?>
    </section>
    
    <!-- <img src="images/messages/test.jpg"alt="photo message"> -->
    
    <section class="messagerie-right">
        <?php 

        ShowConversation();
        //SendMessage();    
        ?>
    </section>

    
    <!-- <div id="messages"></div> -->
    
    </main>
    <aside class="rightside">
        <p>right</p>
    </aside>



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
           
    
    
</body>
</html>