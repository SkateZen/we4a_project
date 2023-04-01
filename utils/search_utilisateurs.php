<?php

include("database.php");
connect_db();
CheckLogin();
//Permet de chercher ses amis, ne marche pas en fonction

global $conn, $userID;

if(isset($_GET['user'])){
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


            echo "<br>".$row['pseudo'];
            echo "<br>".$row['prenom'];
            echo "<br>".$row['nom'];

            $query2 = "SELECT COUNT(*) FROM `relation` WHERE id_utilisateur1 = '$userID' AND id_utilisateur2 = '$id_ami' OR 
                                                                id_utilisateur1 = '$id_ami' AND id_utilisateur2 = '$userID'";

            $result2 = $conn->query($query2);

            $row2 = $result2->fetch_row()[0];

            

            if ($row2 > 0) {
                $error = "Deja amis";
                echo $error;
            }
            else{
                echo "Pas encore amis";
                AjoutAmiButton($row);
            } 
        }
    }
}

function AjoutAmiButton($row){
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>">
        <button type="submit" name="ajout_ami" id="ajout_ami"> Ajouter</button>
    </form>

    <?php
}

?>