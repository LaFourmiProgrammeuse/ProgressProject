<?php

    //Ne pas mettre de code html avant cette ligne !
    require '/home/programmpk/www/src/php_for_all/session_control.php';
    include "/home/programmpk/www/src/language/language.php";

    IncrementVisitorCounter();

    if($_SESSION['connected'] == 'false'){
        header ("Location: /home.php");
        exit();
    }

 ?>

 <!DOCTYPE html>
 <html>
 <head>

     <!-- Google Analytics -->
     <?php include "/home/programmpk/www/src/analytic_tools/google_analytics.html"; ?>

     <link rel="stylesheet" type="text/css" href="/src/profile/css/profile.css">
     <meta charset="utf-8">
     <title>Profile ProgAnts</title>

     <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
     <script type="text/javascript" src="/src/profile/javascript/profile.js"></script>
     <script type="text/javascript" src ="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
 </head>

 <body>

     <div class="modal_background" id="modal_drag_and_drop_img">
         <div class="modal_content">
             <h2>Upload your new profile image</h2>
             <p>Click anywhere to close this window</p>

             <form method="post" action="">
                 <div id="drop_zone_profile_img"></div>
                 <input type="file" id="input_img_to_upload" name="image" />
                 <div id="how_to_upload_image"><label for="input_img_to_upload">Choose a file</label> or drag it here !</div>
                 <div class="upload_error">Error</div>
                 <div class="uploading_message">Uploading...</div>
                 <div class="file_wait_upload"></div>
                 <button type="button" class="button_upload">Upload Image</button>
             </form>
         </div>
     </div>

     <div class="modal_background" id="modal_profile_friend">
         <div class="modal_content">
             <h2>Futur profil d'un amis</h2>
         </div>
     </div>

<div id="body_content"> <!-- div permettant a section de prendre toute la place de la page et ainsi au footer d'être placer au bas de la page. -->

<!-- HEADER -->

<?php require "/home/programmpk/www/src/header/header.php"; ?>

<!-- SECTION -->

<h1>Profile</h1>
<a href="/home.php" title="Return to ProgrammingAnts">Return to ProgrammingAnts</a>


         <section>
             <div id="aside_nav">
                 <ul>
                     <li class="nav_element" id="nav_element_overview"><h3>Overview</h3></li>
                     <li class="nav_element" id="nav_element_profile"><h3>Statistics</h3></li>
                     <li class="nav_element" id="nav_element_account"><h3>Account</h3></li>
                     <li class="nav_element" id="nav_element_other"><h3>Other</h3></li>
                     <li class="nav_element" id="nav_element_signout"><img src="/images/sign_out.png" title="Sign Out" /></li>
                 </ul>
             </div>

             <div id="user_informations1">
                 <div id="user_img_frame">
                     <img src="/images/no_user_image.png" id="user_img"/>
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
                     <div class="friend_1">
                         <img class="friend_image" src="/images/no_user_image.png" />
                         <h5 class="friend_name">Amis 1</h5>
                         <a class="friend_profile_link">See more...</a>
                     </div>

                     <div class="friend_2">
                         <img class="friend_image" src="/images/no_user_image.png" />
                         <h5 class="friend_name">Amis 2</h5>
                         <a class="friend_profile_link">See more...</a>
                     </div>

                     <img src="/images/next.jpg" id="next_friend_page"/>
                     <img src="/images/previous.jpg" id="previous_friend_page"/>
                 </div>
             </div>

             <div id="onglet_frame">
                 <img class="ajax_loader" id="onglet_ajax_loader" src="/images/ajax-loader_2.gif" />
             </div>
         </section>

         <?php
         require "/home/programmpk/www/src/footer.php";
         ?>
     </div>
 </body>
 </html>
