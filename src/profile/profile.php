<?php

    //Ne pas mettre de code html avant cette ligne !
    require '/home/programmpk/www/src/php_for_all/session_control.php';
    include "/home/programmpk/www/src/language/language.php";

    IncrementVisitorCounter();

    if($_SESSION['connected'] == 'false'){
        header ("Location: /login.php?redirection_path=/forum.php");
        exit();
    }

if($_GET["view_mode"] == "edit"){
   $view_mode = 1;
}
else{
    $view_mode = 0;
}

$username = $_SESSION["username"];

try{
    //On initialise une connexion avec la bdd
    $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

}catch(Exception $e){
    die('Erreur : ' . $e);

}

$qprepare = $db->prepare("SELECT password, mail, rank, registered_date, last_activity, date_of_birth, biography, contribution_level, contribution_xp FROM users WHERE username=?");
$qprepare->execute(array($username));

$qrep = $qprepare->fetch(PDO::FETCH_NAMED);

//On formate les informations
$l_user_informations["password"] = $qrep["password"];
$l_user_informations["mail"] = $qrep["mail"];

if($qrep["rank"] == "1"){
    $l_user_informations["rank"] = "Founder";
}
else if($qrep["rank"] == "4"){
    $l_user_informations["rank"] = "Member";
}

if($qrep["registered_date"] != ""){

    $registered_date = date_create($qrep["registered_date"]);

    $day = $registered_date->format("j");
    $month = $registered_date->format("F");
    $year = $registered_date->format("Y");

    $registered_date_str = $month . ", " . $day . " of " . $year;
    $l_user_informations["registered_date"] = $registered_date_str;
}
else{
    $l_user_informations["registered_date"] = "";
}

if($qrep["last_activity"] != "0000-00-00"){

    $last_activity_date = date_create($qrep["last_activity"]);
    $now_date = date_create("now");

    $date_diff = $last_activity_date->diff($now_date);

    $second_diff = intval($date_diff->format("%s"));
    $minute_diff = intval($date_diff->format("%i"));
    $hour_diff = intval($date_diff->format("%h"));
    $day_diff = intval($date_diff->format("%d"));
    $month_diff = intval($date_diff->format("%m"));
    $year_diff = intval($date_diff->format("%y"));

    if($year_diff >= 1){
        if($year_diff == 1){
            $l_user_informations["last_activity"] = "1 year ago";
        }
        else{
            $l_user_informations["last_activity"] = $year_diff . " years ago";
        }
    }

    else if($month_diff >= 1){
        if($month_diff == 1){
            $l_user_informations["last_activity"] = "1 month ago";
        }
        else{
            $l_user_informations["last_activity"] = $year_diff . " months ago";
        }
    }

    else if($day_diff >= 1){
        if($day_diff == 1){
            $l_user_informations["last_activity"] = "1 day ago";
        }
        else{
            $l_user_informations["last_activity"] = $day_diff . " days ago";
        }
    }

    else if($hour_diff >= 1){
        if($hour_diff == 1){
            $l_user_informations["last_activity"] = "1 hour ago";
        }
        else{
            $l_user_informations["last_activity"] = $hour_diff . " hours ago";
        }
    }

    else if($minute_diff >= 1){
        if($minute_diff == 1){
            $l_user_informations["last_activity"] = "1 minute ago";
        }
        else{
            $l_user_informations["last_activity"] = $minute_diff . " minutes ago";
        }
    }

    else if($second_diff >= 1){
        if($second_diff == 1){
            $l_user_informations["last_activity"] = "1 second ago";
        }
        else{
            $l_user_informations["last_activity"] = $second_diff . " seconds ago";
        }
    }

}
else{
    $l_user_informations["last_activity"] = "none";
}



if($qrep["date_of_birth"] != ""){

    $date_of_birth = date_create($qrep["date_of_birth"]);

    $day = $date_of_birth->format("j");
    $month = $date_of_birth->format("F");
    $year = $date_of_birth->format("Y");

    $date_of_birth_str = $month . ", " . $day . " of " . $year;
    $l_user_informations["date_of_birth"] = $date_of_birth_str;
}
else{
    $l_user_informations["date_of_birth"] = "";
}

if($l_user_informations["biography"] != ""){
    $l_user_informations["biography"] = $qrep["biography"];
}
else{
    $l_user_informations["biography"] = "No biography...";
}




$l_user_informations["contribution_level"] = $qrep["contribution_level"];

$qprepare_2 = $db->prepare("SELECT xp_min, xp_max, name FROM contribution_levels WHERE id=?");
$qprepare_2->execute(array($l_user_informations["contribution_level"]));

$qrep_2 = $qprepare_2->fetch(PDO::FETCH_NAMED);

$contribution_level_xp_min = $qrep_2["xp_min"];
$contribution_level_xp_max = $qrep_2["xp_max"];
$contribution_level_name = $qrep_2["name"];

$l_user_informations["total_contribution_xp"] = $qrep["contribution_xp"];

$contribution_level_xp = $contribution_level_xp_max - $contribution_level_xp_min;   //Nombre d'xp pour passer ce level
$user_contribution_xp_for_this_level = $l_user_informations["total_contribution_xp"] - $contribution_level_xp_min;

$contribution_level_progression = floor(($user_contribution_xp_for_this_level/$contribution_level_xp)*100);

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

<div id="body_content"> <!-- div permettant a section de prendre toute la place de la page et ainsi au footer d'être placer au bas de la page. -->

<!-- HEADER -->

<?php require "/home/programmpk/www/src/header/header.php"; ?>

<!-- SECTION -->

         <section>
            <div id="central_part">
                <div class="header">
                    <h1>Profile</h1>
                    <div class="link_modify_profile">
                        <a href="/profile.php?view_mode=edit"><i><h3>Modify profile</h3></i></a>
                    </div>
                </div>

                <div class="groupa">
                    <div class="user_img_frame">
                        <img src="/images/no_user_image.png"/>
                    </div>

                    <div class="username" align="center">
                        <h4><?php echo $_SESSION["username"]; ?></h4>
                    </div>

                    <div class="user_rank">
                        <h4><?php echo $l_user_informations["rank"]; ?></h4>
                    </div>

                    <div class="level">
                        <div class="progress_bar_box">
                            <div class="progress_bar" style="<?php echo "width: " . $contribution_level_progression . "%;"; ?>"></div>
                            <div class="progress_percent"><?php echo $contribution_level_progression; ?>%</div>
                            <div class="experience">
                                <p>Experience | <?php echo $l_user_informations["total_contribution_xp"]  . "/" . $contribution_level_xp_max; ?></p>
                            </div>
                        </div>
                        <p class="rank">Level <?php echo $l_user_informations["contribution_level"] . " : " . $contribution_level_name; ?></p>
                    </div>
                </div>

                <div class="groupb">

                    <div class="b_box about">
                        <div class="h_b_box">
                            <h3>About</h3>
                        </div>
                        <div class="body_b_box">

                            <?php if($view_mode == 0){ ?>
                            <div class="biography">
                                <h4><?php echo $l_user_informations["biography"]; ?></h4>
                            </div>
                            <div class="birth_date">
                                <h4>Date of birth : <span class="value"><?php if($l_user_informations["biography"] != "") { echo $l_user_informations["date_of_birth"]; } ?></span></h4>
                            </div>
                            <?php } ?>

                            <?php if($view_mode == 1){ ?>
                            <div class="biography">
                                <textarea></textarea>
                            </div>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="b_box confidentiality">
                        <div class="h_b_box">
                            <h3>Confidentiality</h3>
                        </div>
                        <div class="body_b_box">

                            <?php if($view_mode == 0){ ?>
                            <div class="password">
                                <h4>Password : <input type="password" disabled value="<?php echo $l_user_informations["password"]; ?>" /></h4>
                            </div>
                            <div class="mail">
                                <h4>E-mail adress : <span class="value"><?php echo $l_user_informations["mail"]; ?></span></h4>
                            </div>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="b_box account_informations">
                        <div class="h_b_box">
                            <h3>Account informations</h3>
                        </div>
                        <div class="body_b_box">

                            <?php if($view_mode == 0){ ?>
                            <div class="registration_date">
                                <h4>Registration date : <span class="value"><?php echo $l_user_informations["registered_date"]; ?></span></h4>
                            </div>
                            <div class="last_activity">
                                <h4>Last activity : <span class="value"><?php echo $l_user_informations["last_activity"]; ?></span></h4>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

            </div>




         </section>
     </div>

    <?php require "/home/programmpk/www/src/footer.php"; ?>

 </body>
 </html>
