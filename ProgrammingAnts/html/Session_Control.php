<?php

$timeout = 30; //Temps avant destruction d'une session en seconde

//On regarde si une session existe déja
if(isset($_SESSION['timeout'])){

//On regarde si l'user a atteint le temps d'inactivité max
if($_SESSION['timeout'] + $timeout < time()){

  session_destroy();

	//On recrée la page donc on reset donc le temps a 0;
	$_SESSION['timeout'] = time();

  if(isset($_COOKIE['identifiant'])){

  }else{

    //Pas de cookie pour connaitre l'identite de l'user, on ne le connecte pas
    $_SESSION['connected'] = 'false';
  }

}else{

  //On remet le timer de la session a 0
  $_SESSION['timeout'] = time();
}

}else{

  //Pas de session
  $_SESSION['connected'] = 'false';
  $_SESSION['timeout'] = time();
}
?>
