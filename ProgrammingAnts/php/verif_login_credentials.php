<?php

    header("Content-type: text/plain");

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        try{
            $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
        }
        catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }

        $qprepare = $bdd->prepare("SELECT username FROM users WHERE username=? && password=?");
        $qprepare->execute(array($username, $password));

        if(!$qprepare->fetch(PDO::FETCH_NUM)){

            //La requete mysql n'a rien renvoyer
            echo "false";
        }
        else{

            //La requete mysql a renvoyer l'identifiant
            echo "true";
        }
    }
    else{
        echo "Error";
    }

?>
