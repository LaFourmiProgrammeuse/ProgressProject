<?php

$redirection_path_to_this_page = base64("/contact.php?onglet=bug_report");

//Ne pas mettre de code html avant cette ligne !
require '/home/programmpk/www/src/php_for_all/session_control.php';

if($_SESSION["connected"] == "false"){
    header("Location: /src/login/login_page.php?redirection_path=" . $redirection_path_to_this_page);
    exit();
}

if($_POST["topic"] == "" || $_POST["type"] == "" || $_POST["description"] == ""){
    return;
}

$topic = strip_tags($_POST["topic"]);
$type_string = strip_tags($_POST["type"]);
$description = strip_tags($_POST["description"]);

$author = $_SESSION["username"];

if($type_string == "Functioning bug"){
    $type = 1;
}
else if($type_string == "Graphical bug"){
    $type = 2;
}

try{
    //On initialise une connexion avec la bdd
    $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

}catch(Exception $e){
    die('Erreur : ' . $e);

}

$qprepare = $db->prepare("INSERT INTO bug_report (topic, type, description, author) VALUES (?, ?, ?, ?)");
$qprepare->execute(array($topic, $type, $description, $author));

header("Location: /home.php");

?>
