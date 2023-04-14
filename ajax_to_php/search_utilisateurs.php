<?php

include("../utils/database.php");
connect_db();

include("../pageparts/affichage_amis.php");


//Permet de chercher des utilisateurs et de les ajouter en amis

global $conn;

if(isset($_GET['user'])){

    $userID = GetIdWithCookie();
    $input = $_GET['user'];

    $query = "SELECT * FROM `utilisateur` WHERE (pseudo LIKE '%$input%' OR prenom LIKE '%$input%' OR nom LIKE '%$input%') ";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun utilisateur trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){

            
            
            $id_ami = $row['id_utilisateur'];


            CardAmi($row);

            $query2 = "SELECT COUNT(*) FROM `relation` WHERE id_utilisateur1 = '$userID' AND id_utilisateur2 = '$id_ami' OR 
                                                                id_utilisateur1 = '$id_ami' AND id_utilisateur2 = '$userID'";

            $result2 = $conn->query($query2);

            $row2 = $result2->fetch_row()[0];

            if ($row2 == 0) {
                AjoutAmiButton($row);
            } 
        }
    }
}
?>