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

        <div class="groupa">
            <h2>For contact us</h2>

            <p>If you have a question, an information to send us or an idea to improve the site, you can contact us by email or by private message on instagram. </p>
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
            <p class="pull_request">You can propose a solution to a bug or suggest improving a feature in the form of code on github</p>

            <button class="btn_bugreport_show_popup">Report a bug</button>
        </div>
    </div>

    <?php require "../footer.php"; ?>
</body>
</html>
