<?php

//Ne pas mettre de code html avant cette ligne !
require '../php_without_view/session_control.php';

echo 'connected = ' . $_SESSION['connected'] . '<br/>';

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/home.css">
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
				<div class="main_element"><h1>ProgrammingAnts</h1></div>
			</div>

				<div id="main_items2">
					<div id="account">
						<div class="identification"><a href="../login/login_page.php">Sign In</a></div>
						<div class="identification"><a href="../register/register_page.php">Sign Up</a></div>
						<div class="identification disconnect"><a href="../php_without_view/disconnect.php">Sign Out</a></div>
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
							<p><img src="../images/progress.png" title="Still progressing on it !"/></p>
							<p>Hey there, we still working on our website to make a great and beautiful anthill to welcome the incoming projects... Come back later ! :D </p>
						</div>

						<div class="article">
							<h2>Forum</h2>
							<p id="link_forum_article"><a href="../forum/forum.php" title="Here is the Forum !" >Here is the forum</a></p>
						</div>

						<div class="article">
							<h2>Blog</h2>
							<img src="../images/not_available.png" class="Not available" />
						</div>

						<div class="article">
							<h2>About</h2>
							<p>This is a test ! Don't care about it... This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...
								This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...
								This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...</p>
						</div>

						<div class="article">
							<h2>Contact Us</h2>
							<p>This is a test ! Don't care about it... This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...
								This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...
								This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...</p>
						</div>
					</div>
				</article>

		</section>

    <aside>
			<div id="reconnection">
				<div class="message"><img src="../images/exit.png" class="exit"/></div>
				<div class="message">Welcome back !</div>
        <div class="message" id="message_user"><p>Pseudo</p></div>
			</div>
		</aside>

		<footer>
      <p id="footer_label">
        © 2018 ProgrammingAnts, Inc.
      </p>
		</footer>
	</body>

</html>
