<?php

$secret = "6LdPWrQUAAAAAD99lGoI8jH9o9XdFp9fSQFRmWRD";

header("Content-Type: text/plain");

if(!isset($_POST["token"])){
    echo "Error";
    return;
}

$token = $_POST["token"];

//On envoie une requete pour vérifier la validité du captcha auprès de google
$url = "https://www.google.com/recaptcha/api/siteverify";
$timeout = 10;

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('secret' => $secret, 'response' => $token));

$google_answer = curl_exec($ch);

curl_close($ch);

//echo $google_answer;

//On traite les données renvoyé par google
$answer_arr = json_decode($google_answer);
foreach($answer_arr as $key => $value){

    //Si l'utilisateur et un humain on affiche l'email
    if($key == "success" && $value == "1"){
        echo "contact@programming-ants.ovh";
    }
    else if($key == "success" && $value == "0"){
        echo "BadCaptcha";
        return;
    }
}


    /* Réponse HTML */

?>
