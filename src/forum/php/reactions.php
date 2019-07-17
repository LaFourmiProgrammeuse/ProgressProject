<?php

header("Content-Type: plain/text");

echo "text_like";

try{
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$author = $_POST['author'];
$object_type = $_POST['object_type'];
$action_type = $_POST['action_type'];

/*echo $object_type;
echo $action_type;*/


if($object_type == "post"){

    //On récupère l'id du post à partir de son index
    $post_index = $_POST["post_index"];

    $qprepare = $bdd->prepare("SELECT");

    if($action_type == "like"){
        echo "like";
    }
    else if($action_type == "dislike"){

    }
}


?>
