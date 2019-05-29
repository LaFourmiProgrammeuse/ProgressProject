<?php

include "/home/programmpk/www/src/php_for_all/log_function.php";
$file_log_server = "/home/programmpk/www/src/log_server.txt";

$folder_image_path = "/home/programmpk/www/images/user_image/";


//On verifie les informations recus
if(!isset($_POST['image_url']) || !isset($_POST['file_name']) || !isset($_POST['username'])){
    exit;
}

//On decode l'image
$image_encoded_with_h = $_POST['image_url'];
$image_encoded_without_h = explode(",", $image_encoded_with_h)[1];

$image_encoded_without_h = str_replace(' ','+',$image_encoded_without_h);
$image_decoded = base64_decode($image_encoded_without_h);

    echo "Url -> binaire : \n";
    echo $image_encoded_without_h;


try{
 //On initialise une connexion avec la bdd
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

}catch(Exception $e){
    die('Erreur : ' . $e);

}

//on supprime l'ancienne photo de profile de l'user si il en avait une
$qprepare = $bdd->prepare('SELECT profile_image_name FROM users WHERE username=:username');
$qprepare->execute(array("username" => $_POST['username']));

$qrep = $qprepare->fetch(PDO::FETCH_NUM);

echo $qrep[0];

if($qrep[0] != "" || $qrep[0] != "Default_profile_image.png"){
    unlink(($folder_image_path . $qrep[0]));
}


//on place la nouvelle image de profile dans le dossier images
if(!$file_image_uploaded = fopen(($folder_image_path.$_POST['file_name']), "w")){
    echo "Echec de la création de la nouvelle image \n";
}
else{
    echo "Creation de la nouvelle image avec succes \n";
}

fwrite($file_image_uploaded, $image_decoded);
fclose($file_image_uploaded);


echo ($folder_image_path . $_POST['file_name']);


//on entre dans la bbd le nom de la nouvelle photo de profil
$qprepare = $bdd->prepare('UPDATE users SET profile_image_name=? WHERE username=?');
$qprepare->execute(array($_POST['file_name'], $_POST['username']));

 ?>
