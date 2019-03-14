<?php

//Ne pas mettre de code html avant cette ligne !
require '../php_for_all/session_control.php';

include "../language/language.php";

//echo 'connected = ' . $_SESSION['connected'] . '<br/>';

error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="../footer.css">
	<link rel="stylesheet" type="text/css" href="../widgets/simple_image_viewer/simple_image_viewer.css">
	<meta charset="utf-8"/>
	<title><?php echo _("Home");?></title>

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
					<div class="nav_element"><a href="../forum/forum.php"><?php echo _("Forum"); ?> </a></div>
					<div class="nav_element nav_element_projects"><a href="#"><?php echo _("Projects"); ?> </a></div>
					<div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
					<div class="nav_element nav_element_contact"><a href="#"><?php echo _("Contact"); ?> </a></div>
				</div>

				<!-- Menu de navigation -700px -->
				<div class="h_small_resolution">
					<img src="/images/menu.png" />

					<div class="vertical_menu" id="h_vertical_menu">
						<div class="nav_element"><a href="../forum/forum.php"><?php echo _("Forum"); ?> </a></div>
						<div class="nav_element nav_element_projects"><a href="#"><?php echo _("Projects"); ?> </a></div>
						<div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
						<div class="nav_element nav_element_contact"><a href="#"><?php echo _("Contact"); ?> </a></div>
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
					<div id="user_image">
						<img src="/images/no_user_image.png" />
				  </div>
					<a id="user_username" href="../profile/profile.php"> <?php echo $_SESSION['username']; ?> </a>
				</div>
			</div>
		</header>

<!-- SECTION -->

		<section id="sect1">
			<div id="illust_text">
				<article id="title">
					<h1>MAKE PROGRAMMATION EASIER, LEARN FROM YOUR MISTAKES</h1>
					<a href="/src/forum/forum.php">Visit the forum</a>
				</article>

				<article id="illus">
					<img src="/images/home_illustration.svg" />
				</article>
			</div>
		</section>

		<section id="sect2">
			<div id="inf_area">
				<div id="inf">
					<h3>Solve it ! Visit our wiki to find how to solve your coding errors</h3>
					<a id="link_to" href="#" title="A link to Solve it!">Click here</a>
				</div>
			</div>

			<article>
				<div id="s_groupa">
					<div class="a1">
						<div class="element_icon">
							<img class="a_logo" src="/images/icons/solve_it.svg">
						</div>
						<div class="element_text">
							<h3>Solve it !</h3>
							<p>It is our main project on <b>Programming Ants</b>. It's goal is to <b>help programmers</b> to find what is wrong with their code when they
								meet <b>errors or bugs</b>. Me and my friend didn't start this project yet, but we've got many ideas to get a nice final result. For the now we
								continue to polish the entire website, working on some failed designs or little/big graphic bugs. This <b>Wiki</b> is the last step before
								we start making little random softwares. We just hope everything will ok, so we can keep a fast workflow.
							</p>
						</div>
					</div>

					<div class="a1">
						<div class="element_icon">
							<img class="a_logo" src="/images/icons/forum.svg">
						</div>
						<div class="element_text">
							<h3>Forum</h3>
							<p>It is a place to <span class="semi_bold">share your opinion or get some help from the community</span>. This is the first thing we've made after having a working website and we're
								pretty proud of it, even <span class="semi_bold">it is not finished</span>. The design is <span class="semi_bold">not the final one</span>, and there are still <span class="semi_bold">several bugs</span>. For the moment it is our best production,
								and especially the most complex. In the future, maybe we will do even better.
							</p>
						</div>
					</div>
				</div>

				<div id="s_groupb">
					<div class="a2">
						<div class="element_text">
							<p><span class="semi_bold">Programming Ants</span> is a project we started to push our limits in programmation and to try making something that can help people. For the moment, our website is <span class="semi_bold">very limited in content</span>,
								we can't work faster because we still learning programmation languages (HTML5, PHP, CSS3, JS, ...) to realize what we want to do. Also, we are only <span class="semi_bold">two persons behind this project</span>, and it's difficult to work fast,
								mostly when we have to solve <span class="semi_bold">bugs and mistakes</span>. We are only teens, so this has a big impact on the way we are working on our website, because we need to study for school. But time passes, and the website is
								getting built slowly !
						</div>
					</div>

					<div class="a2">
						<div class="element_text">
							<p><b>Support us !</b></p>
							<p>You can download our wallpapers and share them to your friends to support us !</p>
						</div>
						<div id="overview">
							<div class="wallpaper"><a href="/content/download_content.php?content_name=download_pawallpaper1440x900_1.png"><img src="/content/download_pawallpaper1440x900_1.png" /></a></div>
						</div>
					</div>

					<?php
					include "../widgets/simple_image_viewer/simple_image_viewer.php";
					$siv = new SimpleImageViewer();
					$siv->setImageViewerId("1");
					$siv->addImage("../../content/download_pawallpaper1440x900_1.png");
					$siv->addImage("../../images/4046_386_plan_metroB_2017.jpg");
					$siv->addImage("../../images/thumb-1920-430892.png");
					$siv->setMandatoryPartOfUrl("?");
					$siv->createHtmlCode();
					?>

					<div class="a2">
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
