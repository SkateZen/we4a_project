<?php

include("../utils/database.php");
connect_db();

global $conn;


if (isset($_POST["id_event"])){

    $id_event = $_POST["id_event"];

    $query = "SELECT id_utilisateur FROM `inscription_evenement` WHERE id_evenement = '$id_event'";

    $result = $conn->query($query);

    $n = $result->num_rows;

    echo"Il y'a $n participants";

    while ($row = mysqli_fetch_array($result)){

        $id_utilisateur = $row["id_utilisateur"];

        $query2 = "SELECT nom, prenom FROM `utilisateur` WHERE id_utilisateur = '$id_utilisateur'";

        $result2 = $conn->query($query2);

        $row2 = $result2->fetch_assoc();

        $nom = $row2["nom"];

        $prenom = $row2["prenom"];

        echo "<p>$prenom $nom</p>";

    }

}