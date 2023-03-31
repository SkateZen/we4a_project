<?php

include("database.php");
connect_db();
//Permet de chercher ses amis, ne marche pas en fonction

global $conn;

if(isset($_GET['user'])){
    $input = $_GET['user'];
    
    //echo $input;

    $query = "SELECT * FROM `utilisateur` WHERE (pseudo LIKE '%$input%' OR prenom LIKE '%$input%' OR nom LIKE '%$input%') ";

    $result = $conn->query($query);

    if( mysqli_affected_rows($conn) == 0 )
    {
        $error = "Aucun utilisateur trouvé";
    }
    else{
        while($row = mysqli_fetch_array($result)){
            
            //fonction qui affiche les events
            echo "<br>".$row['pseudo'];
            AjoutAmiButton($row);
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