<?php

function PageProfil(){

    global $conn, $userID;

    //Si on visite la page d'un ami en ayant cliqué sur sa carte
    if (isset($_GET["pseudo"])){

        $pseudo_ami = $_GET["pseudo"];

        $query = "SELECT * FROM `utilisateur` WHERE `pseudo` = '$pseudo_ami'";

        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        if ($row){
            return $row;
        }
        else{
            $error = "Aucun profil trouvé";
            echo $error;
            return null;   
        }
    }
    //Si on est sur notre profil à nous
    else{
        $query = "SELECT * FROM `utilisateur` WHERE id_utilisateur = $userID";

        $result = $conn->query($query);

        $row = $result->fetch_assoc();

        return $row;
    }


}


function ModifyProfil(){

    global $conn, $userID;

    if(isset($_POST['update_profil'])){

        $name = SecurizeString_ForSQL($_POST['name']);
        $firstname = SecurizeString_ForSQL($_POST['firstname']);
        $pseudo = SecurizeString_ForSQL($_POST['pseudo']);
        $password = md5($_POST['password']);

        //$avatar = $_FILES['avatar']['name'];
        //$avatar_tmp = $_FILES['avatar']['tmp_name'];

        //$id_profil = $_POST['id_profil'];

        $query_verif = "SELECT * FROM utilisateur WHERE id_utilisateur = $userID";

        $result = $conn->query($query_verif);
        $row = $result->fetch_assoc();

        if ($password == $row['password']){

            //echo"password good";

            $query_update = "UPDATE utilisateur SET nom = '$name', prenom = '$firstname', pseudo = '$pseudo' WHERE id_utilisateur = $userID";
            $result = $conn->query($query_update);

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0)
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

                        $new_img_name = uniqid("IMG-", true).'.'.$extension_upload;

                        $path = "images/avatars/".$new_img_name;

                        $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);

                        if ($result){

                            if(!empty($row['photo_profil']) && $row['photo_profil'] != "images/avatars/default-avatar.png"){
                                // echo"photo de profil non vide";
                                unlink($row['photo_profil']);
                            }


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
            echo"Le mot de passe est incorrect  ";
        }
    }
}


?>