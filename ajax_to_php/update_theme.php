<?php
include("../utils/database.php");
connect_db();


// Fonction pour récupérer la valeur du booléen concernant le theme de l'utilisateur
// Booléen 1 = thème sombre, Booléen 2 = thème clair
//--------------------------------------------------------------------------------
function UpdateTheme() {
    global $conn;
    $mail = $_COOKIE['mail'];
    $theme = getThemeFromDB();

    
    $nouveau_theme = ($theme == 1) ? ($nouveau_theme = 0) : ($nouveau_theme = 1);

    $sql = "UPDATE utilisateur SET is_darkmode = '$nouveau_theme' WHERE email = '$mail'";
    $conn->query($sql);
    // if ($conn->query($sql) === TRUE) {
    //     echo "Thème mis à jour avec succès";
    // } else {
    //     echo "Erreur lors de la mise à jour du thème: " . $conn->error;
    // }


    return intval($nouveau_theme);
}

// Envoi de la valeur au format JSON
echo json_encode(UpdateTheme());


?>