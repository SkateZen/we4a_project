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
    <div id="modify-profil-form" class="form-on-top hide">
        
        <form action="./redirect_profil.php" class="formulaire" method="POST" enctype="multipart/form-data">

            <button id="exit-button" class="exit-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px">
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
            </button>

            <h2>Modifier infos utilisateur</h2>

            <input type="text" name="name" id="name" placeholder="Nom" value="<?php echo $name; ?>">
            <input type="text" name="firstname" id="firstname" placeholder="Prénom" value="<?php echo $firstname; ?>">

            <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php echo $pseudo; ?>">

            <label >Avatar :</label>
            <input type="file" name="avatar">

            <input type="text" name="password" id="password" placeholder="Mot de passe" required>
            <!-- <input type="text" name="confirm" id="confirm" placeholder="Confirmer mot de passe"> -->

            <button class="submit-button" type="submit" name="update_profil" id="update_profil"> Modifier</button>
        </form>
    </div>
    
    <?php
}


function DisplayProfil($row){

    global $conn, $userID;


    // $query = "SELECT * FROM utilisateur WHERE id_utilisateur = $userID";

    // $result = $conn->query($query);

    // $row = $result->fetch_assoc();

    $name = $row['nom'];
    $firstname = $row['prenom'];
    $pseudo = $row['pseudo'];
    $avatar = $row['photo_profil'];

    $id_ami = $row['id_utilisateur'];

    ?>

    <div class="profil-bar">

        <?php
        if (!empty($avatar)){
            ?>
            <img src="<?php echo $avatar; ?>" width="255px" height="255px" alt="avatar">
            <?php
        }
        ?>

        <!-- <img src="../images/avatars/IMG-6438522f4fc787.69435124.jpg"  width="255px" height="255px" alt="avatar"> -->

        <div class="user-infos">

            <h1> <?php echo $pseudo; ?></h1>

            <p> <?php echo $firstname." ".$name; ?></p>
            
            
            <?php
            if ( $id_ami == $userID){
            ?>

            <div class="profil-button">

                <button id="modify-button" class="ecart-button">Modifier</button>
                
                <form action="./logout.php" method="POST">
                    
                    <input type="hidden" value="logout" name="logout"></input>
                    <button type="submit">Se déconnecter</button>
                    

                </form>
            </div>

            <?php
            }
            else{
                $query = "SELECT * FROM `relation` WHERE id_utilisateur1 = '$userID' AND id_utilisateur2 = '$id_ami' OR 
                id_utilisateur1 = '$id_ami' AND id_utilisateur2 = '$userID'";

                $result = $conn->query($query);

                $row2 = $result->fetch_assoc();

                if ($row2 > 0 && $row2['statut'] == 'accepte'){
                    ?>
                    <div class="profil-button">
                        <button id="contact-button" class="ecart-button">Contacter</button>
                    </div>
                    <?php
                }
                else if($row2 > 0 && $row2['statut'] == 'en attente'){
                    echo "en attente";
                }
                else{
                    ?>
                    <div class="profil-button">
                        <button id="ajout-button" class="ecart-button">Ajouter</button>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <?php
}

?>