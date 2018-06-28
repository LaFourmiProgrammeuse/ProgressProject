<?php

	//Ne pas mettre de code html avant cette ligne !
	session_start();

	$script = 'Background_Task.php';

	$fp = fsockopen('localhost', 80, $errno, $errstr, 10);
	 stream_set_blocking ($fp, false);
	 $header  = "GET $script HTTP /1.1\r\n";
	 $header .= "User-Agent: monScriptPHP\r\n";
	 $header .= "Connection: Close\r\n\r\n";
	 fputs($fp, $header);
	 fclose($fp);


	if(!isset($_SESSION['connected'])){
		//Regarder ici si keep_connected = true dans la base de données selon les identifiants des cookies
		$bdd = new PDO('mysql:host=localhost;dbname=site_project_database;charset=utf8', 'root', '');

		$_SESSION['connected'] = 'false';
	}
		echo 'connected = ' . $_SESSION['connected'] . '<br/>';

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

								<?php
								if($_SESSION['connected'] == 'false'){
									echo '<div id="account">';

										echo '<div class="identification"><a href="Login_page.html">Sign In</a></div>';
										echo '<div class="identification"><a href="Register_page.html">Sign Up</a></div>';

									echo '</div>';
								}
								else{
									echo '<form method="post" action="">';

									echo '<inset type="submit" value="Disconnect">';

										echo '<p>';
										echo '<inset type="submit" value="Disconnect" />';
										echo '</p>';

									echo '</form>';
								}
								?>

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
