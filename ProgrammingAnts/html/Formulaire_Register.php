<?php

  session_start();

  try{

    $bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', ''/*, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)*/);

  }
  catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
  }

  $nickname = $_POST[nickname];
  $pass = $_POST[pass];
  $email = $_POST[email];

  $qprepare = $bdd->prepare('INSERT INTO users (id, identifiant, mot_de_passe, mail, keep_connected) VALUES (:id, :identifiant, :mdp, :mail, :keep_connected)');
  $qprepare->execute(array('id' => '0', 'identifiant' => $nickname, 'mdp' => $pass, 'mail' => $email, 'keep_connected' => '0'));

  echo '<br>Vous vous êtes inscrit avec ces informations : ';
  echo '<ul>';
				echo '<li>' . $nickname . '</li>';
        echo '<li>' . $pass . '</li>';
        echo '<li>' . $email . '</li>';
	echo '</ul>';
  echo '<a href="home.php">Retour</a>';

  if(isset($_COOKIE['identifiant']) AND isset($_COOKIE['mdp']) AND isset($_COOKIE['keep_connected'])){
    echo 'Tout les cookies existent';

    setcookie('identifiant',  $nickname, time() + 365*24*3600, null, null, false, true);
    setcookie('mdp',  $pass, time() + 365*24*3600, null, null, false, true);
    setcookie('keep_connected',  'false', time() + 365*24*3600, null, null, false, true);
  }
  else{
    echo 'Un ou plusieurs cookie(s) n\'existent pas !';

    setcookie('identifiant',  $nickname, time() + 365*24*3600, null, null, false, true);
    setcookie('mdp',  $pass, time() + 365*24*3600, null, null, false, true);
    setcookie('keep_connected',  'false', time() + 365*24*3600, null, null, false, true);
  }

  $_SESSION['connected'] = 'true';
  $_SESSION['identifiant'] = $nickname;
  $_SESSION['mdp'] = $pass;

  if($_SESSION['connected'] == 'true'){
    echo $_SESSION['connected'];
  }

?>
