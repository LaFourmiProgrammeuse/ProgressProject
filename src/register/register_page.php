<?php

//Ne pas mettre de code html avant cette ligne !
require '/home/programmpk/www/src/php_for_all/session_control.php';
include "/home/programmpk/www/src/language/language.php";

IncrementVisitorCounter();
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Google Analytics -->
    <?php include "/home/programmpk/www/src/analytic_tools/google_analytics.html"; ?>

    <link rel="stylesheet" type="text/css" href="/src/register/css/register_page.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.430, shrink-to-fit=no">

    <title>Sign Up</title>

    <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="/src/register/javascript/register.js"></script>
</head>

<body>
    <div id="body_content">
        <header>
            <div id="h_elements">
                <div id="infa">
                    <h2>Sign Up to Programming Ants</h2>
                    <a href="/home.php" title="Return to the homepage"><img class="return" src="/images/icons/others/return.svg"></a>
                </div>
                <div id="infb"><h3>If you already have an existing account, <a href="/login.php" title="Log In page">click here</a> to log in !</h3></div>
            </div>
        </header>

        <section>
            <div id="inf_input">
                <div id="group_input">
                    <fieldset>
                        <form method="post" action="/src/register/php/formulaire_register.php">
                            <div id="inf_box">
                                <input type="text" name="nickname" id="nickname" placeholder="Type your nickname">
                                <img id="validation_nickname" src="/images/wrong.png"/>
                            </div>

                            <div id="inf_box">
                                <input type="password" name="pass" id="pass" placeholder="Type your password">
                                <img id="validation_pass" src="/images/wrong.png"/>
                            </div>

                            <div id="inf_box">
                                <input type="password" name="pass_confirm" id="pass_confirm" placeholder="Confirm your password">
                                <img id="validation_pass_confirm" src="/images/wrong.png"/>
                            </div>

                            <div id="inf_box">
                                <input type="e-mail" name="email" id="email" placeholder="Ex:exemple@gmail.com">
                                <img id="validation_email" src="/images/check.png"/>
                            </div>

                            <button type="button" value="Send" id="send" class="send">Send</button>
                        </form>
                    </fieldset>
                </div>

                <div class="message_error" id="message_error_nickname"><p class="text_error">Error</p></div>
                <div class="message_error" id="message_error_password"><p class="text_error">Error</p></div>
                <div class="message_error" id="message_error_confirmation_password"><p class="text_error">Error</p></div>
                <div class="message_error" id="message_error_email"><p class="text_error">Error</p></div>
                <div class="message_error" id="message_error_bad_filled"><p class="text_error" id="text_error_bad_filled">Incomplete or poorly filled form</p></div>
            </div>
        </section>
    </div>
    <div class="page_change_orientation">

    </div>
</body>

</html>
