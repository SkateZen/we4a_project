<?php   


function CardAmi($row){

    $id_ami = $row['id_utilisateur'];

    $name = $row['nom'];
    $firstname = $row['prenom'];
    $pseudo = $row['pseudo'];
    $avatar = $row['photo_profil'];

    ?>
    <form action="./profil.php" method="get">
        <button type="submit" class="row-user">

            <input type="hidden" name="pseudo" value="<?php echo $pseudo?>">

            
            <img src="<?php echo $avatar; ?>" width="55px" height="55px" alt="avatar">
            
            <div class="infos-user">
                <h3> <?php echo $pseudo; ?></h3>

                <p> <?php echo $firstname." ".$name; ?></p>
            </div>

        </button>
    </form>
    <?php
}

function CardAmiContact($row){

    $id_ami = $row['id_utilisateur'];

    $name = $row['nom'];
    $firstname = $row['prenom'];
    $pseudo = $row['pseudo'];
    $avatar = $row['photo_profil'];

    ?>
    <form action="./messagerie.php" method="post">
        <button type="submit" class="row-user">

            <!-- <input type="hidden" name="pseudo" value="<?php echo $pseudo?>"> -->
            <input type="hidden" id="pseudo_ami" name="pseudo_ami" value="<?php echo $row['pseudo']; ?>">

            
            <img src="<?php echo $avatar; ?>" width="55px" height="55px" alt="avatar">
            
            <div class="infos-user">
                <h3> <?php echo $pseudo; ?></h3>

                <p> <?php echo $firstname." ".$name; ?></p>
            </div>

        </button>
    </form>
    <?php
}


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
        <input type="hidden" id="pseudo_ami" name="pseudo_ami" value="<?php echo $row['pseudo']; ?>">
        <button type="submit" name="contact_ami" id="contact_ami"> Contacter</button>
    </form>

    <?php
}



function AcceptAmiButton($row){
    ?>
    <form action=""  method="post">
        <input type="hidden" name="id_ami" value="<?php echo $row['id_utilisateur']; ?>">
        <button type="submit" class="accept-amis" name="accept_ami" id="accept_ami">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="30px" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>

        </button>
    </form>

    <?php
}

function SelectConversation($row){

    // $id_ami = $row['id_utilisateur'];

    $name = $row['nom'];
    $firstname = $row['prenom'];
    $pseudo = $row['pseudo'];
    $avatar = $row['photo_profil'];

    
    ?>
    
    <form action="" method="post">

        <input type="hidden" id="pseudo_ami" name="pseudo_ami" value="<?php echo $row['pseudo']; ?>">

        <button type="submit" name="select_conversation" id="select-conversation" class="row-user"> 
            <input type="hidden" name="pseudo" value="<?php echo $pseudo?>">

            
            <img src="<?php echo $avatar; ?>" width="55px" height="55px" alt="avatar">
            
            <div class="infos-user">
                <h3> <?php echo $pseudo; ?></h3>

                <p> <?php echo $firstname." ".$name; ?></p>
            </div>
        </button>
    </form>

    <?php
}


function ChatBox($row){

    global $conn, $userID;

    $id_ami = $row['id_utilisateur'];

    $name = $row['nom'];
    $firstname = $row['prenom'];
    $pseudo = $row['pseudo'];
    $avatar = $row['photo_profil'];
    ?>

    <form action="./profil.php" method="get" class="interlocuteur">
        <button type="submit" class="row-user">

            <input type="hidden" name="pseudo" value="<?php echo $pseudo?>">

            
            <img src="<?php echo $avatar; ?>" width="70px" height="70px" alt="avatar">
            
            <div class="infos-user">
                <h1> <?php echo $pseudo; ?></h1>
            </div>

        </button>
    </form>
    


    <!-- <h3><?php echo $row['pseudo']; ?></h3> -->

    <!-- <input type="hidden" id="pseudo_ami_ajax" name="pseudo_ami_ajax" value="<?php echo $row['pseudo']; ?>"> -->
    <div id="messages-content" class="messages-content"></div>

    <form id="message-form" enctype="multipart/form-data" class="message-form">

        <input type="hidden" id="pseudo_ami_ajax" name="pseudo_ami_ajax" value="<?php echo $row['pseudo']; ?>">
        

        <label class="custom-file-upload">
            <input type="file" id="img" name="picture" accept="image/png, image/jpeg">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 60.7 28.7 32 64 32H448c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6h96 32H424c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
        </label>

        
        

        <textarea  id="msg" name="message" placeholder="Message" required></textarea>

        
        
        <button type="button" id="send_message">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
        </button>
        
        

    </form>

    <!-- <div id="debug"></div> -->

    <?php
}

?>