<?php

    $name = strip_tags($_POST["name"]);
    $extension = strip_tags($_POST["extension"]);
    $w_resolution = strip_tags($_POST['w_resolution']);
    $h_resolution = strip_tags($_POST['h_resolution']);

    try{
        //On initialise une connexion avec la bdd
        $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    $query = $db->prepare("UPDATE contents SET n_download=n_download+1 WHERE name=? && extension=? && w_resolution=? && h_resolution=?");
    $query->execute(array($name, $extension, $w_resolution, $h_resolution));
?>
