<?php

function GetIp() {

    // IP si internet partagé
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    // IP derrière un proxy
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Sinon : IP normale
    else {
        return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
    }
}

function IncrementVisitorCounter(){

    try{
        //On initialise une connexion avec la db
        $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){

        die('Erreur : ' . $e);

    }

    $qprepared = $db->prepare("SELECT n_page_loaded FROM divers");
    $qprepared->execute();

    $qanswer = $qprepared->fetch();
    $n_visitor = $qanswer[0];

    //On incrémente de 1 car un utilisateur vient de charger la page
    $n_visitor++;

    $qprepared_2 = $db->prepare("UPDATE divers SET n_page_loaded=?");
    $qprepared_2->execute(array($n_visitor));


}

$timeout = 5; //Temps avant destruction d'une session en seconde

session_start();

try{
    //On initialise une connexion avec la db
    $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

}catch(Exception $e){

    die('Erreur : ' . $e);

}

//On regarde si une session existe déja
if(isset($_SESSION['timeout'])){

    //On regarde si l'user a atteint le temps d'inactivité max
    if($_SESSION['timeout'] + $timeout < time()){

        //On detruit la session pour inactivité
        session_destroy();

        //On la reconstruit
        session_start();

        //On recrée la page donc on reset donc le temps à 0;
        $_SESSION['timeout'] = time();

        if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){

            $_SESSION['username'] = $_COOKIE['username'];

            $qprepared = $db->prepare("SELECT stay_connected, password FROM users WHERE username = :username");
            $qprepared->execute(array('username' => $_COOKIE['username']));

            if($qprepared){

                $qrep = $qprepared->fetch();

                if($qrep['stay_connected'] == '1' && password_verify($_COOKIE['password'], $qrep["password"])){
                    $_SESSION['connected'] = 'true';
                }else{
                    $_SESSION['connected'] = 'false';
                }

            }else{
                die('Echec de la requete');
            }


        }else{

            //Pas de cookie pour connaitre l'identite de l'user, on ne le connecte pas
            $_SESSION['connected'] = 'false';
        }

    }else{

        //On remet le timer de la session a 0
        $_SESSION['timeout'] = time();
    }

}else{

    //Pas de session, On la crée, on regarde si l'on doit connecter l'user

    $_SESSION['timeout'] = time();

    if(isset($_COOKIE['username']) AND isset($_COOKIE['password'])){

        $_SESSION['username'] = $_COOKIE['username'];

        $qprepared = $db->prepare("SELECT stay_connected, username, password FROM users WHERE username = :username");
        $qprepared->execute(array('username' => $_COOKIE['username']));

        if($qprepared){

            $qrep = $qprepared->fetch();

            if($qrep['stay_connected'] == '1' && password_verify($_COOKIE['password'], $qrep["password"])){
                $_SESSION['connected'] = 'true';
            }else{
                $_SESSION['connected'] = 'false';
            }

        }else{
            die('Echec de la requete');
        }

    }else{

        //Pas de cookie pour connaitre l'identite de l'user, on ne le connecte pas
        $_SESSION['connected'] = 'false';
    }
}

?>
