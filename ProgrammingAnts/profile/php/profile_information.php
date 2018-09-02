<?php
    header ("Content-Type: test/xml");
    header ("Access-Control-Allow-Origin: *");

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){

        die('Erreur : ' . $e);

    }

    $qprepare = $bdd->prepare("SELECT * FROM users WHERE ")

    echo "<?xml version =\"1.0\" encoding=\"utf-8\"?>";
        echo "<profile_information>";
            echo "<like_received>";

            echo "</like_received>"
        echo "</profile_information>";
 ?>
