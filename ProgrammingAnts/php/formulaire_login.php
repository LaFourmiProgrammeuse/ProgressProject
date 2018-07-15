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

$nickname = $_POST["nickname"];
$pass = $_POST["pass"];

if(isset($_COOKIE['identifiant']) AND isset($_COOKIE['mdp'])){
    echo 'Tout les cookies existent';

    setcookie('identifiant',  $nickname, time() + 365*24*3600, null, null, false, true);
    setcookie('mdp',  $pass, time() + 365*24*3600, null, null, false, true);
}
else{
    echo 'Un ou plusieurs cookie(s) n\'existent pas !';

    setcookie('identifiant',  $nickname, time() + 365*24*3600, null, null, false, true);
    setcookie('mdp',  $pass, time() + 365*24*3600, null, null, false, true);
}

$_SESSION['connected'] = 'true';
$_SESSION['identifiant'] = $nickname;
$_SESSION['mdp'] = $pass;

header('Location: ../html-php/home.php');

?>
