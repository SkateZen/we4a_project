



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


?>