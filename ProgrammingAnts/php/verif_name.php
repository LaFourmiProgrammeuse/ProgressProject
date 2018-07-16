<?php

    header("Conntent-Type: text/plain");

    if(isset($_POST['nickname'])){

        $nickname = $_POST['nickname'];

        try{

        $bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', ''/*, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)*/);

        }
        catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }

        $qprepare = $bdd->prepare("SELECT identifiant FROM users WHERE identifiant=?");
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
