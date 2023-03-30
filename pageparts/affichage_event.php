



<?php   

function CardEvent($row){
    echo "<div class='event'>";
    echo "<h3>".$row['titre']."</h3>";
    echo "<p>".$row['description']."</p>";
    echo "<p>".$row['date']."</p>";
    echo "<p>".$row['heure']."</p>";
    echo "<p>".$row['lieu']."</p>";
    echo "</div>";
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