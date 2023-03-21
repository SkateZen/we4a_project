<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
include("./database.php");
connect_db();
$newAccountStatus = CheckNewAccountForm();


?>

<h1>Création d'un nouveau compte</h1>
<?php
    if($newAccountStatus[1]){
        echo '<h3 class="successMessage">Nouveau compte crée avec succès!</h3>';
    }
    elseif ($newAccountStatus[0]){
        echo '<h3 class="errorMessage">'.$newAccountStatus[2].'</h3>';
    }
?>

<body>

    <h2>S'inscrire</h2>

    <form action="" method="post">
        <input type="text" name="name" id="name" placeholder="Nom">
        <input type="text" name="firstname" id="firstname" placeholder="Prénom">

        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
        <input type="email" name="mail" id="mail" placeholder="Mail">

        <input type="text" name="password" id="password" placeholder="Mot de passe">
        <input type="text" name="confirm" id="confirm" placeholder="Confirmer mot de passe">

        <button type="submit" name="sign_up" id="sign_up"> Inscription</button>
    </form>
    
</body>
</html>