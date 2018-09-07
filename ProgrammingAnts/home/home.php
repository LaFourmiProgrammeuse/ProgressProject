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
	<title>ProgrammingAnts</title>

    <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="javascript/home.js"></script>
    <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>

</head>

	<body>
		<header>
			<div id="main_items1">
				<div class="main_element"><img src="../images/programming_ants.png" title="ProgrammingAnts Logo"/></div>
				<div class="main_element"><h1>Programming Ants</h1></div>
			</div>

				<div id="main_items2">
					<div id="account">
						<div class="identification" id="login_button"><a href="../login/login_page.php">Sign In</a></div>
						<div class="identification" id="register_button"><a href="../register/register_page.php">Sign Up</a></div>
						<div class="identification" id="disconnect_button"><a href="../php_for_all/disconnect.php">Sign Out</a></div>
					</div>

						<div id="user">
							<div class="user_image"><img src="../images/no_user_image.png" /></div>
							<div class="username"><a href="../profile/profile.php"></a></div>
						</div>
				</div>
		</div>
	</header>

		<section>

			<nav>
				<div id="top_menu">
					<div class="option"><h3><a href="#">Projects</a></h3></div>
						<div class="option"><h3><a href="../forum/forum.php">Forum</a></h3></div>
							<div class="option"><h3><a href="#">Blog</a></h3></div>
								<div class="option"><h3><a href="#">About</a></h3></div>
									<div class="option"><h3><a href="#">Contact</a></h3></div>
				</div>
			</nav>

				<article>
					<div id="articles">
						<div class="article">
							<h2>Projects</h2>
							<p>No projects have been posted on our website for the moment, you should come back later, the ants will call you when the anthill is ready !</p>
						</div>

						<div class="article">
							<h2>Forum</h2>
							<p>Here is the forum, a place where you can talk with other people about a subject. It's the best place to go if you need help, the ants are amiable, they will help you with pleasure !
							<p id="link_forum_article"><a href="../forum/forum.php" title="Forum" >Click here</a></p>
						</div>

						<div class="article">
							<h2>Blog</h2>
							<p>We still working on the blog for the moment, searching for ideas and training the ants !</p>
						</div>

						<div class="article">
							<h2>About</h2>
							<p><span class="bold">Programming Ants</span> is a project that we started to push our limits in programmation and to try to make something that can help people. For the moment, our website is <span class="bold">very limited in content</span>,
								 we can't work faster because we still learning programmation languages (HTML5, PHP, CSS3, etc) to make our ideas done. The other cause is that we are only <span class="bold">two persons behind this project</span>, and it's difficult to work fastly,
								 mostly when we have to solve <span class="bold">bugs and mistakes</span>. The fact that we are only teens and we have to study for school takes us a lot of time aswell. We won't give up and hope that everything will be fine in the futur !</p>
						</div>

						<div class="article">
							<h2>Contact</h2>
							<p>If you want to contact us :</p>
							<p><span class="bold">Programming Ants</span> e-mail adress : <a href="mailto:testp-a@gmail.com" title="Contact us !">testp-a@gmail.com</a></p>
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

            <?php
                require "../footer.php";
            ?>

	</body>

</html>
