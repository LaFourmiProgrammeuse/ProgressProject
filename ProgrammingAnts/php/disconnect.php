<?php

    session_start();

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', '');

    }catch(Exception $e){

        die('Erreur : ' . $e);

    }

    $qprepare = $bdd->prepare("UPDATE users SET stay_connected=? WHERE username=?");
    $qprepare->execute(array('0', $_SESSION['username']));

    session_destroy();

    header("Location: ../html-php/home.php");
 ?>
