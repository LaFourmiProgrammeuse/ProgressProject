<?php

    header("Content-Type: text/plain");

    if(isset($_POST['nickname'])){

        $nickname = $_POST['nickname'];

        try{

            $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

        }
        catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }

        $qprepare = $bdd->prepare("SELECT username FROM users WHERE username=?");
        $qprepare->execute(array($nickname));

        if(!$qprepare->fetch(PDO::FETCH_NUM)){

            //La requete mysql n'a rien renvoyer, l'identifiant n'est donc pas utiliser
            echo "false";
        }
        else{

            //La requete mysql a renvoyer l'identifiant, L'identifiant est donc deja utiliser
            echo "true";
        }
    }
    else{
        echo "Error";
    }

 ?>
