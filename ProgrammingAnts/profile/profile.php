<?php

    require "../php_for_all/session_control.php";

    if($_SESSION['connected'] == 'false'){
        header ("Location: ../home/home.php");
    }

 ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" typr="text/css" href="../footer.css">

  <meta charset="utf-8">
  <title>Profile</title>
    <script type="text/javascript" src="../framework_javascript/jquery.js"></script>
   <script type="text/javascript" src="javascript/profile.js"></script>
<script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
</head>

  <body>
    <header>
      <div id="top">
        <h1>Profile</h1>
        <a href="../home/home.php" title="Return to ProgrammingAnts">Return to ProgrammingAnts</a>
      </div>
    </header>

    <div id="main_content"> <!-- div permettant a section de prendre toute la place de la page et ainsi au footer d'être placer au bas de la page. -->
      <section>

        <div id="aside_nav">
          <ul>
            <li class="nav_element" id="nav_element_overview"><h3>Overview</h3></li>
            <li class="nav_element" id="nav_element_profile"><h3>Statistics</h3></li>
            <li class="nav_element" id="nav_element_account"><h3>Account</h3></li>
            <li class="nav_element" id="nav_element_other"><h3>Other</h3></li>
            <li class="nav_element" id="nav_element_signout"><img src="../images/sign_out.png" title="Sign Out" /></li>
          </ul>
        </div>

          <div id="user_informations1">
            <div id="user_img_frame">
              <img src="../images/no_user_image.png" id="user_img"/>
            </div>

                <div id="username" align="center">
                <h3>Pseudo</h3>
                </div>
                <div id="user_rank">
                <h3>Rank</h3>
                </div>

            <div id="user_stats_forum">
              <h4>Your stats</h4>
              <ul>
                <li><h5>Last activity : <span class="stats_forum_value" id="last_activity_value"></span></h5></li>
                <li><h5>Registered the : <span class="stats_forum_value" id="registered_date_value"></span></h5></li>
                <li><h5>Messages : <span class="stats_forum_value" id="number_message_sent_value"></span></h5></li>
                <li><h5>Liked : <span class="stats_forum_value" id="number_liked_received_value"></span></h5></li>
              </ul>
            </div>

            <div id="friends">
                <h4>Your Friends (<span id="number_friend"></span>)</h4>
            </div>
          </div>

          <div id="onglet_frame">
            <img class="ajax_loader" id="onglet_ajax_loader" src="../images/ajax-loader_2.gif" />
          </div>

        </section>
        </div>

            <?php
                require "../footer.php";
            ?>

  </body>
</html>
