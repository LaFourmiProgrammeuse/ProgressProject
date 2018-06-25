<?php

	/*try{
		 //'INSERT INTO users (id, identifiant, mot_de_passe, mail) VALUES (:id, :identifiant, :mdp, :mail)'

		$bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		$rep = $bdd->query('SELECT * FROM users');
		$qprepare = $bdd->prepare('INSERT INTO users (id, identifiant, mot_de_passe, mail) VALUES (:id, :identifiant, :mdp, :mail)');
		$qprepare->execute(array('id' => '3', 'identifiant' => $_POST[nickname], 'mdp' => $_POST[pass], 'mail' => $_POST[e-mail]));

	}
	catch(Exception $e){
		echo $e;
	}

	echo '<ul>';

			while($donnees = $rep->fetch()){
				echo '<li>' . $donnees['identifiant'] . '</li>';
			}
	echo '</ul>';

*/

 ?>

<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" type="text/css" href="../css/home_acceuil.css">
		<meta charset="utf-8"></meta>
		<title></title>

	</head>

		<body>
			<header>
				<span class="website_name"><h1>ProgrammingAnts</h1></span>
				<img src="../images/programming_ants.png" class="programming_ants_logo" />

					<div id="account">

						<div class="identification"><a href="Login_page.html">Sign In</a></div>
						<div class="identification"><a href="Register_page.html">Sign Up</a></div>

					</div>
			</header>

			<section>
				<nav>

					<div id="top_menu">

						<div class="shortcut"><h3><a href="projects.html">Projects</a></h3></div>
							<div class="shortcut"><h3><a href="forum.html">Forum</a></h3></div>
								<div class="shortcut"><h3><a href="about.html">About</a></h3></div>
									<div class="shortcut"><h3><a href="contact.html">Contact</a></h3></div>

					</div>
				</nav>

				<article>

					<div id="article">



					</div>

				</article>
			</section>

			<footer>



			</footer>

		</body>

</html>
