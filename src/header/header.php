<?php
    //On replace les '&' par des 'and' pour pouvoir mettre l'ensemble des arguments que reçois la page dans le paramètre redirection_path que recoit les pages login et register
    $current_page_path = str_replace("&", "and", $_SERVER['REQUEST_URI']);
?>

<header>
    <div class="part_1">
    <div id="h_groupa">
        <a href="home.php"><img src="/images/logos/pa.svg" title="Programming Ants' Logo"/></a>
    </div>

    <div id="h_groupb">
        <!-- Menu de navigation +1024px -->
        <div class="h_high_resolution">
            <div class="nav_element nav_element_forum"><a href="/forum.php"><?php echo _("Forum"); ?> </a></div>
            <div class="nav_element nav_element_projects"><a href="#"><?php echo _("Projects"); ?> </a></div>
            <div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
            <div class="nav_element nav_element_contact"><a href="#"><?php echo _("Contact"); ?> </a></div>
        </div>
    </div>

    <div id="h_groupc">
        <div id="h_usera">
            <div class="identification" id="login_button"><a href='<?php echo "/login.php?redirection_path=" . $current_page_path; ?>'> <?php echo _("Log In"); ?> </a></div>
            <div class="identification" id="register_button"><a href='<?php echo "/register.php?redirection_path=" . $current_page_path; ?>'> <?php echo _("Sign Up"); ?> </a></div>
            <div class="identification" id="disconnect_button"><a href='<?php echo "/src/php_for_all/disconnect.php?redirection_path=" . $current_page_path; ?>'> <?php echo _("Log Out"); ?> </a></div>

        </div>

        <img id="small_resolution_menu_icon" src="/images/menu.png" />

        <div id="h_userb">
            <div id="user_image">
                <img src="<?php echo $profile_image_url; ?>" />
            </div>
            <a id="user_username" href="profile.php"> <?php echo $_SESSION['username']; ?> </a>
        </div>
    </div>
    </div>

    <div class="part_2">
    <!-- Menu de navigation -1024px -->
    <div class="h_small_resolution">

        <div class="vertical_menu" id="h_vertical_menu">
            <h3 class="menu_title">--- Menu ---</h3>
            <div class="separator"></div>
            <div class="nav_element nav_element_forum"><a href="/forum.php"><?php echo _("Forum"); ?> </a></div>
            <div class="nav_element nav_element_projects"><a href="#"><?php echo _("Projects"); ?> </a></div>
            <div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
            <div class="nav_element nav_element_contact"><a href="#"><?php echo _("Contact"); ?> </a></div>
            <div class="separator"></div>
        </div>
    </div>
    </div>
</header>
