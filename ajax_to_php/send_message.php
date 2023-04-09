<?php

include("../utils/database.php");
connect_db();

global $conn;


if (isset($_POST["pseudo_ami_ajax"])){

    $pseudo = $_POST["pseudo_ami_ajax"];

    // $id_friend = $_SESSION["id_friend"];

    $query_id_ami = "SELECT id_utilisateur FROM `utilisateur` WHERE pseudo = '$pseudo'";
    $result_id_ami = $conn->query($query_id_ami);

    $id_ami = $result_id_ami->fetch_assoc()['id_utilisateur'];

    $userID = GetIdWithCookie();

    echo $_POST["message"];


    if ( !empty($_POST["message"])){

        $message = mysqli_real_escape_string($conn, $_POST["message"]);

        $query = "INSERT INTO `message_prive`(`id_message`, `id_utilisateur_envoyeur`, `id_utilisateur_destinataire`, `date_envoi`, `contenu`) 
                                        VALUES (NULL,'$userID', '$id_ami', CURRENT_TIMESTAMP, '$message')";
        $conn->query($query);
    }

    //code pour envoyer image
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0)
    {
        // Testons si le fichier n'est pas trop gros (2Mo max)
        if ($_FILES['picture']['size'] <= 2097152)
        {
            // Testons si l'extension est autorisée
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

            $extension_upload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));

            if (in_array($extension_upload, $extensions_autorisees))
            {
                // On peut valider le fichier et le stocker définitivement

                $new_img_name = uniqid("IMG-", true).'.'.$extension_upload;

                $path = "../images/messages/".$new_img_name;

                $result = move_uploaded_file($_FILES['picture']['tmp_name'], $path);

                if ($result){
                    $query = "INSERT INTO `message_prive`(`id_message`, `id_utilisateur_envoyeur`, `id_utilisateur_destinataire`, `date_envoi`, `contenu`, `image`) 
                                                VALUES (NULL,'$userID', '$id_ami', CURRENT_TIMESTAMP, '', '$new_img_name')";

                    $result = $conn->query($query);
                }
                else{
                    echo "Erreur lors de l'envoi de votre photo";
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
else if(isset($_POST["id_evenement_forum"])){

    $id_event = $_POST["id_evenement_forum"];

    // $id_friend = $_SESSION["id_friend"];


    $userID = GetIdWithCookie();

    echo $_POST["message"];


    if ( !empty($_POST["message"])){

        $message = mysqli_real_escape_string($conn, $_POST["message"]);

        $query = "INSERT INTO `message_groupe`(`id_message`, `id_utilisateur_envoyeur`, `id_evenement`, `date_envoi`, `contenu`, `image`) 
                                        VALUES (NULL,'$userID', '$id_event', CURRENT_TIMESTAMP, '$message', NULL)";
        $conn->query($query);
    }

    //code pour envoyer image dans forum
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0)
    {
        // Testons si le fichier n'est pas trop gros (2Mo max)
        if ($_FILES['picture']['size'] <= 2097152)
        {
            // Testons si l'extension est autorisée
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

            $extension_upload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));

            if (in_array($extension_upload, $extensions_autorisees))
            {
                // On peut valider le fichier et le stocker définitivement

                $new_img_name = uniqid("IMG-", true).'.'.$extension_upload;

                $path = "../images/forums/".$new_img_name;

                $result = move_uploaded_file($_FILES['picture']['tmp_name'], $path);

                if ($result){
                    $query = "INSERT INTO `message_groupe`(`id_message`, `id_utilisateur_envoyeur`, `id_evenement`, `date_envoi`, `contenu`, `image`) 
                                        VALUES (NULL,'$userID', '$id_event', CURRENT_TIMESTAMP, '', '$new_img_name')";

                    $result = $conn->query($query);
                }
                else{
                    echo "Erreur lors de l'envoi de votre photo";
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



?>