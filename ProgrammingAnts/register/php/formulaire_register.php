<?php

require '../../php_for_all/session_control.php';
require '../../php_for_all/log_function.php';

$file_log_path = "../../log_server.txt";

$username = $_POST['nickname'];
$password = $_POST['pass'];
$email = $_POST['email'];

if(isset($_COOKIE['identifiant']) && isset($_COOKIE['mdp'])){

    setcookie('username',  $username, time() + 365*24*3600, "/");
    setcookie('password', $password, time() + 365*24*3600, "/");

    echo 'Tout les cookies existent';
}
else{

    setcookie('username',  $username, time() + 365*24*3600, "/");
    setcookie('password',  $password, time() + 365*24*3600, "/");

    echo 'Un ou plusieurs cookie(s) n\'existent pas !';
}

try{

$bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
    log_server("Error : Echec de la connection a la base de donnée (formulaire_register.php)", $file_log_path);
}

$qprepare = $bdd->prepare('INSERT INTO users (id, username, password, mail, stay_connected) VALUES (:id, :username, :password, :mail, :stay_connected)');

if($qprepare->execute(array('id' => '0', 'username' => $username, 'password' => $password, 'mail' => $email, 'stay_connected' => '1'))){
    echo "Requête mysql avec succès !";
    log_server($username . " enregistré avec succès !", $file_log_path);
}else{
    echo "Echec de la requête mysql !";
    log_server("Error : Echec de la requete mysql d'inscription Identifiant : " . $username . ", Mdp : " . $password . ", Mail : " . $email . " (formulaire_register.php)", $file_log_path);
}

$_SESSION['connected'] = 'true';
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

header('Location: ../../home/home.php');


?>
