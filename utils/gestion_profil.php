<?php


function ModifyProfil(){

    global $conn, $userID;

    if(isset($_POST['update_profil'])){

        $name = $_POST['name'];
        $firstname = $_POST['firstname'];
        $pseudo = $_POST['pseudo'];
        $password = md5($_POST['password']);

        //$avatar = $_FILES['avatar']['name'];
        //$avatar_tmp = $_FILES['avatar']['tmp_name'];

        //$id_profil = $_POST['id_profil'];

        $query_verif = "SELECT `password` FROM utilisateur WHERE id_utilisateur = $userID";

        $result = $conn->query($query_verif);
        $row = $result->fetch_assoc();

        if ($password == $row['password']){

            //echo"password good";

            $query_update = "UPDATE utilisateur SET nom = '$name', prenom = '$firstname', pseudo = '$pseudo' WHERE id_utilisateur = $userID";
            $result = $conn->query($query_update);

            if (isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0)
            {
                // Testons si le fichier n'est pas trop gros (2Mo max)
                if ($_FILES['avatar']['size'] <= 2097152)
                {
                    // Testons si l'extension est autorisée
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

                    $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

                    if (in_array($extension_upload, $extensions_autorisees))
                    {
                        // On peut valider le fichier et le stocker définitivement

                        $path = "images/avatars/".$userID.".".$extension_upload;

                        $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);

                        if ($result){
                            $query_update = "UPDATE utilisateur SET photo_profil = '$path' WHERE id_utilisateur = $userID";
                            $result = $conn->query($query_update);
                        }
                        else{
                            echo "Erreur lors de l'importation de votre photo de profil";
                        }
                        //echo "L'envoi a bien été effectué !";
                    }
                    else{
                        echo "L'extension du fichier doit être jpg, jpeg, gif ou png";
                    }
                }
                else{
                    echo "Le fichier doit être inférieur à 2Mo";
                }
            }
        }
        else{
            echo"Le mot de passe est incorrect";
        }
    }
}


?>