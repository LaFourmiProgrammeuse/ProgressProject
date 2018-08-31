<!DOCTYPE html>
<html>

	<head>

		<link rel="stylesheet" type="text/css" href="css/register_page.css">
		<meta charset="utf-8">
		<title></title>

        <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
        <script type="text/javascript" src="javascript/register.js"></script>

    </head>

		<body>

				<section>

					<span class="website_name"><a href="../home/home.php">ProgrammingAnts</a></span>
					<img src="../images/programming_ants.png" class="programming_ants_logo" />

                    <div class="message_error" id="message_error_nickname"><p class="text_error">Error</p></div>
                    <div class="message_error" id="message_error_password"><p class="text_error">Error</p></div>
                    <div class="message_error" id="message_error_confirmation_password"><p class="text_error">Error</p></div>
                     <div class="message_error" id="message_error_email"><p class="text_error">Error</p></div>
                    <div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled">Incomplete or poorly filled form</p></div>

					<fieldset>
						<legend>Join us!</legend>

						<form method="post" action="../../php_without_view/formulaire_register.php">
							<p>
								<label id="nickname_label" for="nickname">Nickname</label>
								<input type="text" name="nickname" id="nickname" placeholder="Type your nickname" size="30" maxlength="20">
                                <img id="validation_nickname" src="../images/wrong.png"/>
							<br>
								<label id="pass_label" for="pass">Password</label>
								<input type="password" name="pass" id="pass" placeholder="Type your password" size="30" maxlength="20">
                                <img id="validation_pass" src="../images/wrong.png"/>
							<br>
								<label id="confirmation_password_label" for="pass">Confirm password</label>
								<input type="password" name="confirmation_password" id="confirmation_password" placeholder="Confirm your password" size="30" maxlength="20">
                                <img id="validation_confirmation_password" src="../images/wrong.png"/>
							<br>
								<label id="email_label" for="post">E-mail</label>
								<input type="e-mail" name="email" id="email" placeholder="Ex:tindyosh@gmail.com" size="30" maxlength="30">
                                <img id="validation_email" src="../images/check.png"/>

                                <button type="button" value="Send" id="send" class="send" >Send</button>
							</p>
						</form>
					</fieldset>

			</section>

		</body>

</html>