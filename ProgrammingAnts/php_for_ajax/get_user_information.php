<?php
    header ("Content-Type: text/xml");

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    if(!isset($_POST['information_type']) || !isset($_POST['number_information_needed'])){
        exit;
    }

    $information_needed = unserialize($_POST['information_needed']);

    echo "<?xml version =\"1.0\" encoding=\"utf-8\"?>"
        echo "<information>"

        
            echo "<last_activity>";

            echo "</last_activity>"
        echo "</information>";
?>
