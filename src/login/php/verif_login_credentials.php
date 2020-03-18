<?php

    header("Content-type: text/plain");

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        try{
            $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
        }
        catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }

        $qprepare = $bdd->prepare("SELECT username FROM users WHERE username=? && password=?");
        $qprepare->execute(array($username, $password));

        if(!$qrep = $qprepare->fetch(PDO::FETCH_NUM)){

            //La requete mysql n'a rien renvoyer
            echo "false";
        }
        else{

            //La requete mysql a renvoyer l'identifiant
            if($qrep[0] == $username){
                echo "true";
            }
            else{
                echo "false";
            }
        }
    }
    else{
        echo "Error";
    }

?>
