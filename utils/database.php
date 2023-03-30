<?php 

/*define('HOST', 'localhost');
define('DB_NAME', 'we4a_project');
define('USER', 'root');
define('PASS', 'root');*/

/*function connect_db(){

    $dsn = "mysql:host=".HOST.";dbname=".DB_NAME;

    try{

        $db = new PDO($dsn, USER, PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connection OK !";
    
    }catch(PDOException $e){
        echo $e;
    }
}*/

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


// Fonction pour nettoyer l'entrée utilisateur pour des raisons de sécurité
//--------------------------------------------------------------------------------
function SecurizeString_ForSQL($string) {
    $string = trim($string);
    $string = stripcslashes($string);
    $string = addslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

// Fonction pour vérifier si un champs a été rempli par des données non vides
//--------------------------------------------------------------------------------
function CheckPostFieldSetAndNotEmpty($field){
    return isset($_POST[$field]) && !empty($_POST[$field]);
}

//Méthode pour créer/mettre à jour des cookies de Login
//--------------------------------------------------------------------------------
function CreateLoginCookie($mail, $encryptedPasswd){
    setcookie("mail", $mail, time() + 3600  ); // Durée des cookies normalement :24 * 3600 
    setcookie("password", $encryptedPasswd, time() + 3600);
}

//Méthode pour détruire les cookies de Login
//--------------------------------------------------------------------------------
function DestroyLoginCookie(){
    setcookie("mail", NULL, -1);
    setcookie("password", NULL, -1);
}

// Fonction permettant de s'inscrire sur le site
//--------------------------------------------------------------------------------
function CheckNewAccountForm(){
    global $conn;
    $creationAttempted = false;
    $creationSuccessful = false;
    $error = NULL;

    // Vérifier que le formulaire a été envoyé avec la méthode POST et que le bouton d'inscription a été cliqué
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sign_up"])){
        $creationAttempted = true;

        // Vérifier si chacun des champs a été rempli par des données non vides
        if (CheckPostFieldSetAndNotEmpty("name") && CheckPostFieldSetAndNotEmpty("firstname") &&
            CheckPostFieldSetAndNotEmpty("pseudo") && CheckPostFieldSetAndNotEmpty("mail") &&
            CheckPostFieldSetAndNotEmpty("password") && CheckPostFieldSetAndNotEmpty("confirm")){

            // Sécurisation des données saisies par l'utilisateur
            $name = SecurizeString_ForSQL($_POST["name"]);
            $firstname = SecurizeString_ForSQL($_POST["firstname"]);
            $pseudo = SecurizeString_ForSQL($_POST["pseudo"]);
            $mail = SecurizeString_ForSQL($_POST["mail"]);
            $password = md5($_POST["password"]);

            // Vérifier si le nom d'utilisateur existe déjà dans la base de données
            $query = "SELECT COUNT(*) FROM utilisateur WHERE email='$mail'";
            $result = $conn->query($query);
            $row = $result->fetch_row()[0];

            
            // Le formulaire est valide seulement s'il n'existe pas déjà un compte avec l'email renseigné,
            // si le pseudo a au moins 4 caractères et si password == confirm
            if ($row > 0) {
                $error = "Le mail est déjà utilisé";
                echo $error;
                echo $row;
            } 
            elseif (strlen($_POST["pseudo"]) < 4 ){
                $error = "Le nom d'utilisateur doit avoir une longueur d'au moins 4 lettres";
            }
            elseif ($_POST["password"] != $_POST["confirm"]){
                $error = "Le mot de passe et sa confirmation sont différents";
            }
            else {
                // Création du compte dans la base de données
                $query = "INSERT INTO `utilisateur` (`nom`, `prenom`, `pseudo`, `email`, `password`) 
                        VALUES ('$name', '$firstname', '$pseudo', '$mail', '$password')";
                $result = $conn->query($query);

                if (!$result) {
                    $error = "Erreur lors de l'insertion SQL. Essayez un nom/prenom/password sans caractères spéciaux";
                } 
                else {
                    $creationSuccessful = true;
                }
            }
        } 
        else {
            $error = "Tous les champs doivent être remplis";
        }
    }

    return array($creationAttempted, $creationSuccessful, $error);
}


// Fonction pour vérifier une connexion, retourne 2 booléens
// Booléen 1 = connexion réussie, Booléen 2 = tentative de connexion
//--------------------------------------------------------------------------------
function CheckLogin(){

    global $conn, $userID;
    global $name, $firstname, $pseudo;
        

    $error = NULL; 
    $loginSuccessful = false;
    $loginAttempted = false;

    // Données reçues via formulaire
    // Vérifier que le formulaire a été envoyé avec la méthode POST et que le bouton de connexion a été cliqué
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        // Vérifier si chacun des champs a été rempli par des données non vides
        if (CheckPostFieldSetAndNotEmpty("mail") && CheckPostFieldSetAndNotEmpty("password")){
            $mail = SecurizeString_ForSQL($_POST["mail"]);
            $password = md5($_POST["password"]);
            $loginAttempted = true;
            echo "<br>Connexion tentée avec des informations envoyées via le formulaire";
            echo "<br>Adresse e-mail : ".$mail;
        }
    }
    // Données reçues via les cookies
    elseif (isset($_COOKIE['mail']) && isset($_COOKIE["password"])){
        $mail = $_COOKIE["mail"];
        $password = $_COOKIE["password"];
        $loginAttempted = true;
        echo "<br>Connexion tentée avec des informations stockées dans les cookies";
        echo "<br>Adresse e-mail : ".$mail;

    }

    
    // Si tentative de connexion, on interroge la BDD
    if ($loginAttempted){
        $query = "SELECT * FROM utilisateur WHERE email = '".$mail."' AND password ='".$password."'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();

        if ( $row ){
            $pseudo = $row["pseudo"];
            $name = $row["nom"];
            $firstname = $row["prenom"];
            $userID = $row["id_utilisateur"];

            echo "<br>Pseudo : ".$pseudo;
            echo "<br>Prénom : ".$firstname;

            CreateLoginCookie($mail, $password);
            $loginSuccessful = true;
        }
        else {
            $error = "Ce couple identifiant/mot de passe n'existe pas. Veuillez créer un compte.";
            echo "<br>".$error;
        }
    }

    return array($loginSuccessful, $loginAttempted, $error, $userID);
}

?>

