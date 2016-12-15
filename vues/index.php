<h2>Accueil</h2>

<?php
if ($MEMBRE) {
    echo '<p>Vous êtes connecté ' . $_SESSION['userLogin'] . '</p>';
}
