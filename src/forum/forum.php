<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" type="text/css" href="css/forum.css">
		<meta charset="utf-8">
		<title>Forum ProgAnts</title>

	</head>

	<body>
		<div id="body_content"> <!-- Pour que le footer soit placer en bas de la page -->
		<header>
			<div id="h_groupa">
				<div id="h_main_img"><a href="/src/home/home.php"><img src="/images/programming_ants.png" title="ProgrammingAnts Logo"/></a></div>
			</div>

			<div id="h_groupb">
				<div class="nav_element"><h3><span class="object">></span> Forum</h3></div>
			</div>

				<div id="h_groupc">
					<div id="h_usera">
						<div class="identification" id="login_button"><a href="../login/login_page.php">Log In</a></div>
						<div class="identification" id="register_button"><a href="../register/register_page.php">Sign Up</a></div>
						<!-- <div class="identification" id="disconnect_button"><a href="../php_for_all/disconnect.php">Log Out</a></div> -->
					</div>

					<!-- <div id="h_userb">
							<div class="user_image"><img src="/images/no_user_image.png" /></div>
							<div class="username"><a href="../profile/profile.php"></a></div>
					</div> -->
				</div>
	</header>

		<section>
		</section>

		<aside>
			<!-- <div id="reconnection">
				<div class="message">Welcome back </div>
				<div class="message" id="message_user"><p></p></div>
			</div> -->
		</aside>

		</div>

		<?php
				require "../footer.php";
		?>

	</body>

</html>
