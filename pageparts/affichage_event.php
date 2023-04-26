



<?php   

function CardEvent($row){
    ?>
    <form action="./evenement.php" method="get">
        <button type="submit" class="card-event">

            <input type="hidden" name="id_event" value="<?php echo $row['id_evenement']?>">
            
            <div class="event-infos">

                <?php 
                    $image = $row['image'];
                    if($image != ""){
                        ?>
                            <img src="<?php echo $image; ?>" width="180px" height="100px" alt="Image de l'événement">
                            <h3><?php echo $row['titre']; ?></h3>
                        <?php
                    }
                    else{
                        ?>
                            <h3><?php echo $row['titre']; ?></h3>
                            <p class="description"><?php echo $row['description']; ?></p>
                        <?php
                    }
                ?>
                
                <p><?php echo $row['date']; ?></p>
                <p><?php echo $row['heure']; ?></p>
                <p><?php echo $row['lieu']; ?></p>
            </div>

        </button>
    </form>
    <?php
}




function InscriptionButton($row){
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_event" value="<?php echo $row['id_evenement']; ?>">
        <button type="submit" name="inscription_event" id="inscription_event"> S'inscrire</button>
    </form>

    <?php
}

function DesinscriptionButton($row){
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_event" value="<?php echo $row['id_evenement']; ?>">
        <button type="submit" name="desinscription_event" id="desinscription_event"> Se désinscrire</button>
    </form>

    <?php
}


function ForumBox($row_event){

    global $conn, $userID;

    ?>
    
    <div id="messages-content-forum" class="messages-content"></div>

    <form id="message-form" enctype="multipart/form-data" class="message-form">

        <input type="hidden" id="id_evenement_forum" name="id_evenement_forum" value="<?php echo $row_event['id_evenement']; ?>">
        
        <label class="custom-file-upload">
            <input type="file" id="img" name="picture" accept="image/png, image/jpeg">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
        </label>

        <textarea  id="msg" name="message" placeholder="Message" required></textarea>
        
        <button type="button" id="send_message">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
        </button>

    </form>

    <div id="debug"></div>

    <?php
}


function ModifyEventForm($row){

    global $conn, $userID;

    

    // $query = "SELECT * FROM categorie WHERE id_categorie = '$row[id_categorie]'";
    // $result = $conn->query($query);
    // $categorie = $result->fetch_assoc()['categorie'];

    $id_event = $row['id_evenement'];
    $id_createur = $row['id_createur'];

    $titre = $row['titre'];
    $description = $row['description'];
    
    $date = $row['date'];
    $heure = $row['heure'];
    $lieu = $row['lieu'];
    
    ?>
    <div class="form-on-top">
        
        
        <form action="" method="POST" class="formulaire" enctype="multipart/form-data">

            <button id="exit-button" class="exit-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px">
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
            </button>

            <h2>Modifier événements</h2>

            <input type="hidden" name="id_event" value="<?php echo $id_event; ?>">
            <input type="hidden" name="id_createur" value="<?php echo $id_createur; ?>">

            <input type="text" name="titre"  placeholder="Titre" value="<?php echo $titre; ?>">

            <!-- <input type="text" name="description"  placeholder="Description" value="<?php echo $description; ?>"> -->

            <textarea name="description" placeholder="Description" ><?php echo $description; ?></textarea>

            <!-- <select name="categorie"  id="categorie">
            <?php 
            //    ShowCategories();
            ?>
            </select> -->
            <label >Image :</label>
            <input type="file" name="avatar">

            <input type="date" name="date" placeholder="Date" value="<?php echo $date; ?>">

            <input type="time" name="heure" placeholder="Heure" value="<?php echo $heure; ?>">

            <input type="text" name="lieu" placeholder="Lieu" value="<?php echo $lieu; ?>">

            

            <input type="text" name="password" id="password" placeholder="Mot de passe" required>
            <!-- <input type="text" name="confirm" id="confirm" placeholder="Confirmer mot de passe"> -->

            <button class="submit-button" type="submit" name="update_event"> Modifier</button>
        </form>
    </div>
    <div>
        <h2>Supprimer événements</h2>
        <form action="" method="POST">
            <input type="hidden" name="id_event" value="<?php echo $id_event; ?>">
            <input type="hidden" name="id_createur" value="<?php echo $id_createur; ?>">
            <input type="text" name="password" id="password" placeholder="Mot de passe" required>
            <button type="submit" name="delete_event"> Supprimer</button>
        </form>
    </div>
    <?php
}



?>