<?php

require '../php/session_control.php';

try{

$bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', ''/*, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)*/);

}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$qprepare = $bdd->prepare("SELECT * FROM users WHEN identifiant=? && mot_de_passe=?");
$qrep = $qprepare->execute(array("d", "d"));

$username = $_POST["nickname"];
$password = $_POST["pass"];

if(isset($_COOKIE['username']) AND isset($_COOKIE['password'])){
    echo 'Tout les cookies existent';

    setcookie('username',  $username, time() + 365*24*3600, null, null, false, true);
    setcookie('password',  $password, time() + 365*24*3600, null, null, false, true);
}
else{
    echo 'Un ou plusieurs cookie(s) n\'existent pas !';

    setcookie('username',  $username, time() + 365*24*3600, null, null, false, true);
    setcookie('password',  $password, time() + 365*24*3600, null, null, false, true);
}

$_SESSION['connected'] = 'true';
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

//header('Location: ../html-php/home.php');

?>
