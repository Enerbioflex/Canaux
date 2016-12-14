<?php

define('DROIT_ACCES', 'membre');
require('./lib/top.php');
require './modeles/discussion.php';

if (!parametreValide('id'))
    erreur404();

$discussion = getDiscussion($_GET['id']);
if (!$discussion || $discussion['user1Id'] != $_SESSION['userId'])
    erreur404();

if (formulaireValide('message') && $discussion['user2Id'])
    envoyerMessage($discussion['user2Id'], $_POST['message']);

$messages = getMessages($_GET['id']);

securiserTab($discussion);
securiserTab($messages);

if (!$discussion['user2Id'])
    $discussion['user2Login'] = 'Compte supprimé';

define('TITRE', 'Discussion avec ' . $discussion['user2Login']);
require('./lib/affichage.php');
