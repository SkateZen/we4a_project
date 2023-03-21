<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire</h1>

    <h2>Se connecter</h2>

    <form action="" method="post">
        <input type="email" name="mail" id="mail" placeholder="Mail" required>

        <input type="text" name="password" id="password" placeholder="Mot de passe" required>

        <button type="submit" name="login" id="login" > Connect</button>
    </form>

    <?php
        if (isset($_POST['login'])){
            echo "login attempted";

            $mail = $_POST["mail"];
            $password = $_POST["password"];

            if(!empty($mail) && !empty($password)){

                echo "<br>information entered";

                

                echo "<br> mail entered : ".$mail;
            }
            else{
                echo "no information entered";
            }
        }

        elseif (isset($_COOKIE['login'])){
            echo "login attempted with cookie";

            if(isset($_COOKIE["mail"]) && isset($_COOKIE["password"])){

                echo "information entered";
            }
        }
    
    ?>

    

    
    
</body>
</html>