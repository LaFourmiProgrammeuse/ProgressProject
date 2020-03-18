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


    if($_GET['redirection_path'] != ""){
        header(('Location: ' . str_replace("and", "&", strip_tags($_GET['redirection_path']))));
    }
    else{
        header('Location: /home.php');
    }
 ?>
