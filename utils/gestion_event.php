<?php
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

    global $conn;

    $query = "SELECT * FROM `evenement`";
    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        echo "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            echo "<div class='event'>";
            echo "<h3>".$row['titre']."</h3>";
            echo "<p>".$row['description']."</p>";
            echo "<p>".$row['date']."</p>";
            echo "<p>".$row['heure']."</p>";
            echo "<p>".$row['lieu']."</p>";
            echo "</div>";
        }
    }
}

function ShowEventWithIdCreator(){

    global $conn, $userID;

    $query = "SELECT * FROM `evenement` WHERE id_createur = '$userID'";
    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        echo "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            echo "<div class='event'>";
            echo "<h3>".$row['titre']."</h3>";
            echo "<p>".$row['description']."</p>";
            echo "<p>".$row['date']."</p>";
            echo "<p>".$row['heure']."</p>";
            echo "<p>".$row['lieu']."</p>";
            echo "</div>";
        }
    }
}

?>