<?php

require '/home/programmpk/www/src/php_for_all/session_control.php';
require '/home/programmpk/www/src/php_for_all/log_function.php';

$file_log_path = "/home/programmpk/www/src/log_server.txt";

$username = strip_tags($_POST["nickname"]);
$pwd = strip_tags($_POST["pass"]);

if($username == "" || $pwd == "")
    return;

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
            log_server("Error : Echec de la requete mysql pour set stay connected à true", $file_log_path);
        }

    }
    $_SESSION['stay_connected'] = $stay_connected;

}

$user_ip = GetIp();
$qprepared_2 = $bdd->prepare("UPDATE users SET last_ip_used=? WHERE username=?");
$qprepared_2->execute(array($user_ip, $username));

$pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);

setcookie('username',  $username, time() + 365*24*3600, "/");
setcookie('password',  $pwd_hashed, time() + 365*24*3600, "/");


log_server($username . " has been successfully connected !", $file_log_path);


$_SESSION['connected'] = 'true';
$_SESSION['username'] = $username;

$_SESSION['animation_connection'] = 'true';

if($_SESSION["redirection_path_after_connection"] != ""){
    header('Location: '. $_SESSION["redirection_path_after_connection"]);
}
else{
    header('Location: /home.php');
}


?>
