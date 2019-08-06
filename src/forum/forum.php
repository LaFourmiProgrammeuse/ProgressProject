<?php
//Ne pas mettre de code html avant cette ligne !
require '/home/programmpk/www/src/php_for_all/session_control.php';
include "/home/programmpk/www/src/language/language.php";

IncrementVisitorCounter();

//Debug
ini_set("display_errors", 1);
ini_set('error_log', dirname(__file__) . '../log_server.txt');

//On ouvre une connection avec la bdd (utilisée dans les onglets php)
try{
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$username = $_SESSION['username'];

$qprepare = $bdd->prepare("SELECT profile_image_name FROM users WHERE username=?");
$qprepare->execute(array($username));

$profile_image_name = $qprepare->fetch()["profile_image_name"];
$profile_image_url = "/images/user_image/" . $profile_image_name;

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <title>Forum</title>

    <!-- Google Analytics -->
    <?php include "/home/programmpk/www/src/analytic_tools/google_analytics.html"; ?>

    <!-- CSS LINKS -->
    <link rel="stylesheet" type="text/css" href="/src/forum/css/forum.css" />
    <link rel="stylesheet" type="text/css" href="/src/header/header.css" />

    <!-- SCRIPTS -->
    <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
    <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/src/framework_javascript/ajax.js"></script>
    <script type="text/javascript" src="/src/forum/javascript/forum.js" ></script>
    <script type="text/javascript" src="/src/javascript_for_all/url_methods.js"></script>

</head>

<body>

    <div class="tooltip_connection">
        <p>To perform this action, you have to be connected</p>
        <div class="link_page_connection">Log In</div>
    </div>

    <div id="body_content"> <!-- Pour que le footer soit placer en bas de la page -->

        <!-- HEADER -->
        <?php require "/home/programmpk/www/src/header/header.php"; ?>

        <section>
            <div id="forum_content">

                <?php
                if(isset($_GET['forum_part'])){
                    if($_GET['forum_part'] == "rules"){
                        require "onglets/rules.php";
                    }
                    else if($_GET['forum_part'] == "stats"){
                        require "onglets/stats.php";
                    }
                    else if($_GET['forum_part'] == "forums"){
                        require "onglets/forums.php";
                    }
                    else if($_GET['forum_part'] == "forum"){
                        if(isset($_GET["forum_id"]) && isset($_GET["topic_pinned_page"]) && isset($_GET["topic_no_pinned_page"])){
                            require "onglets/topics.php";
                        }
                    }
                    else if($_GET['forum_part'] == "topic"){
                        if(isset($_GET['topic_id'])){
                            $topic_id = $_GET["topic_id"];
                            require "onglets/topic.php";
                        }
                    }
                    else if($_GET['forum_part'] == "new_topic"){
                        require "onglets/new_topic.php";
                    }
                }
                else{
                    require "onglets/forums.php";
                }
                ?>

            </div>
        </section>

        <aside>
            <!-- <div id="reconnection">
            <div class="message">Welcome back </div>
            <div class="message" id="message_user"><p></p></div>
        </div> -->
        </aside>

    </div>

<?php
    require "../footer.php";
?>

</body>
</html>
