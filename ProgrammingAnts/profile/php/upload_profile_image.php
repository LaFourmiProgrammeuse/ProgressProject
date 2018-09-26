<?php

require "../../php_for_all/log_function.php";
$file_log_server = "../../log_server.txt";

$folder_image_path = "../../images/user_image/";

if(!isset($_POST['image_url'])){
    exit;
}

$image_encoded_with_h = $_POST['image_url'];
$image_encoded_without_h = explode(",", $image_encoded_with_h)[1];

$image_encoded_without_h = urldecode($image_encoded_without_h);
$image_decoded = base64_decode($image_encoded_without_h);

header("Content-Type: text/plain");

    echo "Url -> binaire : \n";
    echo $image_encoded_without_h;

if(!$file_image_uploaded = fopen(("../../images/user_image/test.png"), "w")){
    //echo "Echec de la création de la nouvele image";
}
else{
    //echo "Creation de la nouvelle image avec succes";
}

fwrite($file_image_uploaded, $image_decoded);

fclose($file_image_uploaded);

echo "nice";

    try{
     //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }



 ?>
