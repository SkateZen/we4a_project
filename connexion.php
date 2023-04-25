<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/visiteur.css">

    <title>Document</title>
</head>


<body>

    <?php
        include("./utils/database.php");
        connect_db();
        $accountStatus = CheckLogin(); // <-- array($creationAttempted, $creationSuccessful, $error)
        
    ?>

    <?php
        // Redirection vers la page d'accueil si la connexion est réussie
        if($accountStatus[0]){
            echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
            header('Location: accueil.php');
        }
        elseif ($accountStatus[2]){
            echo '<h3 class="errorMessage">'.$accountStatus[2].'</h3>';
        }
    ?>


    <main>

        <!-- Afficher la création du compte avec succès si le paramètre GET est rempli -->
        <?php 
            include("./utils/infos.php");
            if (isset($_GET['registration_err'])) {
                displayLogInfo($_GET['registration_err']);
            }
        ?>

        <!-- Formulaire connexion -->
        <form action="" method="post" class="hide">
        <h1>Se connecter</h1>

        <div align="center">
            <input type="email" name="mail" id="mail" placeholder="Mail" required>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>

            <button type="submit" name="login" id="login">Connexion</button>
        </div>
        <a href="./inscription.php">Vous êtes nouveau, c'est par ici !</a>
        </form>
    </main>


</body>
</html>