<?php

//Ne pas mettre de code html avant cette ligne !
require '/home/programmpk/www/src/php_for_all/session_control.php';
include "/home/programmpk/www/src/language/language.php";

//Debug
ini_set("display_errors", 1);
ini_set('error_log', dirname(__file__) . '/src/log_server.txt');
error_reporting(E_ALL);

IncrementVisitorCounter();

if($_SESSION['connected'] == "true"){

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    $username = $_SESSION['username'];

    $qprepare = $bdd->prepare("SELECT profile_image_name FROM users WHERE username=?");
    $qprepare->execute(array($username));

    $profile_image_name = $qprepare->fetch()["profile_image_name"];
    $profile_image_url = "/images/user_image/" . $profile_image_name;
}

?>

<!DOCTYPE html>
<html>
<head>

    <!-- Google Analytics -->
    <?php include "/home/programmpk/www/src/analytic_tools/google_analytics.html"; ?>

    <link rel="stylesheet" type="text/css" href="/src/home/css/home.css" />
    <link rel="stylesheet" type="text/css" href="/src/footer.css">
    <link rel="stylesheet" type="text/css" href="/src/home/css/home_simple_image_viewer.css" />
    <link rel="stylesheet" type="text/css" href="/src/home/home_header.css" />

    <meta charset="utf-8"/>

    <title><?php echo _("Home");?></title>

    <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="/src/home/javascript/home.js"></script>
    <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>

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

        <!-- HEADER -->
        <?php require "home_header.php"; ?>

        <section id="sec_1">
            <div id="welcome_t">
                <div id="title">
                    <h1>Make programmation easier,<br>learn from your mistakes
                    </h1>
                </div>
                <div id="link">
                    <a href="forum.php">Visit the forum</a>
                </div>
            </div>

            <div id="welcome_i">
                <img src="/images/illustrations/home_i.svg" />
            </div>
        </section>

        <section id="sec_2">
            <div id="inf_box">
                <div class="inf_area">
                    <h3>Solve it ! Visit our wiki to find how to solve your coding errors</h3>
                </div>
                <div class="inf_area">
                    <a id="link_to" href="#" title="A link to Solve it !">Click here for more informations</a>
                </div>
            </div>

            <article>
                <div id="s_groupa">
                    <div class="g_title_prts">
                        <h2>The projects</h2>
                    </div>

                    <div id="s_groupa_con">
                        <div class="a2">
                            <div class="element_title">
                                <h3>Solve it</h3>
                            </div>
                            <div class="element_text">
                                <p>It is our main project on <b>Programming Ants</b>. It's goal is to <b>help programmers</b> to find what is wrong with their code when they
                                    meet <b>errors or bugs</b>. Me and my friend didn't start this project yet, but we've got many ideas to get a nice final result.
                                </p>
                            </div>
                        </div>

                        <div id="s_groupa_smallg">
                            <div class="a1">
                                <div class="element_text">
                                    <p><span class="semi_bold">Programming Ants</span> is a project we started to push our limits in programmation. For the moment, our website is
                                        <span class="semi_bold">very limited in content</span>. Also, we are only <span class="semi_bold">two persons behind this project</span>, and it's difficult to
                                        work fast, mostly when we have to solve <span class="semi_bold">bugs and mistakes</span>. But time passes, and the website is getting built slowly !
                                    </p>
                                </div>
                            </div>

                            <div class="g_title_sprt">
                                <h2>Support us !</h2>
                            </div>

                            <div class="support">
                                <div class="element_text">
                                    <p>You can download our wallpapers and share them to your friends to support us !
                                        <br>
                                        <br>
                                        You can also follow our socials networks as <i>Instagram</i>. We regularly publish things related to the advancement of our website.
                                    </p>
                                    <div class="social_net">
                                        <img src="/images/icons/articles/instagram.png" />
                                        <a href="https://www.instagram.com/programming_ants/">@Programming Ants</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="a2">
                            <div class="element_title">
                                <h3>Forum</h3>
                            </div>
                            <div class="element_text">
                                <p>It is a place to <span class="semi_bold">share your opinion or get some help from the community</span>. This is the first thing we've made after having a working
                                    website and we're pretty proud of it. The design is <span class="semi_bold">not the final one</span>, and there are still <span class="semi_bold">several bugs</span>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="s_groupb">
                    <div class="g_title_wprs">
                        <h2>Wallpapers</h2>
                    </div>

                    <div class="article_wallpapers_pa">
                        <div class="element_text">
                            <div class='widget_simple_image_viewer' id='siv_1'>
                                <div class='widget_body'>
                                    <div class='left_arrow'><img src='/images/arrows/a_left.png' /></div>
                                    <div class='left_image'><img src='' /></div>
                                    <div class='central_image'><img src='' /></div>
                                    <div class='right_image'><img src='' /></div>"
                                    <div class='right_arrow'><img src='/images/arrows/a_right.png' /></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="s_groupc">
                    <div class="g_title_cnct">
                        <h2>Contact</h2>
                    </div>

                    <div class="contact">
                        <div class="element_text">
                            <p>If you want to contact us :
                                <br>
                                <i>Programming Ants</i> contact e-mail adress : <a href="mailto:contact@programming-ants.ovh" title="Contact us !">contact@programming-ants.ovh</a>
                            </p>
                        </div>
                    </div>
                    <a id="secret_link" href="/src/tpe/Accueil/accueil.html">TPE</a>
                </div>
            </article>
        </section>

        <aside>
            <div id="reconnection">
                <div class="message">Welcome back </div>
                <div class="message" id="message_user"><p></p></div>
            </div>
        </aside>

        <!-- FOOTER -->

        <?php
        require "../footer.php";
        ?>

    </div>
</body>
</html>
