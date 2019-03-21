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

		<section id="sec_1">
			<div id="welcome_t">
				<div id="title">
					<h1>Make programmation easier,<br>learn from your mistakes
					</h1>
				</div>
				<div id="link">
					<a href="/src/forum/forum.php">Visit the forum</a>
				</div>
			</div>

			<div id="welcome_i">
				<img src="/images/illustrations/home_i.svg" />
			</div>
		</section>

		<section id="sec_2">
			<div id="inf_box">
				<div class="inf_area">
					<h3>Solve it ! Visit our wiki to find how to solve your coding errors</h3>
				</div>
				<div class="inf_area">
					<a id="link_to" href="#" title="A link to Solve it !">Click here for more informations</a>
				</div>
			</div>

			<article>
				<div id="s_groupa">
					<div class="a1">
						<div class="element_icon">
							<img class="a_logo" src="/images/icons/articles/solveit.svg">
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
							<img class="a_logo" src="/images/icons/articles/forum.svg">
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
						<div class="element_icon">
							<img class="a_logo" src="/images/icons/articles/projects.svg">
						</div>
						<div class="element_text">
							<h3>The Project</h3>
							<p><span class="semi_bold">Programming Ants</span> is a project we started to push our limits in programmation and to try making something that can help people. For the moment, our website is <span class="semi_bold">very limited in content</span>,
								we can't work faster because we still learning programmation languages (HTML5, PHP, CSS3, JS, ...) to realize what we want to do. Also, we are only <span class="semi_bold">two persons behind this project</span>, and it's difficult to work fast,
								mostly when we have to solve <span class="semi_bold">bugs and mistakes</span>. We are only teens, so this has a big impact on the way we are working on our website, because we need to study for school. But time passes, and the website is
								getting built slowly !
						</div>
					</div>

					<div class="a2">
						<div class="element_icon">
							<img class="a_logo" src="/images/icons/articles/support.svg">
						</div>
						<div class="element_text">
							<h3>Support us !</h3>
							<p>You can download our wallpapers and share them to your friends to support us !</p>
						</div>
					</div>
				</div>

					<?php
						echo "<div class='widget_simple_image_viewer' id='siv_1'>";

					  //Contenu à charger en javascript
						echo "<div class='widget_body'>";
			        echo "<div class='left_arrow'><img src='/images/arrows/a_left.png' /></div>";
			        echo "<div class='left_image'><img src='' /></div>";
			        echo "<div class='central_image'><img src='' /></div>";
			        echo "<div class='right_image'><img src='' /></div>";
			        echo "<div class='right_arrow'><img src='/images/arrows/a_right.png' /></div>";
			      echo "</div>";

						echo "</div>";
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
