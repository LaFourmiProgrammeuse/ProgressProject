<<<<<<< HEAD:ProgrammingAnts/html/home.php
<?php

session_start();

try{
$bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', '');
$bdd.exec("INSERT INTO users (id, identifiant, mot_de_passe, mail) VALUES(\'\'zdzqdqdq\', \'antoine\', \'151172\', \'antoine.sauzeau@gmail.com\')");
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
=======
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
				
				

			</footer>

		</body>

</html>
>>>>>>> 11df6c06aaedd8b6f63ff113c7f774fd494b54e4:ProgrammingAnts/html/home.html~
