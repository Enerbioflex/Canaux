<?php
if ($MEMBRE) {
    echo '<p>T\'es connecté ' . $_SESSION['userLogin'] . '</p>';
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
}
