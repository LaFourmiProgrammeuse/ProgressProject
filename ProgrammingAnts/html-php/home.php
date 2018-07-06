<?php

//Ne pas mettre de code html avant cette ligne !
require 'Session_Control.php';

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
                                echo '<div id="account">';
                                    echo '<div class="disconnect">';
                                        echo '<a href="Disconnect.php">Disconnect</a>';
                                    echo '</div>';
                                    echo '<img src="../images/programming_ants.png" class="user_image" />';
                                echo '</div>';
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

				<img src="../images/working.png" class="working" />

			</article>
		</section>

        <div id="message_connection">
            <p>Good to meet you again :)</p>
        </div>

		<footer>



		</footer>

	</body>

</html>
