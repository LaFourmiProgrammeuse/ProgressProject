<?php

session_start();

try{
$bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', '');
$req = $bdd->prepare('INSERT INTO Users (id, identifiant, mot_de_passe, mail) VALUES(:id, :identifiant, :mdp, :mail)');
$req->execute(array('id' => 1, 'identifiant' => 'antoine', 'mdp' => '151172', 'mail' => 'antoinegggg'));
}
catch(Exception $e){
	echo 'Erreur : ' . $e.getMessage();
}

?>


<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" type="text/css" href="../css/home_acceuil.css">
		<meta charset="utf-8"></meta>
		<title></title>

			<style type="text/css">
				a:link
				{
					text-decoration: none;
				}
			</style>

	</head>

		<body>
			<header>
				<span class="website_name"><h1>ProgrammingAnts</h1></span>
				<img src="../images/programming_ants.png" class="programming_ants_logo" />

					<div id="account">

						<div class="identification">Sign In</div>
						<div class="identification">Sign Up</div>

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

				<div id="bottom">



				</div>

			</footer>

		</body>

</html>
<!DOCTYPE html>
<html>
	
	<head>

		<link rel="stylesheet" type="text/css" href="../css/home_acceuil.css">
		<meta charset="utf-8"></meta>
		<title></title>

			<style type="text/css">
				a:link
				{
					text-decoration: none;
				}
			</style>

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
>>>>>>> 4078254ad8016c1339596fcfa9508d1cfc165b14
