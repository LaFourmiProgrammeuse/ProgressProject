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

        $qprepare = $bdd->prepare("SELECT password FROM users WHERE username=?");
        $qprepare->execute(array($username));

        $qrep = $qprepare->fetch(PDO::FETCH_ASSOC);

        $hash = $qrep["password"];
        if(password_verify($password, $hash)){
            echo "true";
        }
        else{
            echo "false";
        }

    }
    else{
        echo "Error";
    }

?>
