<?php

require '/home/programmpk/www/src/php_for_all/session_control.php';
require '/home/programmpk/www/src/php_for_all/log_function.php';

$file_log_path = "../../log_server.txt";

$username = strip_tags($_POST['nickname']);
$password = strip_tags($_POST['pass']);
$email = strip_tags($_POST['email']);

if($username == "" || $password == "" || $email == "")
    return;

$pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);;

setcookie('username',  $username, time() + 365*24*3600, "/");
setcookie('password', $pwd_hashed, time() + 365*24*3600, "/");

    try{

        /* PART BDD REGISTRATION */

        $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }
    catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
        log_server("Error : Echec de la connection a la base de donnée (formulaire_register.php)", $file_log_path);
    }

    $registered_date = date("Y-m-d");
    $user_ip = GetIp();

    $qprepare = $db->prepare('INSERT INTO users (username, password, mail, stay_connected, registered_date, profile_image_name, last_ip_used) VALUES (:username, :password, :mail, :stay_connected, :registered_date, :profile_image_name, :user_ip)');

    if($qprepare->execute(array('username' => $username, 'password' => $pwd_hashed, 'mail' => $email, 'stay_connected' => '1', 'registered_date' => $registered_date, 'profile_image_name' => 'Default_profile_image.png', 'user_ip' => $user_ip))){
        echo "Requête mysql avec succès !";
        log_server($username . " enregistré avec succès !", $file_log_path);
    }else{
        echo "Echec de la requête mysql !";
        log_server("Error : Echec de la requete mysql d'inscription Identifiant : " . $username . ", Mdp : " . $password . ", Mail : " . $email . ", Registered_Date : " . $registered_date . ", Ip user : " . $user_ip . "(formulaire_register.php)", $file_log_path);
    }

    //On incrémente le nombre d'inscrit dans la bdd
    $qprepare = $db->prepare("UPDATE divers SET n_user_registered=n_user_registered+1");
    $qprepare->execute();

    $_SESSION['connected'] = 'true';
    $_SESSION['username'] = $username;


    //On envoie le mail aux devs

    $boundary = "-----=".md5(rand());

    $topic = "A new person has joined ProgrammingAnts !";

    $header = "From: \"ProgrammingAnts\"<site.devnews@programming-ants.ovh>\n";
    $header .= "Reply-to: \"ProgrammingAnts\"<site.devnews@programming-ants.ovh>\n";
    $header .= "MIME-Version: 1.0\n";
    $header .= "Content-Type: multipart/alternative;\n boundary=\"$boundary\"\n";

    $message_body = "\n--" . $boundary . "\n";

    $message_body .= "Content-Type: text/plain; charset=\"ISO-8859-1\"\n";
    $message_body .= "Content-Transfer-Encoding: 8bit\n";
    $message_body .= "\nA user has just registered ! :\n";
    $message_body .= "   *Username: " . $username . "\n";
    $message_body .= "   *Mail: " . $email . "\n";

    $message_body .= "\n--" . $boundary . "--\n";

    mail("site.devnews@programming-ants.ovh", $topic, $message_body, $header);


    if($_SESSION["redirection_path_after_connection"] != ""){
        header('Location: '. $_SESSION["redirection_path_after_connection"]);
    }
    else{
        header('Location: /home.php');
    }

?>
