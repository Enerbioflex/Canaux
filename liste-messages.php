<?php

define('DROIT_ACCES', 'membre');
require('./lib/top.php');
require './modeles/liste-messages.php';

if (formulaireValide('destinataire', 'message')) {
    $user = getUser($_POST['destinataire']);

    if (!$user)
        $_SESSION['msgErreur'] = 'Destinataire inconnu';
    else {
        envoyerMessage($_POST['destinataire'], $_POST['message']);
        $_SESSION['msgSucces'] = 'Message envoyé';
    }
}

$discussions = getDiscussions($_SESSION['userId']);
$users = getUsers($_SESSION['userId']);

securiserTab($discussions);
securiserTab($users);

define('TITRE', 'Liste des messages');
require('./lib/affichage.php');
