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
        $description = $_POST["description"];
        $date = $_POST["date"];
        $heure = $_POST["heure"];
        $lieu = $_POST["lieu"];

        $query = "INSERT INTO `evenement`(`id_evenement`, `titre`, `description`, `date`, `heure`, `lieu`, `id_createur`) VALUES (NULL, '$titre', '$description', '$date', '$heure', '$lieu', '$userID')";
        echo $query."<br>";
        $result = $conn->query($query);

        if( mysqli_affected_rows($conn) == 0 )
        {
            $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
        }
        else{
            $creationSuccessful = true;
        }

        
        return array($creationAttempted, $creationSuccessful, $error);
    }
}



function ShowEvent(){

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
            CardEvent($row);
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

        $query = "INSERT INTO `inscription_evenement`(`id_relation`, `id_utilisateur`, `id_evenement`) VALUES (NULL, '$userID', '$id_event')";

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

?>