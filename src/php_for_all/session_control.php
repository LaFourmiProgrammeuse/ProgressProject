<?php

function get_ip() {

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

$timeout = 360; //Temps avant destruction d'une session en seconde

session_start();

try{
    //On initialise une connexion avec la bdd
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

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

        //On recrée la page donc on reset donc le temps a 0;
        $_SESSION['timeout'] = time();

        if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){

            $_SESSION['username'] = $_COOKIE['username'];
            $_SESSION['password'] = $_COOKIE['password'];

            time();

            $qprepare = $bdd->prepare("SELECT stay_connected FROM users WHERE username = :username && password = :password");
            $qprepare->execute(array('username' => $_COOKIE['username'], 'password' => $_COOKIE['password']));

            if($qprepare){

                time();
                $qrep = $qprepare->fetch();

                if($qrep['stay_connected'] == '0'){

                    $_SESSION['connected'] = 'false';
                    time();

                }else if($qrep['stay_connected'] == '1'){

                    $_SESSION['connected'] = 'true';

                }
                else{

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
        $_SESSION['password'] = $_COOKIE['password'];

        $qprepare = $bdd->prepare("SELECT keep_connected, username FROM users WHERE username = :username && password = :password");
        $qprepare->execute(array('username' => $_COOKIE['username'], 'password' => $_COOKIE['password']));

        if($qprepare){

            //On met dans la bdd la derniere ip avec laquelle il vient de charger la page
            //$qprepare_2 = $bdd->prepare("UPDATE users SET");

            $qrep = $qprepare->fetch();

            if($qrep['stay_connected'] == '0'){

                $_SESSION['connected'] = 'false';

            }else if($qrep['stay_connected'] == '1'){

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
