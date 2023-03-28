<?php 

define('SERVER', 'localhost');
define('DB_NAME', 'socialnetwork');
define('USER', 'root');
define('PASSWD', 'root');

// Function to open a connexion to the database
//--------------------------------------------------------------------------------
function connect_db(){
    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "socialnetwork";
    global $conn;
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        echo "Connection DB OK !";
    }
}


//Function to clean up an user input for safety reasons
//--------------------------------------------------------------------------------
function SecurizeString_ForSQL($string) {
    $string = trim($string);
    $string = stripcslashes($string);
    $string = addslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

// Function to check if the specified field is set and not empty
//--------------------------------------------------------------------------------
function CheckPostFieldSetAndNotEmpty($field){
    return isset($_POST[$field]) && !empty($_POST[$field]);
}

// Fonction permettant de s'inscrire sur le site
//--------------------------------------------------------------------------------
function CheckNewAccountForm(){
    global $conn;

    $creationAttempted = false;
    $creationSuccessful = false;
    $error = NULL;

    //Données reçues via formulaire?
    if (CheckPostFieldSetAndNotEmpty("name") && CheckPostFieldSetAndNotEmpty("firstname") &&
        CheckPostFieldSetAndNotEmpty("pseudo") && CheckPostFieldSetAndNotEmpty("mail") &&
        CheckPostFieldSetAndNotEmpty("password") && CheckPostFieldSetAndNotEmpty("confirm")){

        echo "creation account attempted";
        $creationAttempted = true;

        //Form is only valid if password == confirm, and username is at least 4 char long
        if ( strlen($_POST["pseudo"]) < 4 ){
            $error = "Un nom utilisateur doit avoir une longueur d'au moins 4 lettres";
        }
        elseif ( $_POST["password"] != $_POST["confirm"] ){
            $error = "Le mot de passe et sa confirmation sont différents";
        }
        else {

            $name = SecurizeString_ForSQL($_POST["name"]);
            $firstname = SecurizeString_ForSQL($_POST["firstname"]);
            $pseudo = SecurizeString_ForSQL($_POST["pseudo"]);
            $mail = SecurizeString_ForSQL($_POST["mail"]);
            $password = md5($_POST["password"]);

            $query = "INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `pseudo`, `email`, `password`, `photo_profil`) 
                    VALUES (NULL, '$name', '$firstname', '$pseudo', '$mail', '$password', NULL)";
            echo $query."<br>";
            $result = $conn->query($query);

            if( mysqli_affected_rows($conn) == 0 ) {
                $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
            } 
            else{
                $creationSuccessful = true;
            }
        }
    
    return array($creationAttempted, $creationSuccessful, $error);
    }
}


// Fonction pour vérifier une connexion, retourne 2 booléens
// Booléen 1 = connexion réussie, Booléen 2 = tentative de connexion
//--------------------------------------------------------------------------------
function CheckLogin(){

    global $conn, $mail, $userID;

    $error = NULL; 
    $loginSuccessful = false;
    $loginAttempted = false;

    if (!isset($_POST["login"])) {
        return;
    }

    // Données reçues via formulaire?
    if (CheckPostFieldSetAndNotEmpty($_POST["mail"]) && CheckPostFieldSetAndNotEmpty($_POST["password"])){
        $mail = SecurizeString_ForSQL($_POST["mail"]);
        $password = md5($_POST["password"]);
        $loginAttempted = true;
        echo "login attempted";
        echo "<br>information entered";
        echo "<br> mail entered : ".$mail;

    }
    //Données via le cookie?
    elseif (isset($_COOKIE['mail']) && isset($_COOKIE["password"])){
        $mail = $_COOKIE["mail"];
        $password = $_COOKIE["password"];
        $loginAttempted = true;
        echo "login attempted with cookie";
        echo "information entered";

    }

    // Si tentative de connexion, on interroge la BDD
    if ($loginAttempted){
        $query = "SELECT * FROM users WHERE email = '".$mail."' AND password ='".$password."'";
        $result = $conn->query($query);

        if ( $result ){
            //echo $result;
            $row = $result->fetch_assoc();
            echo "<br>".$row["pseudo"];
            $userID = $row["id"];
            CreateLoginCookie($mail, $password);
            $loginSuccessful = true;
        }
        else {
            $error = "Ce couple login/mot de passe n'existe pas. Créez un Compte";
        }
    }

    return array($loginSuccessful, $loginAttempted, $error, $userID);
}

//Méthode pour créer/mettre à jour le cookie de Login
//--------------------------------------------------------------------------------
function CreateLoginCookie($mail, $encryptedPasswd){
setcookie("mail", $mail, time() + 60*60  ); /* 24 * 3600 */
    setcookie("password", $encryptedPasswd, time() + 24*3600);
}

/*
function TestSQL(){
    global $conn;

    
    if ( isset($_POST['test'])){
    
        $query= "SELECT * FROM `users` ";


    }
}*/

?>

