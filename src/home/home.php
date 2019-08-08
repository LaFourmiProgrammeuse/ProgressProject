<?php

/* Résolutions
Very small resolution : inférieur à 580px
Small résolutions : entre 480px à 1024px
Medium résolutions : entre 1025px et 1380px
High résolutions : au dessus de 1381px

Résolution de référence : High resolution (on développe pour les grands écran vu qu'on a de grands écrans et on adpate ensuite le site pour les autres résolutions)
*/

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

    <meta charset="utf-8"/>
    <title><?php echo _("Home");?></title>

    <!-- Google Analytics -->
    <?php include "/home/programmpk/www/src/analytic_tools/google_analytics.html"; ?>

    <!-- CSS LINKS -->
    <link rel="stylesheet" type="text/css" href="/src/home/css/home.css" />
    <link rel="stylesheet" type="text/css" href="/src/home/css/home_simple_image_viewer.css" />

    <!-- SCRIPTS -->
    <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="/src/framework_javascript/ajax.js"></script>
    <script type="text/javascript" src="/src/home/javascript/home.js"></script>
    <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>

</head>

<body>

<div id="body_content"> <!-- Pour que le footer soit placer en bas de la page -->

<!-- HEADER -->

<?php require "/home/programmpk/www/src/header/header.php"; ?>

<!-- Section -->

<section id="sect1">
  <div id="welc">
    <h1 id="title">Make programmation easier,<br>learn from your mistakes</h1>
    <a id="sect1_link" href="forum.php">Visit the forum</a>
  </div>
</section>

<section id="sect2">
  <div id="anchor_nav">
    <div id="tn_groupa">

      <div class="tn_groupa_elem"><a href="#prjts_ancle">Timeline</a></div>
      <div class="tn_groupa_elem"><a href="#sprt_ancle">Support</a></div>
      <div class="tn_groupa_elem"><a href="#wlprs_ancle">Wallpapers</a></div>

    </div>

    <div id="tn_groupb">

      <form action="/search" id="searchthis" method="get">
        <input id="search" name="tn_searchbar" type="text" placeholder="Type here to search" />
        <button type=submit id="search-btn"><img id="search-icn" src=/images/icons/others/search.svg></button>
      </form>

    </div>
  </div>

  <article>
    <div id="h_groupa">
      <h2 class="gtclass" id="prjts_ancle">PROJECTS</h2>

      <div class="a_box">
        <div class="prevw_img">
          <img src="/images/preview_images/pa_image.JPG">
        </div>

        <div class="a_desc">
          <h3 class="mtclass">PA - PROGRAMMING ANTS</h3>

          <p class="smllrclass"><span class="semi_bold">Programming Ants</span> is a project we started to push our limits in programmation. For the moment, our website is
            <span class="semi_bold">very limited in content</span>. Also, we are only <span class="semi_bold">two persons behind this project</span>, and it's difficult to
            work fast, mostly when we have to solve <span class="semi_bold">bugs and mistakes</span>. But time passes, and the website is getting built slowly !
          </p>
        </div>
      </div>

      <div class="a_box">
        <div class="prevw_img">
          <img src="/images/preview_images/forum_image.JPG">
        </div>

        <div class="a_desc">
          <h3 class="mtclass">FORUM</h3>

          <p class="smllrclass">It is a place to <span class="semi_bold">share your opinion or get some help from the community</span>. This is the first thing we've made after having a working
            website and we're pretty proud of it. The design is <span class="semi_bold">not the final one</span>, and there are still <span class="semi_bold">several bugs</span>.
          </p>
        </div>
      </div>

      <div class="a_box">
        <div class="prevw_img">
          <img src="/images/preview_images/solveit_image.JPG">
        </div>

        <div class="a_desc">
          <h3 class="mtclass">SOLVE IT</h3>

          <p class="smllrclass">It is our main project on <b>Programming Ants</b>. It's goal is to <b>help programmers</b> to find what is wrong with their code when they
            meet <b>errors or bugs</b>. Me and my friend didn't start this project yet, but we've got many ideas to get a nice final result.
          </p>
        </div>
      </div>
    </div>

    <div id="h_groupb">
      <h2 class="gtclass" id="sprt_ancle">SUPPORT US</h2>

      <p class="smllrclass_bdless">You can download our wallpapers and share them to your friends to support us !
      <br>
      <br>
        You can also follow our socials networks as <i>Instagram</i>. We regularly publish things related to the advancement of our website.
      </p>

      <div id="social_meds">
        <img id="l_inst" src="/images/icons/articles/instagram.png" />
        <a href="https://www.instagram.com/programming_ants/">@PROG-ANTS</a>
      </div>
    </div>

    <!-- Slider -->

    <div id="h_groupc">
      <h2 class="gtclass" id="wlprs_ancle">WALLPAPERS</h2>

      <div class="article_wallpapers_pa">
        <div class="element_text">
          <div class="widget_simple_image_viewer" id="siv_1">
            <div class="widget_body">
              <div class="left_arrow"><img src="/images/icons/articles/slider/sldr_arw_left.svg" /></div>
              <div class="left_image"><img src="" /></div>
              <div class="central_image"><img src="" /></div>
              <div class="right_image"><img src="" /></div>"
              <div class="right_arrow"><img src="/images/icons/articles/slider/sldr_arw_right.svg" /></div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Aside -->

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
