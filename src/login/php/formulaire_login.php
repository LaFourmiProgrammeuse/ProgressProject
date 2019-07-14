<?php

require '/home/programmpk/www/src/php_for_all/session_control.php';
require '/home/programmpk/www/src/php_for_all/log_function.php';

$file_log_path = "/home/programmpk/www/src/log_server.txt";

$username = $_POST["nickname"];
$password = $_POST["pass"];

if($username != "" || $password != ""){

    /*if($username == "")){
    log_server("Erreur : pas d'indentifiant lors de la connexion", $file_log_path);
    exit(0);
}*/

try{
    //On initialise une connexion avec la bdd
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

}catch(Exception $e){

    //die('Erreur : ' . $e);

}

if(isset($_POST["stay_connected"])){

    $stay_connected = $_POST["stay_connected"];

    if($stay_connected == "on"){

        $qprepare = $bdd->prepare("UPDATE users SET stay_connected=? WHERE username=?");

        if(!$qprepare->execute(array("1", $username))){
            log_server("Error : Echec de la requete mysql pour set stay connected a true", $file_log_path);
        }

    }
    $_SESSION['stay_connected'] = $stay_connected;

}

$user_ip = GetIp();
$qprepared_2 = $bdd->prepare("UPDATE users SET last_ip_used=? WHERE username=?");
$qprepared_2->execute(array($user_ip, $username));


if(isset($_COOKIE['username']) AND isset($_COOKIE['password'])){

    setcookie('username',  $username, time() + 365*24*3600, "/");
    setcookie('password',  $password, time() + 365*24*3600, "/");

    echo 'Tout les cookies existent';
}
else{

    setcookie('username',  $username, time() + 365*24*3600, "/");
    setcookie('password',  $password, time() + 365*24*3600, "/");

    echo 'Un ou plusieurs cookie(s) n\'existent pas !';
}

log_server($username . " has been successfully connected !", $file_log_path);


$_SESSION['connected'] = 'true';
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

$_SESSION['animation_connection'] = 'true';

if($_SESSION["redirection_path_after_connection"] != ""){
    header('Location: '. $_SESSION["redirection_path_after_connection"]);
}
else{
    header('Location: /home.php');
}


}

?>
