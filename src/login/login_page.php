<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" type="text/css" href="css/login_page.css">

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.450, shrink-to-fit=no">

		<title>Log In</title>

        <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
        <script type="text/javascript" src="javascript/login.js"></script>

		<body>
			<div id="body_content">
				<header>
					<div id="h_elements">
						<div id="infa">
							<h2>Log In to Programming Ants</h2>
							<a href="../home/home.php" title="Return to the homepage"><img class="return" src="/images/icons/normal/return.svg"></a>
						</div>
						<div id="infb"><h3>If you are not registered yet, <a href="../register/register_page.php" title="Sign up page">click here</a> to join us !</h3></div>
					</div>
				</header>

					<section>
						<div id="inf_input">
							<div id="group_input">
								<fieldset>
									<form method="post" action="php/formulaire_login.php">
										<input type="text" name="nickname" id="nickname" placeholder="Type your nickname">

										<input type="password" name="pass" id="pass" placeholder="Type your password">

										<div id="checkbox">
											<label class="control control-checkbox">
							          <span id="checkbox_text">Check to stay connected to our website</span>
							        	<input type="checkbox" checked="checked" />
							        	<div class="control_indicator"></div>
							        </label>
										</div>

		 	              <input type="button" value="Send" id="send" class="send" />
									</form>
								</fieldset>
							</div>

							<div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled">Incomplete or poorly filled form</p></div>
							<div class="message_error" id="message_error_bad_credentials"><p class="text_error" id="text_error_bad_filled">The username or the password doesn't match with an existing account</p></div>
					</div>
				</section>
			</div>
		</body>

</html>
