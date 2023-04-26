<?php

include("pageparts/affichage_amis.php");


//fonction qui permet de demander une personne en ami
function AjoutAmi(){
    global $conn, $userID;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajout_ami"])){

        $id_ami = $_POST["id_ami"];

        $query = "SELECT COUNT(*) FROM `relation` WHERE id_utilisateur1 = '$userID' AND id_utilisateur2 = '$id_ami' OR 
                                                                id_utilisateur1 = '$id_ami' AND id_utilisateur2 = '$userID'";

        $result = $conn->query($query);

        $row = $result->fetch_row()[0];


        if ($row > 0) {
            $error = "Deja amis";
            echo $error;
        }
        else{
            $query2 = "INSERT INTO `relation`(`id_relation`, `id_utilisateur1`, `id_utilisateur2`, `statut` ) VALUES (NULL, '$userID', '$id_ami', 'en attente')";

            $result2 = $conn->query($query2);

            if (!$result2) {
                $error = "Erreur lors de l'insertion SQL.";
                echo $error;
            }    
            else{
                echo "Ajout réussie";
            }
        } 
    }
}

function ShowAmis(){

    global $conn, $userID;

    //requete qui affiche les amis

    $query = "SELECT * FROM `utilisateur` WHERE id_utilisateur IN (SELECT id_utilisateur2 FROM `relation` WHERE id_utilisateur1 = '$userID' AND statut = 'accepte') OR 
                                                id_utilisateur IN (SELECT id_utilisateur1 FROM `relation` WHERE id_utilisateur2 = '$userID' AND statut = 'accepte')";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun utilisateur trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            
            //fonction qui affiche les events
            $id_ami = $row['id_utilisateur'];
            echo "<br>".$row['pseudo'];
        }
    }
}

function ShowDemandeAmis(){

    global $conn, $userID;

    //requete qui affiche les demandes d'amis

    $query = "SELECT * FROM `utilisateur` WHERE id_utilisateur IN (SELECT id_utilisateur1 FROM `relation` WHERE id_utilisateur2 = '$userID' AND statut = 'en attente')";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun utilisateur trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            
            //fonction qui affiche les events
            $id_ami = $row['id_utilisateur'];
            echo "<br>".$row['pseudo'];
            AcceptAmiButton($row);
        }
    }
}


function AcceptAmi(){
    global $conn, $userID;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accept_ami"])){

        $id_ami = $_POST["id_ami"];

        $query = "UPDATE `relation` SET `statut`='accepte' WHERE id_utilisateur1 = '$id_ami' AND id_utilisateur2 = '$userID'";

        $result = $conn->query($query);

        if (!$result) {
            $error = "Erreur lors de l'insertion SQL.";
            echo $error;
        }    
        else{
            echo "Inscription réussie";
        }
    }
}

// function ContactAmi(){
//     global $conn, $userID;

//     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["contact_ami"])){

        
//     }
// }

function ShowParticipantsEvent($row){
    global $conn;
    $id_event = $row["id_evenement"];

    $query = "SELECT id_utilisateur FROM `inscription_evenement` WHERE id_evenement = '$id_event'";

    $result = $conn->query($query);

    $n = $result->num_rows;

    ?>
    <h2><?php echo"Il y'a $n participants"; ?></h2>


    <button id="exit-button-participants" class="exit-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px">
                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
        </button>
    <?php
    

    while ($row = mysqli_fetch_array($result)){

        $id_utilisateur = $row["id_utilisateur"];

        $query2 = "SELECT * FROM `utilisateur` WHERE id_utilisateur = '$id_utilisateur'";

        $result2 = $conn->query($query2);

        $row2 = $result2->fetch_assoc();

        $nom = $row2["nom"];

        $prenom = $row2["prenom"];

        // echo "<p>$prenom $nom</p>";
        CardAmi($row2);

    }
}


function ShowAmisWithConversation(){
    global $conn, $userID;

    //requete qui récupère les amis

    $query = "SELECT * FROM `utilisateur` WHERE id_utilisateur IN (SELECT id_utilisateur1 FROM `relation` WHERE id_utilisateur2 = '$userID' AND statut = 'accepte') OR 
                                                id_utilisateur IN (SELECT id_utilisateur2 FROM `relation` WHERE id_utilisateur1 = '$userID' AND statut = 'accepte')";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun utilisateur trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){ 


            $id_ami = $row['id_utilisateur'];
            

            //requete qui recupère les conversations avec l'ami

            $query2 = "SELECT * FROM `message_prive` WHERE (id_utilisateur_envoyeur = '$userID' AND id_utilisateur_destinataire = '$id_ami' OR 
                                                                id_utilisateur_envoyeur = '$id_ami' AND id_utilisateur_destinataire = '$userID')";

            $result2 = $conn->query($query2);

            $row2 = $result2->fetch_row()[0];

            if ($row2) {
                
                SelectConversation($row);
                
            }
            
        }
    }
}

function ShowConversation(){

    global $conn, $userID;

    if (isset($_POST["pseudo_ami"])){

        $pseudo = $_POST["pseudo_ami"];

        $showAttempted = true;

        $query = "SELECT * FROM `utilisateur` WHERE pseudo = '$pseudo'";

        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        if ($row){
            ChatBox($row);

        }
        else{
            $error = "Aucun utilisateur trouvé";
            echo $error;
        }
    }
}


function ShowInvitationAmis(){

    global $conn, $userID;

    //requete qui affiche les amis

    $query = "SELECT * FROM `utilisateur` WHERE id_utilisateur IN (SELECT id_utilisateur2 FROM `relation` WHERE id_utilisateur1 = '$userID' AND statut = 'accepte') OR 
                                                id_utilisateur IN (SELECT id_utilisateur1 FROM `relation` WHERE id_utilisateur2 = '$userID' AND statut = 'accepte')";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun utilisateur trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            
            //fonction qui affiche les events
            $id_ami = $row['id_utilisateur'];
            $pseudo_ami = $row['pseudo'];
            
            ?>


            <div>
                <input type="checkbox" class="ecart-right" name=<?php echo $pseudo_ami;?> value=<?php echo $id_ami;?>>
                <label for=""><?php echo $pseudo_ami;?></label>
            </div>
            
        <?php
        }
    }
}


// function SendMessage(){
//     global $conn, $userID;

//     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send_message_ami"])){

//         $message = $_POST["message"];

//         $pseudo = $_POST["pseudo_ami"];

//         $query = "SELECT id_utilisateur FROM `utilisateur` WHERE pseudo = '$pseudo'";

//         $result = $conn->query($query);

//         $id_ami = $result->fetch_assoc()['id_utilisateur'];

    
//         $query2 = "INSERT INTO `message_prive`(`id_message`, `id_utilisateur_envoyeur`, `id_utilisateur_destinataire`, `date_envoi`, `contenu`) VALUES (NULL,'$userID', '$id_ami', CURRENT_TIMESTAMP, '$message')";

//         $result2 = $conn->query($query2);

//         if (!$result2) {
//             $error = "Erreur lors de l'insertion SQL.";
//             echo $error;
//         }    
//         else{
//             echo "Message envoyé";
//         }
//     }
// }
?>