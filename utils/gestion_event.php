<?php

include("pageparts/affichage_event.php");


function AjoutEvent(){
    global $conn;
    global $userID;

    $creationAttempted = false;
    $creationSuccessful = false;
    $error = NULL;

    //Données reçues via formulaire?

    if ( isset($_POST['ajout_event'])){

        echo "creation event attempted";
        $creationAttempted = true;

        $titre = $_POST["titre"];
        $id_categorie = $_POST["categorie"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $heure = $_POST["heure"];
        $lieu = $_POST["lieu"];
        $is_public = $_POST["is_public"];
        $max_participants = $_POST["max_participants"];

        //Gestion image profil

        $path = NULL;

        if (isset($_FILES['image_event']) && $_FILES['image_event']['error'] == 0)
        {
            // Testons si le fichier n'est pas trop gros (2Mo max)
            if ($_FILES['image_event']['size'] <= 2097152)
            {
                // Testons si l'extension est autorisée
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

                $extension_upload = strtolower(substr(strrchr($_FILES['image_event']['name'], '.'), 1));

                if (in_array($extension_upload, $extensions_autorisees))
                {
                    // On peut valider le fichier et le stocker définitivement

                    $new_img_name = uniqid("IMG-", true).'.'.$extension_upload;

                    $path = "images/evenements/".$new_img_name;

                    $result = move_uploaded_file($_FILES['image_event']['tmp_name'], $path);

                    if (!$result){

                        echo "Erreur lors de l'importation de votre photo de profil";
                    }
                    //echo "L'envoi a bien été effectué !";
                }
                else{
                    echo "L'extension du fichier doit être jpg, jpeg, gif ou png";
                }
            }
            else{
                echo "Le fichier doit être inférieur à 2Mo";
            }
        }


        //Insertion événement
        
        if (!$max_participants || $max_participants <= 0){
            $query = "INSERT INTO `evenement`(`id_evenement`, `id_createur`, `titre`, `id_categorie`, `description`, `image`, `date`, `heure`, `lieu`, `is_public`, `nb_participants`) 
                    VALUES (NULL, '$userID', '$titre', '$id_categorie', '$description', '$path', '$date', '$heure', '$lieu', '$is_public', NULL)";
        }
        else{
            $query = "INSERT INTO `evenement`(`id_evenement`, `id_createur`, `titre`, `id_categorie`, `description`, `image`, `date`, `heure`, `lieu`, `is_public`, `nb_participants`) 
                    VALUES (NULL, '$userID', '$titre', '$id_categorie', '$description', '$path', '$date', '$heure', '$lieu', '$is_public', '$max_participants')";
        }

        echo $query."<br>";
        $result = $conn->query($query);

        if( mysqli_affected_rows($conn) == 0 )
        {
            $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
            echo $error;
        }
        else{
            //On récupère l'id de l'event créé
            $id_event = mysqli_insert_id($conn);
            echo "id_event =".$id_event;
            //On invite les amis
            InviteAmis($id_event);
            
            echo"creation réussie";
            $creationSuccessful = true;

            header("Location: personal_events.php");
        }

        return array($creationAttempted, $creationSuccessful, $error);
    }
}


function InviteAmis($id_event){
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
            echo "<br>".$pseudo_ami;

            if (isset($_POST[$pseudo_ami])){

                //Cette ami est invité
                echo "ami invité";
                echo $id_ami;
                echo $id_event;

                $query2 = "INSERT INTO `invitation_evenement` (`id_invitation`, `id_utilisateur`, `id_inviteur`, `id_evenement`, `date_invitation`) VALUES (NULL, '$id_ami', '$userID', '$id_event', CURRENT_TIMESTAMP())";
                $result2 = $conn->query($query2);

                if (!$result2) {
                    $error = "Erreur lors de l'insertion SQL.";
                    echo $error;
                }    
                else{
                    echo "Invitation réussie";
                }
            }
        }
    }
}


function ShowCategories(){
    global $conn;

    $query = "SELECT * FROM `categorie`";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        ?>
            <option value="<?php echo $row['id_categorie']; ?>"> 
                "<?php echo $row['categorie']; ?>"
            </option>
        <?php
    }
}



function ShowPublicEvent(){

    global $conn, $userID;

    //$query = "SELECT * FROM `evenement`";

    $query = "SELECT * FROM `evenement` WHERE id_evenement NOT IN (SELECT id_evenement FROM `inscription_evenement` WHERE id_utilisateur = '$userID') AND id_createur != '$userID'";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        echo "Aucun evenement disponible";
    }
    else{
        while($row = mysqli_fetch_array($result)){

            //fonction qui affiche les events
            if ($row['is_public'] == 1){

                if ($row['nb_participants'] == NULL){
                    CardEvent($row);
                }
                else if (NumberOfParticipants($row) < $row['nb_participants']){
                    CardEvent($row);
                }
                
            }
            
            //InscriptionButton($row);
        }
    }
}

function ShowEventWithIdCreator(){

    global $conn, $userID;

    $query = "SELECT * FROM `evenement` WHERE id_createur = '$userID'";
    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        echo "Aucun evenement";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            CardEvent($row);
        }
    }
}

function ShowEventWithIdUser(){

    global $conn, $userID;

    $query = "SELECT * FROM `evenement` WHERE id_evenement IN (SELECT id_evenement FROM `inscription_evenement` WHERE id_utilisateur = '$userID')";
    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        echo "Aucun evenement";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            CardEvent($row);
        }
    }
}

function InscriptionIntoEvent(){

    global $conn, $userID;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscription_event"])){

        $id_event = $_POST["id_event"];

        $query_verify = "SELECT COUNT(*) FROM `inscription_evenement` WHERE id_evenement = '$id_event' AND id_utilisateur = '$userID'";

        $result_verify = $conn->query($query_verify);

        $row = $result_verify->fetch_row()[0];

        if ($row > 0){
            echo "Vous êtes déjà inscrit à cet évènement";
            return;
        }else{
            $query = "INSERT INTO `inscription_evenement`(`id_relation`, `id_utilisateur`, `id_evenement`) VALUES (NULL, '$userID', '$id_event')";

            $result = $conn->query($query);

            if (!$result) {
                $error = "Erreur lors de l'insertion SQL.";
                echo $error;
            }    
            else{
                echo "Inscription réussie";
                //header('Location: ./evenement.php');
            }
        }
    }
}

function DesinscriptionFromEvent(){

    global $conn, $userID;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["desinscription_event"])){

        $id_event = $_POST["id_event"];

        $query = "DELETE FROM `inscription_evenement` WHERE id_evenement = '$id_event' AND id_utilisateur = '$userID'";

        $result = $conn->query($query);

        if (!$result) {
            $error = "Erreur lors de l'insertion SQL.";
            echo $error;
        }    
        else{
            echo "Desinscription réussie";
        }
    }
}

function PageEvent(){

    global $conn, $userID;

    if ( isset($_GET["id_event"])){

        $id_event = $_GET["id_event"];

        $query = "SELECT * FROM `evenement` WHERE id_evenement = '$id_event'";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        if ($row){
            return $row;

        }
        else{
            $error = "Aucun evenement trouvé";
            echo $error;
            return null;
        }
    }
}


function CreateurEvent($id_creator){

    global $conn;

    $query = "SELECT * FROM `utilisateur` WHERE id_utilisateur = '$id_creator'";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    return $row;
}


function UserInEvent($row_event){

    global $conn, $userID;

    $id_event = $row_event['id_evenement'];

    $query = "SELECT COUNT(*) FROM `inscription_evenement` WHERE id_evenement = '$id_event' AND id_utilisateur = '$userID'";

    $result = $conn->query($query);
    $row = $result->fetch_row()[0];

    if ($row > 0) {
        
        return true;
    } 
    else{
        return false;
    }

}

function CreatorEvent($row_event){

    global $conn, $userID;

    $id_event = $row_event['id_evenement'];

    $query = "SELECT COUNT(*) FROM `evenement` WHERE id_evenement = '$id_event' AND id_createur = '$userID'";

    $result = $conn->query($query);
    $row = $result->fetch_row()[0];

    if ($row > 0) {
        return true;
    } 
    else{
        return false;
    }
}


function ModifyEvent(){

    global $conn, $userID;

    if (isset($_POST['update_event'])){

        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $lieu = $_POST['lieu'];

        $id_event = $_POST['id_event'];
        $id_createur = $_POST['id_createur'];

        $password = md5($_POST['password']);


        $query_verif = "SELECT `password` FROM utilisateur WHERE id_utilisateur = $userID";

        $result = $conn->query($query_verif);
        $row = $result->fetch_assoc();

        if ($id_createur == $userID && $password == $row['password']){

            //echo"password good";

            $query_update = "UPDATE `evenement` SET `titre`='$titre', `description`='$description', `date`='$date', `heure`='$heure', `lieu`='$lieu' WHERE id_evenement = '$id_event'";

            $result = $conn->query($query_update);
        }
    }
    if (isset($_POST['delete_event'])){

        $id_event = $_POST['id_event'];
        $id_createur = $_POST['id_createur'];

        $password = md5($_POST['password']);

        $query_verif = "SELECT `password` FROM utilisateur WHERE id_utilisateur = $userID";

        $result = $conn->query($query_verif);
        $row = $result->fetch_assoc();

        if ($id_createur == $userID && $password == $row['password']){

            echo "password good";
            echo $id_event;

            $query_delete_invitation = "DELETE FROM `invitation_evenement` WHERE id_evenement = '$id_event'";

            $result = $conn->query($query_delete_invitation);

            $query_delete_inscription = "DELETE FROM `inscription_evenement` WHERE id_evenement = '$id_event'";

            $result = $conn->query($query_delete_inscription);


            $query_delete = "DELETE FROM `evenement` WHERE id_evenement = '$id_event'";

            $result = $conn->query($query_delete);

            if (!$result) {
                $error = "Erreur lors de l'insertion SQL.";
                echo $error;
            }    
        }
        else{
            echo "Mot de passe incorrect";
        }
    }
}

function NumberOfParticipants($row_event){
    global $conn;

    $id_event = $row_event['id_evenement'];

    $query = "SELECT COUNT(*) FROM `inscription_evenement` WHERE id_evenement = '$id_event'";

    $result = $conn->query($query);
    $row = $result->fetch_row()[0];

    return $row;
}

?>