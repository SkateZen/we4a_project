<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/visiteur.css">
</head>


<body>
    <?php
        include("./utils/database.php");
        connect_db();
        $newAccountStatus = CheckNewAccountForm(); // <-- array($creationAttempted, $creationSuccessful, $error)
    ?>


    <!-- Formulaire d'inscription -->
    <main>
    <?php
        // Redirection vers la page connexion si l'inscription est réussie
        if($newAccountStatus[1]){
            echo '<h3 class="successMessage">Nouveau compte crée avec succès!</h3>';
            header('Location: ./connexion.php?registration_err=success');
        }
        elseif ($newAccountStatus[0]){
            include("./utils/infos.php");
            displayLogInfo("fail");
            echo '<h3 class="errorMessage">'.$newAccountStatus[2].'</h3>';
        }
    ?>
        <form action="" method="post" class="form-visiteur">
            <h1>S'inscrire</h1>
            
            <div align="center">
                <input type="text" name="name" id="name" placeholder="Nom">
                <input type="text" name="firstname" id="firstname" placeholder="Prénom">
                
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
                <input type="email" name="mail" id="mail" placeholder="Mail">

                <input type="password" name="password" id="password" placeholder="Mot de passe">
                <input type="password" name="confirm" id="confirm" placeholder="Confirmer mot de passe">

                <button type="submit" name="sign_up" id="sign_up">Inscription</button>
            </div>
            <a href="./connexion.php">Vous avez déjà un compte, c'est par ici !</a>
        </form>
    </main>
  
    
    
    
</body>
</html>