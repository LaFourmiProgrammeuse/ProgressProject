<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/profile.css">
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

      <section>

        <div id="aside_nav">
          <ul>
            <li class="nav_element" id="nav_element_overview"><h3>Overview</h3></li>
            <li class="nav_element" id="nav_element_profile"><h3>Statistics</h3></li>
            <li class="nav_element" id="nav_element_account"><h3>Account</h3></li>
            <li class="nav_element" id="nav_element_other"><h3>Other</h3></li>
            <li class="nav_element" id="nav_element_signout"><h3>Sign out</h3></li>
          </ul>
        </div>

          <div id="user_informations1">
            <div id="user_img_frame">
              <img src="../images/no_user_image.png" id="user_img"/>
            </div>

              <p id="username" align="center">Pseudo</p>

            <div id="user_stats_forum">
              <h4>Your stats</h4>
              <ul>
                <li>Last connection :</li>
                <li>Registered the :</li>
                <li>Messages :</li>
                <li>Liked :</li>
              </ul>
            </div>
          </div>

          <div id="onglet_frame">

          </div>

        </section>

          <footer>

            <?php
                require "../footer.php";
            ?>

          </footer>

  </body>
</html>
