<?php

    session_start();

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    $qprepare = $bdd->prepare("UPDATE users SET stay_connected=? WHERE username=?");
    $qprepare->execute(array('0', $_SESSION['username']));

    session_destroy();


    if($_GET['redirection_path'] != ""){
        header(('Location: ' . str_replace("and", "&", $_GET['redirection_path'])));
    }
    else{
        header('Location: /home.php');
    }
 ?>
