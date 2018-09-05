<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" type="text/css" href="css/login_page.css">
		<meta charset="utf-8">
		<title>Sign In</title>

        <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
        <script type="text/javascript" src="javascript/login.js"></script>

		<body>

				<section>

					<span class="website_name"><a href="../home/home.php" title="Back to Programming Ants">Programming Ants</a></span>
					<img src="../images/programming_ants_ide.png" class="programming_ants_logo_ide" />

                    <div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled">Incomplete or poorly filled form</p></div>
                    <div class="message_error" id="message_error_bad_credentials"><p class="text_error" id="text_error_bad_filled">The username and the word does not match</p></div>

					<fieldset>
						<legend>Log in</legend>

						<form method="post" action="php/formulaire_login.php">
							<p>
								<label for="nickname" id="nickname_label">Nickname</label>
								<input type="text" name="nickname" id="nickname" placeholder="Type your nickname">
							<br>
								<label for="pass" id="pass_label">Password</label>
								<input type="password" name="pass" id="pass" placeholder="Type your password">

							    <label id="stay_connected_label" for="stay_connected">Stay connected to our website</label>
 	                            <input type="checkbox" name="stay_connected" id="stay_connected">

 	                        	<input type="button" value="Send" id="send" class="send" />
							</p>
						</form>
					</fieldset>

			</section>

		</body>

</html>
