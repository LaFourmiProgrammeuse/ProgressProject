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
        <header>
            <div id="h_groupa">
                <div id="h_main_img"><a href="/src/home/home.php"><img src="/images/programming_ants.png" title="ProgrammingAnts Logo"/></a></div>
            </div>

            <div id="h_groupb">
                    <form method="post" action="#" id="form_search">
                        <p>
                            <input type="search" name="search_bar" id="search_bar" placeholder="Type something here..." size="30" maxlength="10">
                            <input type="submit" value="Search" name="search_button" id="search_button">
                        </p>
                    </form>
            </div>

                <div id="h_groupc">
                    <div id="h_usera">
                        <div class="identification" id="login_button"><a href="../login/login_page.php">Log In</a></div>
                        <div class="identification" id="register_button"><a href="../register/register_page.php">Sign Up</a></div>
                        <!-- <div class="identification" id="disconnect_button"><a href="../php_for_all/disconnect.php">Log Out</a></div> -->
                    </div>

                    <!-- <div id="h_userb">
                            <div class="user_image"><img src="/images/no_user_image.png" /></div>
                            <div class="username"><a href="../profile/profile.php"></a></div>
                    </div> -->
                </div>
    </header>

        <section>
            <div id="top_nav">
                <div class="nav_element"><a href="?forum_part=home"><img src="/images/home.png" onmouseover="this.src='/images/home_hover.png'" onmouseout="this.src='/images/home.png'" /></a></div>
                    <div class="nav_element nav_element_latest"><h3><a href="?forum_part=latest">Latest</a></h3></div>
                        <div class="nav_element"><h3><a href="?forum_part=forums">Forums</a></h3></div>
                                <div class="nav_element nav_element_last_activity"><h3><a href="?forum_part=recent_activity">Last activity</a></h3></div>
                                    <div class="nav_element nav_element_stats"><h3><a href="?forum_part=stats">Stats</a></h3></div>
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
                        else if($_GET['forum_part'] == "forum"){ //echo $_GET['forum'];

                            if(isset($_GET["forum_id"])){

                                $forum_id = $_GET["forum_id"];
                                require "onglets_forum/forum_topics.php";
                                
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
