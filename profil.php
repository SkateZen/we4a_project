<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>



<body>
    
    <!-- photo -->

    <!-- nom, prénom -->

    <!-- pseudo -->

    <?php
    include("database.php");
    connect_db();
    CheckLogin();

    if ( isset($pseudo) || isset($userID) ) {
    ?>
    <div class="IDzone">   
        <form action="./logout.php" method="POST">

            <div id="ID_name">
                <p> Bienvenue, <?php echo $username; ?> !</p>
            </div>
            <div id="ID_logout">
                <input type="hidden" value="logout" name="logout"></input>
                <button type="submit">Se déconnecter</button>
            </div>
            <div id="ID_myblog">
                <p><a href="./showBlog.php?userID=<?php echo $userID; ?>">Mon Blog Personnel</a></p>
            </div>
            <div style="clear:both"></div>
        </form>
    </div>
    <?php
    }
    ?>



</body>
</html>