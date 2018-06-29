<?php

$timeout = 7; //Temps avant destruction d'une session en seconde

session_start();

try{
    //On initialise une connexion avec la bdd
    $bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', '');

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

        if(isset($_COOKIE['identifiant']) AND isset($_COOKIE['mdp'])){

            $qprepare = $bdd->prepare("SELECT keep_connected FROM users WHERE identifiant = :identifiant && mot_de_passe = :mdp");
            $qprepare->execute(array('identifiant' => $_COOKIE['identifiant'], 'mdp' => $_COOKIE['mdp']));

            if($qprepare){
                $qrep = $qprepare->fetch();

                if($qrep['keep_connected'] == '0'){

                    $_SESSION['connected'] = 'false';

                }else if($qrep['keep_connected'] == '1'){

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

    if(isset($_COOKIE['identifiant']) AND isset($_COOKIE['mdp'])){

        $qprepare = $bdd->prepare("SELECT keep_connected FROM users WHERE identifiant = :identifiant && mot_de_passe = :mdp");
        $qprepare->execute(array('identifiant' => $_COOKIE['identifiant'], 'mdp' => $_COOKIE['mdp']));

        if($qprepare){
            $qrep = $qprepare->fetch();

            if($qrep['keep_connected'] == '0'){

                $_SESSION['connected'] = 'false';

            }else if($qrep['keep_connected'] == '1'){

                $_SESSION['connected'] = 'true';

            }else{
                $_SESSION['connected'] = 'false';
            }

        }else{
            die('Echec de la requete');
        }

        if($_COOKIE['keep_connected'] == 'true'){

            //On verifie dans la bdd les informations de connexion de l'user
            $_SESSION['connected'] = 'true';

        }else{

            //L'user ne souhaite pas a etre reconnecter automatiquement selon la bdd
            $_SESSION['connected'] = 'false';
        }

    }else{

        //Pas de cookie pour connaitre l'identite de l'user, on ne le connecte pas
        $_SESSION['connected'] = 'false';
    }
}

?>
