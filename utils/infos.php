<?php
function displayLogInfo($msg) {
    switch($msg)
    {
        case 'success':
        
            echo '<div class="alert alert-success">';
            echo '<p><strong>Succès :</strong> inscription réussie !</p>';
            echo '</div>';
            break;
        
        case 'fail':
    
            echo '<div class="alert alert-fail">';
            echo '<p><strong>Erreur :</strong> inscription ratée !</p>';
            echo '</div>';
            break;

    }
}

?>