<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" type="text/css" href="css/login_page.css">
		<meta charset="utf-8">
		<title>Log In</title>

        <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
        <script type="text/javascript" src="javascript/login.js"></script>

		<body>
			<div id="body_content">
			<header>
				<div id="h_element">
					<div id="infa"><h2>Log In to Programming Ants</h2></div>
					<div id="infb"><h3>If you are not registered yet, <a href="../register/register_page.php" title="Sign up page">click here</a> to join us !</h3></div>
				</div>
			</header>

				<section>

					<div id="inf_input">
						<div id"group_input"><fieldset>
							<form method="post" action="php/formulaire_login.php">
								<p>
									<input type="text" name="nickname" id="nickname" placeholder=" Type your nickname">
								<br>
									<input type="password" name="pass" id="pass" placeholder=" Type your password">

							  	<label id="stay_connected_label" for="stay_connected"></label>
 	              	<input type="checkbox" name="stay_connected" id="stay_connected">

 	              	<input type="button" value="Send" id="send" class="send" />
								</p>
							</form>
						</fieldset></div>

						<div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled">Incomplete or poorly filled form</p></div>
						<div class="message_error" id="message_error_bad_credentials"><p class="text_error" id="text_error_bad_filled">The username and the word does not match</p></div>
					</div>

			</section>
		</div>
		</body>

</html>
