<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <?php
    include("../database.php");
    connect_db();
    CheckLogin();
    ?>

    <header>
        <nav>
            <a href="profil.php">Profil</a>
            <a href="">Messages</a>
            <a href="">Evenements</a>
        </nav>
    </header>

    <h1>Titre de notre Reseau</h1>

    <p>Bravo, vous vous êtes connecté sur notre réseau social. Vous êtes censé pouvoir accéder à des évènements, vous y inscrire, ajouter des évènements, des amis, être heureux et faire la fête !</p>
    
    

    <!-- Recherche d'événements ou amis -->
    <button>
        
        <input type="search" placeholder="Cherchez des évènements ou amis">
    </button>

    <!-- Proposition d'événements -->


    <!-- Ajout d'événements -->

    <button>
        Ajouter
    </button>
    

    
</body>
</html>