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

								<div class="checkbox">
									<input type="checkbox" name="checkbox" id="checkbox">
							  	<label for="checkbox"></label>
									<span id="checkbox_label">Stay connected to our website</span>
								</div>

 	              	<input type="button" value="Send" id="send" class="send" />
								</p>
							</form>
						</fieldset></div>

						<div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled"><b>Incomplete</b> or <b>poorly</b> filled form</p></div>
						<div class="message_error" id="message_error_bad_credentials"><p class="text_error" id="text_error_bad_filled">The <b>username</b> or the <b>password</b> doesn't match with an existing account</p></div>
					</div>

			</section>
		</div>
		</body>

</html>
