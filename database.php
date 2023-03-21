<?php 

    define('HOST', 'localhost');
    define('DB_NAME', 'we4a_project');
    define('USER', 'root');
    define('PASS', 'root');

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
        $dbname = "td3";
        global $conn;
        
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else{
            echo "Connection OK !";
        }
    }


    // Function to check a new account form
    //--------------------------------------------------------------------------------
    function CheckNewAccountForm(){
        global $conn;

        $creationAttempted = false;
        $creationSuccessful = false;
        $error = NULL;

        //Données reçues via formulaire?

        if ( isset($_POST['sign_up'])){

            echo "creation account attempted";
            $creationAttempted = true;

            $mail = $_POST["mail"];
            $pseudo = $_POST["pseudo"];
            $name = $_POST["name"];
            $firstname = $_POST["firstname"];

            if(!empty($mail) && !empty($pseudo) && !empty($name) && !empty($firstname)){

                //Form is only valid if password == confirm, and username is at least 4 char long
                if ( strlen($_POST["name"]) < 4 ){
                    $error = "Un nom utilisateur doit avoir une longueur d'au moins 4 lettres";
                }
                elseif ( $_POST["password"] != $_POST["confirm"] ){
                    $error = "Le mot de passe et sa confirmation sont différents";
                }
                else {
                    //$username = SecurizeString_ForSQL($_POST["name"]);
                    $password = md5($_POST["password"]);

                    $query = "INSERT INTO `users`(`id`, `pseudo`, `email`, `password`) VALUES (NULL, '$pseudo', '$mail', '$password')";
                    echo $query."<br>";
                    $result = $conn->query($query);

                    if( mysqli_affected_rows($conn) == 0 )
                    {
                        $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
                    }
                    else{
                        $creationSuccessful = true;
                    }
                    
                }
            }

        return array($creationAttempted, $creationSuccessful, $error);
        }
    }
?>

