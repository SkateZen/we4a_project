<?php

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
            AcceptAmi($id_ami);
        }
    }
}


function AcceptAmiButton($row){
    ?>
    <form action="" method="post">
        <!-- <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>"> -->
        <button type="submit" name="accept_ami" id="accept_ami"> Accepter</button>
    </form>

    <?php
}

function AcceptAmi($id_ami){
    global $conn, $userID;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accept_ami"])){

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

?>