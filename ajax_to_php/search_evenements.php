<?php

include("../utils/database.php");
connect_db();

include("../pageparts/affichage_event.php");


//Permet de chercher des utilisateurs et de les ajouter en amis

global $conn;

if(isset($_GET['event'])){

    $userID = GetIdWithCookie();
    $input = $_GET['event'];

    $query = "SELECT * FROM `evenement` WHERE (titre LIKE '%$input%') ";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun événements trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){

           CardEvent($row);
        }
    }
}
?>