<?php

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

  echo '<br>Vous vous êtes inscrit avec ses informations : ';
  echo '<ul>';
				echo '<li>' . $nickname . '</li>';
        echo '<li>' . $pass . '</li>';
        echo '<li>' . $email . '</li>';
	echo '</ul>';

?>
