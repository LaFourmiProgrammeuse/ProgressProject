<?php
    require "../php_for_all/session_control.php";

    ini_set("display_errors", 1);
    ini_set('error_log', dirname(__file__) . '/src/log_server.txt');

    try{
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
    }
    catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

?>

<!DOCTYPE html>
<html>

    <head>

        <link rel="stylesheet" type="text/css" href="css/forum.css" />
        <link rel="stylesheet" type="text/css" href="../footer.css" />
        <link rel="stylesheet" type="text/css" href="/src/forum/forum_header.css" />

        <meta charset="utf-8" />
        <title>Forum ProgAnts</title>

        <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
        <script type="text/javascript" src="/src/framework_javascript/ajax.js"></script>
        <script type="text/javascript" src="/src/forum/javascript/forum.js" ></script>

    </head>

    <body>

        <div id="modal_warning_no_content">
            <div class="modal_background">
                <div class="modal_content">
                    <img src="/images/warning.png" class="warning_img"/>
                    <p>This part of the website has not content yet, folow the progress in our DevBlog</p>
                </div>
            </div>
        </div>

        <div id="body_content"> <!-- Pour que le footer soit placer en bas de la page -->
         
         <?php require "forum_header.php"; ?>

        <section>
            <div id="top_nav">
                <div class="nav_element"><a href="?forum_part=home"><img src="/images/home.png" onmouseover="this.src='/images/home_hover.png'" onmouseout="this.src='/images/home.png'" /></a></div>
                    <div class="nav_element nav_element_latest"><h3><a href="#">Latest</a></h3></div>
                        <div class="nav_element"><h3><a href="?forum_part=forums">Forums</a></h3></div>
                                <div class="nav_element nav_element_last_activity"><h3><a href="#">Last activity</a></h3></div>
                                    <div class="nav_element nav_element_stats"><h3><a href="#">Stats</a></h3></div>
            </div>

            <div id="forum_content">

                <?php
                    if(isset($_GET['forum_part'])){

                        if($_GET['forum_part'] == "latest"){
                            require "onglets_forum/forum_latest.php";
                        }
                        else if($_GET['forum_part'] == "recent_activity"){
                            require "onglets_forum/forum_recent_activity.php";
                        }
                        else if($_GET['forum_part'] == "stats"){
                            require "onglets_forum/forum_stats.php";
                        }
                        else if($_GET['forum_part'] == "forums"){
                            require "onglets_forum/forum_forums.php";
                        }
                        else if($_GET['forum_part'] == "home"){
                            require "onglets_forum/forum_home.php";
                        }
                        else if($_GET['forum_part'] == "forum"){

                            if(isset($_GET["forum_id"]) && isset($_GET["topic_pinned_page"]) && isset($_GET["topic_no_pinned_page"])){

                                require "onglets_forum/forum_topics.php";
                                
                            }
                        }
                        else if($_GET['forum_part'] == "topic"){

                            if(isset($_GET['topic_id'])){

                                $topic_id = $_GET["topic_id"];
                                require "onglets_forum/forum_topic.php";
                            }
                        }
                    }
                    else{
                        require "onglets_forum/forum_forums.php";
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