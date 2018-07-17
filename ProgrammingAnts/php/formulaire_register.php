<?php

require '../php/session_control.php';

$username = $_POST['nickname'];
$password = $_POST['pass'];
$email = $_POST['email'];

if(isset($_COOKIE['identifiant']) && isset($_COOKIE['mdp'])){

    setcookie('username',  $username, time() + 365*24*3600, "/ProgrammingAnts/");
    setcookie('password', $password, time() + 365*24*3600, "/ProgrammingAnts/");

    echo 'Tout les cookies existent';
}
else{

    setcookie('username',  $username, time() + 365*24*3600, "/ProgrammingAnts/");
    setcookie('password',  $password, time() + 365*24*3600, "/ProgrammingAnts/");

    echo 'Un ou plusieurs cookie(s) n\'existent pas !';
}

try{

$bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', ''/*, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)*/);

}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$qprepare = $bdd->prepare('INSERT INTO users (id, username, password, mail, keep_connected) VALUES (:id, :username, :password, :mail, :keep_connected)');
$qprepare->execute(array('id' => '0', 'username' => $username, 'password' => $password, 'mail' => $email, 'keep_connected' => '1'));

$_SESSION['connected'] = 'true';
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

header('Location: ../html-php/home.php');


?>
