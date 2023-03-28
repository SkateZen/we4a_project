<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
    include("../database.php");
    connect_db();
    $newAccountStatus = CheckLogin();
    
?>

<?php
    if($newAccountStatus[0]){
        echo '<h3 class="successMessage">Connexion réalisée avec succès !</h3>';
        
        //header('Location: ../utilisateur/acceuil.php');
        //Exit();
    }
    elseif ($newAccountStatus[2]){
        echo '<h3 class="errorMessage">'.$newAccountStatus[2].'</h3>';
    }
?>

<body>
    <h1>Formulaire</h1>

    <h2>Se connecter</h2>

    <form action="" method="post">
        <input type="email" name="mail" id="mail" placeholder="Mail" required>

        <input type="text" name="password" id="password" placeholder="Mot de passe" required>

        <button type="submit" name="login" id="login" > Connect</button>
    </form>

</body>
</html>