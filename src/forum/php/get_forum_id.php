<?php

header("Content-Type: plain/text");

try{
            $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
        }
        catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }

if(!isset($_POST['forum_name'])){
	echo "Error";
	exit;
}

$forum_name = $_POST['forum_name'];

$qprepare = $bdd->prepare("SELECT id FROM forums WHERE name=?");
$qprepare->execute(array($forum_name));

$qrep = $qprepare->fetch();
echo $qrep[0];

?>
