<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <header>
        <nav>
            <a href="./index.php">Accueil visiteur</a>
        </nav>
    </header>


    <h1>Formulaire</h1>

    <h2>Se connecter</h2>

    <!-- Formulaire connexion -->
    <form action="" method="post">
        <input type="email" name="mail" id="mail" placeholder="Mail" required>

        <input type="text" name="password" id="password" placeholder="Mot de passe" required>

        <button type="submit" name="login" id="login" > Connect</button>

    </form>

    <a href="./inscription.php">Vous êtes nouveau, c'est par ici !</a>

</body>
</html>