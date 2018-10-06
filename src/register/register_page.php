<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/register_page.css">
		<meta charset="utf-8">
		<title>SignUp ProgAnts</title>

    <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="javascript/register.js"></script>
  </head>

		<body>
			<div id="body_content">
			<header>
				<div id="h_element">
					<div id="infa"><h2>Sign Up to Programming Ants</h2></div>
					<div id="infb"><h3>If you already have an existing account, <a href="../login/login_page.php" title="Log In page">click here</a> to log in !</h3></div>
				</div>
			</header>

				<section>

					<div id="inf_input">
						<div id"group_input"><fieldset>
							<form method="post" action="php/formulaire_register.php">
								<p>
									<input type="text" name="nickname" id="nickname" placeholder="Type your nickname">
                  <img id="validation_nickname" src="../images/wrong.png"/>
								<br>
									<input type="password" name="pass" id="pass" placeholder="Type your password">
                  <img id="validation_pass" src="../images/wrong.png"/>
								<br>
									<input type="password" name="pass_confirm" id="pass_confirm" placeholder="Confirm your password">
                  <img id="validation_pass_confirm" src="../images/wrong.png"/>
								<br>
									<input type="e-mail" name="email" id="email" placeholder="Ex:exemple@gmail.com">
                  <img id="validation_email" src="../images/check.png"/>

                  <button type="button" value="Send" id="send" class="send">Send</button>
								</p>
							</form>
						</fieldset></div>

						<div class="message_error" id="message_error_nickname"><p class="text_error">Error</p></div>
						<div class="message_error" id="message_error_password"><p class="text_error">Error</p></div>
						<div class="message_error" id="message_error_confirmation_password"><p class="text_error">Error</p></div>
						<div class="message_error" id="message_error_email"><p class="text_error">Error</p></div>
						<div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled">Incomplete or poorly filled form</p></div>
					</div>

				</section>

			</div>
		</body>

</html>
