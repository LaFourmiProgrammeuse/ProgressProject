<?php

//Ne pas mettre de code html avant cette ligne !
require '/home/programmpk/www/src/php_for_all/session_control.php';
include "/home/programmpk/www/src/language/language.php";

IncrementVisitorCounter();
?>

<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="/src/contact/css/contact.css" />

    <!-- SCRIPTS -->
    <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="/src/framework_javascript/ajax.js"></script>
    <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=6LdPWrQUAAAAABdiTBF5vWQ7OlFWXdqC6-87C9ns"></script>

    <script type="text/javascript" src="/src/framework_javascript/particles.js"></script>
    <script type="text/javascript" src="/src/contact/javascript/contact.js"></script>



</head>
<body>

    <div id="body_content">

    <!-- HEADER -->
    <?php require "/home/programmpk/www/src/header/header.php"; ?>

    <div id="particles-frame"></div>

    <div id="central_container">

        <?php
            if($_GET["onglet"] == "bug_report"){
                require "/home/programmpk/www/src/contact/onglets/bug_report.php";
            }
            else{
        ?>

        <div class="groupa">
            <h2>For contact us</h2>

            <p>If you have a question, an information to send us or an idea to improve the site, you can contact us by email or by private message on <a href="https://www.instagram.com/prog_ants/">instagram. </a></p>
            <p class="answer_time">There is no defined response time but we try to respond quickly</p>

            <div class="show_mail">

                <button class="btn_show_mail">Show contact mail</button>
                <div class="mail"></div>
                <div class="g_recaptcha_frame"></div>

            </div>
        </div>

        <div class="groupb">
            <h2>Bug report</h2>

            <p>If during your browsing you encounter a malfunction you can report it to us here by filling out the form. This will allow us to adjust it and improve the site.</p>
            <p class="pull_request">You can propose a solution to a bug or suggest improving a feature in the form of code on <a href="https://github.com/LaFourmiProgrammeuse/ProgressProject">github</a></p>

            <a class="link_bug_report" href="/contact.php?onglet=bug_report"><button class="btn_bugreport_show_form">Report a bug</button></a>
        </div>
        <?php } ?>
    </div>

    <?php require "../footer.php"; ?>
</body>
</html>
