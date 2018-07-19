<?php

//Ne pas mettre de code html avant cette ligne !
require '../php/session_control.php';

echo 'connected = ' . $_SESSION['connected'] . '<br/>';

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<meta charset="utf-8"/>
	<title>ProgrammingAnts</title>

    <script type="text/javascript" src="../javascript/framework/jquery.js"></script>
    <script type="text/javascript" src="../javascript/home.js"></script>
    <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>

</head>

	<body>
		<header>
			<div id="main">
				<div class="main_element"><img src="../images/programming_ants.png" title="ProgramminAnts Logo"/></div>
					<div class="main_element"><h1>ProgrammingAnts</h1></div>
						<div id="account">
							<div class="identification"><a href="Login_page.html">Sign In</a></div>
							<div class="identification"><a href="Register_page.html">Sign Up</a></div>
          		<div class="identification disconnect"><a href="../php/disconnect.php">Sign Out</a></div>
						</div>
						<div id="user">
							<div class="user_image"><img src="../images/no_user_image.png" class="user_image" /></div>
							<div class="username"><a href="#"></a></div>
            </div>
			</div>
		</header>

		<section>

			<nav>
				<div id="top_menu">
					<div class="option"><h3><a href="#">Projects</a></h3></div>
						<div class="option"><h3><a href="forum.html">Forum</a></h3></div>
							<div class="option"><h3><a href="#">Blog</a></h3></div>
								<div class="option"><h3><a href="#">About</a></h3></div>
									<div class="option"><h3><a href="#">Contact</a></h3></div>
				</div>
			</nav>

				<article>
					<div id="articles">
						<div class="article">
							<h2>Projects</h2>
							<p><img src="../images/terminal.png" class="test_image" title="A terminal image"/></p>
							<p>This is a test ! Don't care about it... This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...</p>
						</div>

						<div class="article">
							<h2>Forum</h2>
							<p>Click on this link : <a href="https://www.hackthis.co.uk/" title="Join the Hacker's clan" >https://www.hackthis.co.uk/</a></p>
						</div>

						<div class="article">
							<h2>Blog</h2>
							<p>This is a test ! Don't care about it... This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...
								This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...
								This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...This is a test ! Don't care about it...</p>
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

		</footer>
	</body>

</html>
