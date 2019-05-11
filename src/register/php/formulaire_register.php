<?php

require '/home/programmpk/www/src/php_for_all/session_control.php';
require '/home/programmpk/www/src/php_for_all/log_function.php';

$file_log_path = "../../log_server.txt";

$username = $_POST['nickname'];
$password = $_POST['pass'];
$email = $_POST['email'];

if(isset($_COOKIE['identifiant']) && isset($_COOKIE['mdp'])){

    setcookie('username',  $username, time() + 365*24*3600, "/");
    setcookie('password', $password, time() + 365*24*3600, "/");

    echo 'Tout les cookies existent';
}
else{

    setcookie('username',  $username, time() + 365*24*3600, "/");
    setcookie('password',  $password, time() + 365*24*3600, "/");

    echo 'Un ou plusieurs cookie(s) n\'existent pas !';
}

try{

    /* PART BDD REGISTRATION */

$bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
    log_server("Error : Echec de la connection a la base de donnée (formulaire_register.php)", $file_log_path);
}

$registered_date = date("Y-m-d");
$user_ip = GetIp();

$qprepare = $bdd->prepare('INSERT INTO users (id, username, password, mail, stay_connected, registered_date, profile_image_name, last_ip_used) VALUES (:id, :username, :password, :mail, :stay_connected, :registered_date, :profile_image_name, :user_ip)');

if($qprepare->execute(array('id' => '0', 'username' => $username, 'password' => $password, 'mail' => $email, 'stay_connected' => '1', 'registered_date' => $registered_date, 'profile_image_name' => 'Default_profile_image.png', 'user_ip' => $user_ip))){
    echo "Requête mysql avec succès !";
    log_server($username . " enregistré avec succès !", $file_log_path);
}else{
    echo "Echec de la requête mysql !";
    log_server("Error : Echec de la requete mysql d'inscription Identifiant : " . $username . ", Mdp : " . $password . ", Mail : " . $email . ", Registered_Date : " . $registered_date . ", Ip user : " . $user_ip . "(formulaire_register.php)", $file_log_path);
}

$_SESSION['connected'] = 'true';
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;


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


header('Location: /home.php');


?>
