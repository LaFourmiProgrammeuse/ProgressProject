<header>
    <div id="h_groupa">
        <a><img src="/images/logos/pa.svg" title="Programming Ants' Logo"/></a>
    </div>

    <div id="h_groupb">
        <!-- Menu de navigation +1024px -->
        <div class="h_high_resolution">
            <div class="nav_element nav_element_forum"><a href="/forum.php"><?php echo _("Forum"); ?> </a></div>
            <div class="nav_element nav_element_projects"><a href="#"><?php echo _("Projects"); ?> </a></div>
            <div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
            <div class="nav_element nav_element_contact"><a href="#"><?php echo _("Contact"); ?> </a></div>
        </div>

        <!-- Menu de navigation -1024px -->
        <div class="h_small_resolution">
            <img src="/images/menu.png" />

            <div class="vertical_menu" id="h_vertical_menu">
                <div class="nav_element nav_element_forum"><a href="/forum.php"><?php echo _("Forum"); ?> </a></div>
                <div class="nav_element nav_element_projects"><a href="#"><?php echo _("Projects"); ?> </a></div>
                <div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
                <div class="nav_element nav_element_contact"><a href="#"><?php echo _("Contact"); ?> </a></div>
            </div>
        </div>
    </div>

    <div id="h_groupc">
        <div id="h_usera">
            <div class="identification" id="login_button"><a href="/login.php"> <?php echo _("Log In"); ?> </a></div>
            <div class="identification" id="register_button"><a href="/register.php"> <?php echo _("Sign Up"); ?> </a></div>
            <div class="identification" id="disconnect_button"><a href="/src/php_for_all/disconnect.php"> <?php echo _("Log Out"); ?> </a></div>
        </div>

        <div id="h_userb">
            <div id="user_image">
                <img src="<?php  echo $profile_image_url; ?>" />
            </div>
            <a id="user_username" href="profile.php"> <?php echo $_SESSION['username']; ?> </a>
        </div>
    </div>
</header>
