<?php

//Ne pas mettre de code html avant cette ligne !
require '../php_for_all/session_control.php';

include "../language/language.php";

//echo 'connected = ' . $_SESSION['connected'] . '<br/>';

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="../footer.css">
	<meta charset="utf-8"/>
	<title><?php echo _("Home");?> ProgAnts</title>

	<script type="text/javascript" src="../framework_javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/home.js"></script>
	<script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>

</head>

<body>
	<div id="modal_warning_no_content">
		<div class="modal_background">
			<div class="modal_content">
				<img src="/images/warning.png" class="warning_img"/>
				<p>This part of the website has not content yet, folow the progress in our DevBlog</p>
			</div>
		</div>
	</div>

	<div id="body_content"> <!-- Pour que le footer soit placer en bas de la page -->

<!-- HEADER -->

		<header>
			<div id="h_groupa">
				<img src="/images/logos/pa.svg" title="Programming Ants' Logo"/>
			</div>

			<div id="h_groupb">
				<!-- Menu de navigation +700px -->
				<div class="h_high_resolution">
					<div class="nav_element nav_element_error_wiki"><h3><a href="#">Solve it!</a></h3></div>
					<div class="nav_element"><h3><a href="../forum/forum.php"><?php echo _("Forum"); ?> </a></h3></div>
					<div class="nav_element nav_element_projects"><h3><a href="#"><?php echo _("Projects"); ?> </a></h3></div>
					<div class="nav_element nav_element_about"><h3><a href="#"><?php echo _("About"); ?> </a></h3></div>
					<div class="nav_element nav_element_contact"><h3><a href="#"><?php echo _("Contact"); ?> </a></h3></div>
				</div>

				<!-- Menu de navigation -700px -->
				<div class="h_small_resolution">
					<img src="/images/menu.png" />

					<div class="vertical_menu" id="h_vertical_menu">
						<div class="nav_element nav_element_error_wiki"><h3><a href="#">Solve it!</a></h3></div>
						<div class="nav_element"><h3><a href="../forum/forum.php"><?php echo _("Forum"); ?> </a></h3></div>
						<div class="nav_element nav_element_projects"><h3><a href="#"><?php echo _("Projects"); ?> </a></h3></div>
						<div class="nav_element nav_element_about"><h3><a href="#"><?php echo _("About"); ?> </a></h3></div>
						<div class="nav_element nav_element_contact"><h3><a href="#"><?php echo _("Contact"); ?> </a></h3></div>
					</div>
				</div>
			</div>

			<div id="h_groupc">
				<div id="h_usera">
					<div class="identification" id="login_button"><a href="../login/login_page.php"> <?php echo _("Log In"); ?> </a></div>
					<div class="identification" id="register_button"><a href="../register/register_page.php"> <?php echo _("Sign Up"); ?> </a></div>
					<div class="identification" id="disconnect_button"><a href="../php_for_all/disconnect.php"> <?php echo _("Log Out"); ?> </a></div>
				</div>

				<div id="h_userb">
					<div class="user_image"><img src="/images/no_user_image.png" /></div>
					<div class="username"><a href="../profile/profile.php"></a></div>
				</div>
			</div>
		</header>

<!-- SECTION -->

		<section id="sect1">
			<div id="top_info">
				<div class="info_element"><img src="/images/icons/info.svg"></div>
				<div class="info_element"><h3>Solve it ! Visit our wiki to find how to solve your coding errors</h3></div>
				<div class="info_element"><h3><a id="goto_solve_it" href="#" title="A link to Solve it!">Click here</a></h3></div>
			</div>
		</section>

		<section id="sect2">
			<div id="illustration_text">
				<article id="title">
					<h1>MAKE PROGRAMMATION EASIER, LEARN FORM YOUR MISTAKES</h1>
					<a href="#">Visit the Errorwiki</a>
				</article>

				<article id="illustration">
					<img src="/images/home_illustration.svg" />
				</article>
			</div>
		</section>

		<section id="sect3">
			<div id="info">
				<p>Visit our forum and ask your questions <a href="../forum/forum.php">here</a>
			</div>

			<article>
				<div id="articles">
					<div class="article">
						<div class="element_image"><img src="/images/errorwiki_illustration.svg" /></div>
						<div class="element_text">
							<p><b>The ErrorWiki is coming soon, just let us the time to finish the most important parts of our website and it will be ready for use !</b></p>
							<br/>
							<p>The <b>ErrorWiki</b> is the place you can find informations about any error/bug you meet while programming. It is made with the results
							of our researches and experiences. If you think something is wrong or incomplete just reply us, we will correct it as fast as we can.
						</div>
					</div>

						<div class="article">
							<div class="element_text">
							<p><b>The Forum is coming soon, just let us the time to finish the most important parts of our website and it will be ready for use !</b></p>
							<br/>
							<p>The <b>Forum</b> is the place where you can discuss with the ProgrammingAnts community about coding, or also to follow the news.
							<p id="link_forum_article"><a href="../forum/forum.php" title="Forum" >Click here to visit the Forum</a></p>
							</div>
						</div>

						<div class="article">
							<div class="element_text">
								<p><b>Projects are coming soon, just let us the time to finish the most important parts of our website and it will be ready for use !</b></p>
							</div>
						</div>

						<div class="article">
							<div class="element_text">
								<p><b>Programming Ants</b> is a project we started to push our limits in programmation and to try making something that can help people. For the moment, our website is <b>very limited in content</b>,
								we can't work faster because we still learning programmation languages (HTML5, PHP, CSS3, JS, ...) to realize what we want to do. Also, we are only <b>two persons behind this project</b>, and it's difficult to work fast,
								mostly when we have to solve <b>bugs and mistakes</b>. We are only teens, so this has a big impact on the way we are working on our website, because we need to study for school. But time passes, and the website is
								getting built slowly !
							</div>
						</div>

						<div class="article">
							<div class="element_text">
								<p><b>Support us !</b></p>
								<p>You can download our wallpapers and share them to your friends to support us !</p>
							</div>
							<div id="overview">
								<div class="wallpaper"><a href="/content/download_content.php?content_name=download_pawallpaper1440x900_1.png"><img src="/content/download_pawallpaper1440x900_1.png" /></a></div>
							</div>
						</div>

							<div class="article">
								<div class="element_text">
								<p>If you want to contact us :</p>
								<p><b>Programming Ants</b> contact e-mail adress : <a href="mailto:contact@programming-ants.ovh" title="Contact us !">contact@programming-ants.ovh</a></p>
								</div>
							</div>
						</div>
					</article>
				</section>

<!-- ASIDE -->

					<aside>
						<div id="reconnection">
							<div class="message">Welcome back </div>
							<div class="message" id="message_user"><p></p></div>
						</div>
					</aside>

<!-- FOOTER -->

					<?php
					require "../footer.php";
					?>

				</div>

			</body>

			</html>
