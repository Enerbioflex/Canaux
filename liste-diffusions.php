<?php

define('DROIT_ACCES', 'membre');
require('./lib/top.php');
require './modeles/liste-diffusions.php';

if (formulaireValide('titre', 'jour', 'mois', 'an', 'heure', 'min', 'lien')) {
    $aujourdhui = new DateTime('now');
    $dateStr = $_POST['an'] . '-' . $_POST['mois'] . '-' . $_POST['jour'] . ' ' . $_POST['heure'] . ':' . $_POST['min'] . ':00';
    $date = new DateTime($dateStr);
    $lien = explode('/', $_POST['lien']);


    if (strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 100)
        $_SESSION['msgErreur'] = 'Le titre doit contenir entre 2 et 100 caractères';
    elseif (!isset($lien['4']) || @!file_get_contents("https://api.dailymotion.com/video/" . $lien['4'])) {
        $_SESSION['msgErreur'] = 'Le lien est invalide';
    }
    elseif ($date < $aujourdhui)
        $_SESSION['msgErreur'] = 'Vous ne pouvez pas diffuser dans le passé';
    else
        ajouterDiffusion($_POST['titre'], $lien['4'], $dateStr);
}

if (parametreValide('supprId') && $MODO) {
    $diffusion = getDiffusion($_GET['supprId']);
    if (!$diffusion)
        $_SESSION['msgErreur'] = 'Évitez de traffiquer l\'url svp';
    else {
        supprimerDiffusion($_GET['supprId']);
        header('Location: ./liste-diffusions.php');
    }
}

$diffusions = getDiffusions();
securiserTab($diffusions);

define('TITRE', 'Liste des diffusions');
require('./lib/affichage.php');
