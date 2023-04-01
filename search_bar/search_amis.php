<?php

include("../utils/database.php");
connect_db();
CheckLogin();

include("../pageparts/affichage_amis.php");

//Permet de chercher ses amis, leur envoyer un nouveau message ou aller sur une conversation déjà existante

global $conn, $userID;

if(isset($_GET['user'])){
    $input = $_GET['user'];

    //requete qui récupère les utilisateurs qui ont un pseudo, prenom ou nom qui contient l'input

    $query = "SELECT * FROM `utilisateur` WHERE (pseudo LIKE '%$input%' OR prenom LIKE '%$input%' OR nom LIKE '%$input%') ";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun utilisateur trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){

            
            
            $id_ami = $row['id_utilisateur'];


            //requete qui récupère les amis parmis les utilisateurs cherché

            $query2 = "SELECT * FROM `relation` WHERE (id_utilisateur1 = '$userID' AND id_utilisateur2 = '$id_ami' OR 
                                                       id_utilisateur1 = '$id_ami' AND id_utilisateur2 = '$userID') AND statut = 'accepte'";

            $result2 = $conn->query($query2);

            $row2 = $result2->fetch_row();

            if ($row2) {
                echo "<br>".$row['pseudo'];
                echo "<br>".$row['prenom'];
                echo "<br>".$row['nom'];

                //requete qui récupère les messages privés entre l'utilisateur et l'ami

                $query3 = "SELECT COUNT(*) FROM `message_prive` WHERE (id_utilisateur_envoyeur = '$userID' AND id_utilisateur_destinataire = '$id_ami' OR 
                                                                id_utilisateur_envoyeur = '$id_ami' AND id_utilisateur_destinataire = '$userID')";

                $result3 = $conn->query($query3);

                $row3 = $result3->fetch_row()[0];

                if ($row3 > 0) {
                    echo "Conversation déjà existante";
                }
                else{
                    ContactAmiButton($row);
                } 
            }
        }
    }
}



?>