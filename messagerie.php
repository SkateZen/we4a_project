<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./javascript/script_messagerie.js"></script>
    <script src="./javascript/script_search_bar.js"></script>
    
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

    <main>
 

    <h1>Messagerie</h1>

    <!-- <img src="images/messages/test.jpg"alt="photo message"> -->


    <form action="" method="POST">

        <input type="search" id="search_ami" name="search_ami" placeholder="Cherchez des amis">

        <div id="results">
            
        </div>
    </form>

    <h2>Conversations</h2>

    <?php ShowAmisWithConversation();?>

    <h2>Conversation en cours</h2>
    
    <?php 
    ShowConversation();
    //SendMessage();    
    ?>
    <!-- <div id="messages"></div> -->
    



    <?php
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