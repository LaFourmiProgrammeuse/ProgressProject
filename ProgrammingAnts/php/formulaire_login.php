<?php

require '../php/session_control.php';

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

$_SESSION['connection_from_register'] = 'false';

header('Location: ../html-php/home.php');

?>
