



<?php   

function CardEvent($row){
    ?>
    <form action="./evenement.php" method="get">
        <button type="submit">

            <input type="hidden" name="id_event" value="<?php echo $row['id_evenement']?>">

            
            <div class="event">
                <h3><?php echo $row['titre']; ?></h3>
                <p><?php echo $row['description']; ?></p>
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
    
    <!-- <input type="hidden" id="pseudo_ami_ajax" name="pseudo_ami_ajax" value="<?php echo $row['pseudo']; ?>"> -->
    <div id="messages-content-forum"></div>

    <form id="message-form" enctype="multipart/form-data">

        <input type="hidden" id="id_evenement_forum" name="id_evenement_forum" value="<?php echo $row_event['id_evenement']; ?>">
        
        <input type="file" id="img" name="picture" accept="image/png, image/jpeg"><br>

        <textarea  id="msg" name="message" placeholder="Message" required></textarea>

        <button type="button" id="send_message">Send</button>

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
    <div>
        <h2>Modifier événements</h2>
        
        <form action="" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id_event" value="<?php echo $id_event; ?>">
            <input type="hidden" name="id_createur" value="<?php echo $id_createur; ?>">

            <input type="text" name="titre"  placeholder="Titre" value="<?php echo $titre; ?>">

            <!-- <input type="text" name="description"  placeholder="Description" value="<?php echo $description; ?>"> -->

            <textarea name="description" placeholder="Description" ><?php echo $description; ?></textarea>

            <select name="categorie"  id="categorie">
            <?php 
                ShowCategories();
            ?>
            </select>

            <input type="date" name="date" placeholder="Date" value="<?php echo $date; ?>">

            <input type="time" name="heure" placeholder="Heure" value="<?php echo $heure; ?>">

            <input type="text" name="lieu" placeholder="Lieu" value="<?php echo $lieu; ?>">

            <!-- <label >Avatar :</label>
            <input type="file" name="avatar"> -->

            <input type="text" name="password" id="password" placeholder="Mot de passe" required>
            <!-- <input type="text" name="confirm" id="confirm" placeholder="Confirmer mot de passe"> -->

            <button type="submit" name="update_event"> Modifier</button>
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