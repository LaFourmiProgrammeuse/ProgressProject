<?php

    session_start();

    try{
        //On initialise une connexion avec la bdd
        $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    $qprepare = $db->prepare("UPDATE users SET stay_connected=? WHERE username=?");
    $qprepare->execute(array('0', $_SESSION['username']));

    session_destroy();

    $redirection_path_b64 = strip_tags($_GET['redirection_path']);
    $redirection_path = base64_decode($redirection_path_b64);
    if($redirection_path != ""){
        header('Location: ' . $redirection_path);
    }
    else{
        header('Location: /home.php');
    }
 ?>
