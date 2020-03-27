<?php
    //On replace les '&' par des 'and' pour pouvoir mettre l'ensemble des arguments que reçois la page dans le paramètre redirection_path que recoit les pages login et register
    $current_page_path = base64_encode($_SERVER['REQUEST_URI']);
?>


<!-- CSS LINKS -->
<link rel="stylesheet" type="text/css" href="/src/header/header.css" />

<!-- SCRIPTS -->
<script type="text/javascript" src="/src/header/header.js"></script>


<header>
    <div class="part_1">
    <div id="hr_groupa">
        <a href="home.php"><img src="/images/logos/pa.svg" title="Programming Ants' Logo"/></a>
    </div>

    <div id="hr_groupb">
        <!-- Menu de navigation +1024px -->
        <div class="hr_high_resolution">
            <div class="nav_element nav_element_forum"><a href="/forum.php"><?php echo _("Forum"); ?> </a></div>
            <div class="nav_element nav_element_contact"><a href="/contact.php"><?php echo _("Contact"); ?> </a></div>
            <div class="nav_element nav_element_devblog"><a href="#"><?php echo _("DevBlog"); ?> </a></div>
            <div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
        </div>
    </div>

    <div id="hr_groupc">
        <div id="hr_usera">
            <div class="identification" id="login_button"><a href='<?php echo "/login.php?redirection_path=" . $current_page_path; ?>'> <?php echo _("Log In"); ?> </a></div>
            <div class="identification" id="register_button"><a href='<?php echo "/register.php?redirection_path=" . $current_page_path; ?>'> <?php echo _("Sign Up"); ?> </a></div>
            <div class="identification" id="disconnect_button"><a href='<?php echo "/src/php_for_all/disconnect.php?redirection_path=" . $current_page_path; ?>'> <?php echo _("Log Out"); ?> </a></div>

        </div>

        <div id="small_resolution_menu_icon"></div>

        <div id="hr_userb">
            <div id="user_image">
                <img src="<?php echo $profile_image_url; ?>" />
            </div>
            <a id="user_username" href="profile.php"> <?php echo $_SESSION['username']; ?> </a>
        </div>
    </div>
    </div>

    <div class="part_2">
    <!-- Menu de navigation -1024px -->
    <div class="hr_small_resolution">

        <div class="hr_vertical_menu" id="hr_vertical_menu">
            <div class="nav_element nav_element_forum"><a href="/forum.php"><?php echo _("Forum"); ?> </a></div>
            <div class="nav_element nav_element_contact"><a href="/contact.php"><?php echo _("Contact"); ?> </a></div>
            <div class="nav_element nav_element_devblog"><a href="#"><?php echo _("DevBlog"); ?> </a></div>
            <div class="nav_element nav_element_about"><a href="#"><?php echo _("About"); ?> </a></div>
            <div class="separator"></div>
        </div>
    </div>
    </div>
</header>

<!-- MODALS -->
<div id="modal_warning_no_content">
    <div class="modal_background">
        <div class="modal_content">
            <img src="/images/warning.png" class="warning_img"/>
            <p>This part of the website has not content yet, folow the progress in our DevBlog</p>
        </div>
    </div>
</div>
