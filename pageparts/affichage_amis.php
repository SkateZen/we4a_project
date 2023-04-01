

<?php   


function AjoutAmiButton($row){
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>">
        <button type="submit" name="ajout_ami" id="ajout_ami"> Ajouter</button>
    </form>

    <?php
}


function ContactAmiButton($row){
    ?>
    <form action="" method="post">
        <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>">
        <button type="submit" name="contact_ami" id="contact_ami"> Contacter</button>
    </form>

    <?php
}



function AcceptAmiButton($row){
    ?>
    <form action="" method="post">
        <!-- <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>"> -->
        <button type="submit" name="accept_ami" id="accept_ami"> Accepter</button>
    </form>

    <?php
}

?>