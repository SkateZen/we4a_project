<?php

function ModifyProfilForm(){

    global $conn, $userID;


    $query = "SELECT * FROM utilisateur WHERE id_utilisateur = $userID";

    $result = $conn->query($query);

    $row = $result->fetch_assoc();

    $name = $row['nom'];
    $firstname = $row['prenom'];
    $pseudo = $row['pseudo'];
    
    ?>
    <div>
        <h2>Modifier infos utilisateur</h2>
        
        <form action="" method="POST" enctype="multipart/form-data">

            <input type="text" name="name" id="name" placeholder="Nom" value="<?php echo $name; ?>">
            <input type="text" name="firstname" id="firstname" placeholder="Prénom" value="<?php echo $firstname; ?>">

            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php echo $pseudo; ?>">

            <label >Avatar :</label>
            <input type="file" name="avatar">

            <input type="text" name="password" id="password" placeholder="Mot de passe">
            <!-- <input type="text" name="confirm" id="confirm" placeholder="Confirmer mot de passe"> -->

            <button type="submit" name="update_profil" id="update_profil"> Modifier</button>
        </form>
    </div>
    <?php
}


function DisplayProfil(){

    global $conn, $userID;


    $query = "SELECT * FROM utilisateur WHERE id_utilisateur = $userID";

    $result = $conn->query($query);

    $row = $result->fetch_assoc();

    $name = $row['nom'];
    $firstname = $row['prenom'];
    $pseudo = $row['pseudo'];
    $avatar = $row['photo_profil'];

    ?>
    <div>
        <h1>Infos utilisateur</h1>
        
        <p> Nom : <?php echo $name; ?> </p>
        
        <p> Prénom : <?php echo $firstname; ?> </p>

        <?php
        if ($avatar != ""){
            ?>
            <img src="<?php echo $avatar; ?>" alt="avatar">
            <?php
        }
        ?>
        <p> Pseudo : <?php echo $pseudo; ?> </p>
        
    </div>

    <?php
}

?>