<?php

//Ne pas mettre de code html avant cette ligne !
require '../php_for_all/session_control.php';

//echo 'connected = ' . $_SESSION['connected'] . '<br/>';

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" type="text/css" href="../footer.css">
	<meta charset="utf-8"/>
	<title>Home ProgAnts</title>

    <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="javascript/home.js"></script>
    <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>

</head>

	<body>
    <div id="body_content"> <!-- Pour que le footer soit placer en bas de la page -->
		<header>
			<div id="h_groupa">
				<div id="h_main_img"><img src="../images/programming_ants.png" title="ProgrammingAnts Logo"/></div>
			</div>

			<div id="h_groupb">
				<div class="nav_element"><h3><a href="#"> <span class="object">></span> ErrorWiki</a></h3></div>
					<div class="nav_element"><h3><a href="../forum/forum.php"> <span class="object">></span> Forum</a></h3></div>
						<div class="nav_element"><h3><a href="#"> <span class="object">></span> Projects</a></h3></div>
							<div class="nav_element"><h3><a href="#"> <span class="object">></span> About</a></h3></div>
								<div class="nav_element"><h3><a href="#"> <span class="object">></span> Contact</a></h3></div>
			</div>

				<div id="h_groupc">
					<div id="h_usera">
						<div class="identification" id="login_button"><a href="../login/login_page.php">Log In</a></div>
						<div class="identification" id="register_button"><a href="../register/register_page.php">Sign Up</a></div>
						<div class="identification" id="disconnect_button"><a href="../php_for_all/disconnect.php">Log Out</a></div>
					</div>

					<div id="h_userb">
							<div class="user_image"><img src="../images/no_user_image.png" /></div>
							<div class="username"><a href="../profile/profile.php"></a></div>
					</div>
				</div>
	</header>

		<section>

				<article>
					<div id="articles">
						<div class="article">
							<h2>_ErrorWiki ></h2>
							<p><b>The ErrorWiki is coming soon, just let us the time to finish the most important part of our website and it will be ready !</b></p>
							<br/>
							<p>The <b>ErrorWiki</b> is the place where you can find the answer about any error/bug you meet while programming. The ErrorWiki is made with the results
							of our researches, so it can be incomplete or wrong. If you think something is wrong or incomplete, reply us on the concerned wiki page, and if we
							get many returns about the same problem, we will fix the mistake.
						</div>

						<div class="article">
							<h2>_Forum ></h2>
							<p><b>The Forum is coming soon, just let us the time to finish the most important part of our website and it will be ready !</b></p>
							<br/>
							<p>The <b>Forum</b> is the place where you can discuss with the ProgrammingAnts community about programmation or follow the news of the Programming
							<p id="link_forum_article"><a href="../forum/forum.php" title="Forum" >Click here</a></p>
						</div>

						<div class="article">
							<h2>_Projects ></h2>
							<p><b>Projects are coming soon, just let us the time to finish the most important part of our website.</b></p>
							<br/>
							<p>For now you can download our wallpaper (which is available in only one dimensions), just click on the image below</p>
							<br/>
							<a href="../content/pa_official_wallpaper.jpg" download="OfficialPAWallpaper"><img src="../images/wallpaper.png" /></a>

						</div>

						<div class="article">
							<h2>_About ></h2>
							<p><b>Programming Ants</b> is a project that we started to push our limits in programmation and to try to make something that can help people. For the moment, our website is <b>very limited in content</b>,
								 we can't work faster because we still learning programmation languages (HTML5, PHP, CSS3, etc) to make our ideas done. The other cause is that we are only <b>two persons behind this project</b>, and it's difficult to work fastly,
								 mostly when we have to solve <b>bugs and mistakes</b>. The fact that we are only teens and we have to study for school takes us a lot of time aswell. We won't give up and hope that everything will be fine in the futur !</p>
						</div>

						<div class="article">
							<h2>_Contact ></h2>
							<p>If you want to contact us :</p>
							<p><b>Programming Ants</b> e-mail adress : <a href="mailto:testp-a@gmail.com" title="Contact us !">testp-a@gmail.com</a></p>
						</div>
					</div>
				</article>

		</section>

    <aside>
			<div id="reconnection">
				<div class="message">Welcome back </div>
        <div class="message" id="message_user"><p></p></div>
			</div>
		</aside>

    </div>

    <?php
        require "../footer.php";
    ?>

	</body>

</html>
