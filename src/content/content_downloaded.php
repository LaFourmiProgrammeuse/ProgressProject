<?php

    $name = $_POST["name"];
    $extension = $_POST["extension"];
    $w_resolution = $_POST['w_resolution'];
    $h_resolution = $_POST['h_resolution'];

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    $query = $bdd->prepare("UPDATE contents SET n_download=n_download+1 WHERE name=? && extension=? && w_resolution=? && h_resolution=?");
    $query->execute(array($name, $extension, $w_resolution, $h_resolution));
?>
