<?php

//Ne pas mettre de code html avant cette ligne !
require '../php_for_all/session_control.php';

echo 'connected = ' . $_SESSION['connected'] . '<br/>';

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
				<div class="main_element"><h1>ProgrammingAnts</h1></div>
			</div>

				<div id="main_items2">
					<div id="account">
						<div class="identification"><a href="../login/login_page.php">Sign In</a></div>
						<div class="identification"><a href="../register/register_page.php">Sign Up</a></div>
						<div class="identification disconnect"><a href="../php_for_all/disconnect.php">Sign Out</a></div>
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
							<p>............................... </p>
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
							<p><span class="bold">Programming Ants</span> is a project that we started to push our limits in programmation and to try to make something that can help people. For the moment, our website is <span class="bold">very limited in content</span>,
								 we can't create it faster because we still learning programmation to make our ideas done. The other cause is that we are only <span class="bold">two guys behind this project</span>, and it's difficult to work fast,
								 mostly when we have to solve <span class="bold">bugs and mistakes</span>... The fact that we are only teens and we have to work for school takes us a lot of time aswell. But we wont give up because we know we can make it to the end
							   and that our work will pay !</p>
						</div>

						<div class="article">
							<h2>Contact Us</h2>
							<p>If you want to contact us :</p></br>
							<p><span class="bold">Programming Ants</span> e-mail adress : <span class="bold">testp-a@gmail.com</span></p>
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

            <?php
                require "../footer.php";
            ?>

	</body>

</html>
