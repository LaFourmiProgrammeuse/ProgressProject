<?php

require '../../php_for_all/session_control.php';
include '../../php_for_all/log_function.php';

$username = $_POST["nickname"];
$password = $_POST["pass"];

if(isset($_POST["stay_connected"])){

    $stay_connected = $_POST["stay_connected"];

    if($stay_connected == "on"){

        try{
            //On initialise une connexion avec la bdd
            $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

        }catch(Exception $e){

            //die('Erreur : ' . $e);

        }

        $qprepare = $bdd->prepare("UPDATE users SET stay_connected=? WHERE username=?");

        if(!$qprepare->execute(array("1", $username))){
           log("Error : Echec de la requete mysql pour set stay connected a true");
        }

    }
    $_SESSION['stay_connected'] = $stay_connected;

}


if(isset($_COOKIE['username']) AND isset($_COOKIE['password'])){

    setcookie('username',  $username, time() + 365*24*3600, "/www/");
    setcookie('password',  $password, time() + 365*24*3600, "/www/");

    echo 'Tout les cookies existent';
}
else{

    setcookie('username',  $username, time() + 365*24*3600, "/www/");
    setcookie('password',  $password, time() + 365*24*3600, "/www/");

    echo 'Un ou plusieurs cookie(s) n\'existent pas !';
}

log($username . "has been successfully connected !");


$_SESSION['connected'] = 'true';
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

$_SESSION['animation_connection'] = 'true';

header('Location: ../../home/home.php');

?>
