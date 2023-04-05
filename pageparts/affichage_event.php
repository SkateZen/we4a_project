



<?php   

function CardEvent($row){
    ?>
    clickable card
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



?>