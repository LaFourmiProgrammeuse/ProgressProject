<?php

//Ne pas mettre de code html avant cette ligne !
require '/home/programmpk/www/src/php_for_all/session_control.php';
include "/home/programmpk/www/src/language/language.php";

IncrementVisitorCounter();

if(isset($_GET['redirection_path']))
    $_SESSION["redirection_path_after_connection"] = str_replace("and", "&", $_GET['redirection_path']);

?>

<!DOCTYPE html>
<html>
	<head>

        <!-- Google Analytics -->
        <?php include "/home/programmpk/www/src/analytic_tools/google_analytics.html"; ?>

		<link rel="stylesheet" type="text/css" href="/src/login/css/login_page.css">

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.400, shrink-to-fit=no">

		<title>Log In</title>

        <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
        <script type="text/javascript" src="/src/login/javascript/login.js"></script>

		<body>
			<div id="body_content">
				<header>
					<div id="h_elements">
						<div id="infa">
							<h2>Log In to Programming Ants</h2>
							<a href="/home.php" title="Return to the homepage"><img id="return" src="/images/icons/others/return.svg"></a>
						</div>
						<div id="infb"><h3>If you are not registered yet, <a href="/register.php" title="Sign up page">click here</a> to join us !</h3></div>
					</div>
				</header>

					<section>
						<div id="inf_input">
							<div id="group_input">
								<fieldset>
									<form method="post" action="/src/login/php/formulaire_login.php">
										<input type="text" name="nickname" id="nickname" placeholder="Type your nickname">

										<input type="password" name="pass" id="pass" placeholder="Type your password">

										<div id="checkbox">
											<label class="control control-checkbox">
							          <span id="checkbox_text">Check to stay connected to our website</span>
							        	<input type="checkbox" checked="checked" />
							        	<div class="control_indicator"></div>
							        </label>
										</div>

		 	                        <button type="button" value="Send" id="send" class="send" >Send</button>
									</form>
								</fieldset>
							</div>

							<div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled">Incomplete or poorly filled form</p></div>
							<div class="message_error" id="message_error_bad_credentials"><p class="text_error" id="text_error_bad_filled">The username or the password doesn't match with an existing account</p></div>
					</div>
				</section>
			</div>
            <div class="page_change_orientation">

            </div>
		</body>
</html>
