<?php

function formatTimeFromLastActivity($time_from_publication){

    if(intval($time_from_publication->format("%m")) >= 1){
      if(intval($time_from_publication->format("%m")) != 1){
        $time_from_publication_str = "about " . intval($time_from_publication->format("%m")) . " months ago..." ;
    }else{
        $time_from_publication_str = "about 1 month ago..." ;
    }
}
else if(intval($time_from_publication->format("%d")) >= 1){
  if(intval($time_from_publication->format("%d")) != 1){
    $time_from_publication_str = "about " . intval($time_from_publication->format("%d")) . " days ago..." ;
}else{
    $time_from_publication_str = "about 1 day ago..." ;
}
}
else if(intval($time_from_publication->format("%h")) >= 1){
  if(intval($time_from_publication->format("%h")) != 1){
    $time_from_publication_str = "about " . intval($time_from_publication->format("%h")) . " hours ago..." ;
}else{
    $time_from_publication_str = "about 1 hour ago..." ;
}
}
else if(intval($time_from_publication->format("%i")) >= 1){
  if(intval($time_from_publication->format("%i")) != 1){
    $time_from_publication_str = "about " . intval($time_from_publication->format("%i")) . " minutes ago..." ;
}else{
    $time_from_publication_str = "about 1 minute ago..." ;
}
}
else if(intval($time_from_publication->format("%s")) >= 1){
  if(intval($time_from_publication->format("%s")) != 1){
    $time_from_publication_str = "about " . intval($time_from_publication->format("%s")) . " seconds ago..." ;
}else{
    $time_from_publication_str = "about 1 second ago..." ;
}
}
return $time_from_publication_str;
}

    // On récupère le nom des forums par catégorie
$forums_language = array();
$forums_system = array();
$forums_software = array();
$forums_forum_functioning = array();

try{
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$qprepare = $bdd->prepare("SELECT name, forum_type FROM forums");
$qprepare->execute();

//On récupère les informations pour chaque forums
while($forum = $qprepare->fetch(PDO::FETCH_ASSOC)){

    $qprepare_2 = $bdd->prepare("SELECT forum_desc, last_active_topic, number_posts, number_topics FROM forums WHERE name=?");
    $qprepare_2->execute(array($forum['name']));

    $forum_information = $qprepare_2->fetch(PDO::FETCH_ASSOC);

    //Si le forum n'est pas vide on recup les informations du dernier topic actif
    if(intval($forum_information['last_active_topic']) != -1){

        $qprepare_3 = $bdd->prepare("SELECT last_activity, topic_title FROM topics WHERE id=?");
        $qprepare_3->execute(array($forum_information['last_active_topic']));

        $last_topic_information = $qprepare_3->fetch(PDO::FETCH_ASSOC);

        $last_active_topic_title = $last_topic_information["topic_title"];

        //Si le titre du topic est trop long on le raccourcis
        if(strlen($last_active_topic_title) > 23){
            $last_active_topic_title = substr($last_active_topic_title, 0, 23) . "...";
        }

        $last_active_topic_title = "<u>" . $last_active_topic_title . "</u>";

        $forum_information['last_active_topic_title'] = $last_active_topic_title;


        $lat_date_last_activity_str = $last_topic_information["last_activity"];
        $lat_date_last_activity = new DateTime($lat_date_last_activity_str);
        $date_now = new DateTime("now");
        $lat_time_from_last_activity = $lat_date_last_activity->diff($date_now);

        $forum_information["lat_time_from_last_activity"] = formatTimeFromLastActivity($lat_time_from_last_activity);
    }
    else{

        $forum_information['last_active_topic_title'] = "No recently post";
        $forum_information['lat_time_from_last_activity'] = "";
    }


    //On met toutes les informations des forums dans des tableaux
    if($forum['forum_type'] == "language"){

        $forums_language[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
        $forums_language[$forum['name']] = "last_active_topic_title" => $forum_information['last_active_topic_title'],
        $forums_language[$forum['name']] = "lat_time_from_last_activity" => $forum_information['lat_time_from_last_activity'],
        $forums_language[$forum['name']] = "number_posts" => $forum_information['number_posts'],
        $forums_language[$forum['name']] = "number_topics" => $forum_information['number_topics']];
    }
    else if($forum["forum_type"] == "system"){

        $forums_system[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
        $forums_system[$forum['name']] = "last_active_topic_title" => $forum_information['last_active_topic_title'],
        $forums_system[$forum['name']] = "lat_time_from_last_activity" => $forum_information['lat_time_from_last_activity'],
        $forums_system[$forum['name']] = "number_posts" => $forum_information['number_posts'],
        $forums_system[$forum['name']] = "number_topics" => $forum_information['number_topics']];
    }
    else if($forum["forum_type"] == "software"){

        $forums_software[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
        $forums_software[$forum['name']] = "last_active_topic_title" => $forum_information['last_active_topic_title'],
        $forums_software[$forum['name']] = "lat_time_from_last_activity" => $forum_information['lat_time_from_last_activity'],
        $forums_software[$forum['name']] = "number_posts" => $forum_information['number_posts'],
        $forums_software[$forum['name']] = "number_topics" => $forum_information['number_topics']];
    }
    else if($forum["forum_type"] == "forum_functioning"){

        $forums_forum_functioning[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
        $forums_forum_functioning[$forum['name']] = "last_active_topic_title" => $forum_information['last_active_topic_title'],
        $forums_forum_functioning[$forum['name']] = "lat_time_from_last_activity" => $forum_information['lat_time_from_last_activity'],
        $forums_forum_functioning[$forum['name']] = "number_posts" => $forum_information['number_posts'],
        $forums_forum_functioning[$forum['name']] = "number_topics" => $forum_information['number_topics']];
    }

        //var_dump($forums_language);

}

?>

<head>
    <link rel="stylesheet" type="text/css" href="/src/forum/onglets_forum/css/forum_forums.css">
</head>

<div id="central_onglet_body">

    <div class="forum_index">
        <h3>You are here :</h3>
        <span class="forum_index_path">Index/Forums</span>
    </div>

    <article>
        <div class="article" id="forums_language">
            <div class="h_forums_desc">
                <h3 class="h_forums_desc_1">Language</h3>
                <h3 class="h_forums_desc_2">Topics/Posts</h3>
                <h3 class="h_forums_desc_3">Last active topic</h3>
            </div>

                <?php
                    foreach($forums_language as $_forum_name => $_forum_information){
                ?>
                <div class="forum_desc">
                    <div class="forum_desc_groupa">
                        <div class="forum_name"><?php echo $_forum_name; ?></div>
                        <div class="forum_small_desc"><?php echo $_forum_information['forum_desc']; ?></div>
                    </div>
                    <div class="forum_desc_groupb">
                        <div class="n_messages_forum"><?php echo ($_forum_information['number_posts'] . " posts"); ?></div>
                        <div class="n_topics_forum"><?php echo ($_forum_information['number_topics'] . " topics"); ?></div>
                    </div>
                    <div class="forum_desc_groupc">
                        <div class="last_message_forum">
                            <div class="message"><?php echo $_forum_information['last_active_topic_title']; ?></div>
                            <div class="date_message"><?php echo $_forum_information['lat_time_from_last_activity']; ?></div>
                        </div>
                    </div>
                </div>

                <?php } ?>

        </div>


        <div class="article" id="forums_system">
            <div class="h_forums_desc">
                <h3 class="h_forums_desc_1">System</h3>
                <h3 class="h_forums_desc_2">Topics/Posts</h3>
                <h3 class="h_forums_desc_3">Last active topic</h3>
            </div>

                <?php
                    foreach($forums_system as $_forum_name => $_forum_information){
                ?>
                <div class="forum_desc">
                    <div class="forum_desc_groupa">
                        <div class="forum_name"><?php echo $_forum_name; ?></div>
                        <div class="forum_small_desc"><?php echo $_forum_information['forum_desc']; ?></div>
                    </div>
                    <div class="forum_desc_groupb">
                        <div class="n_messages_forum"><?php echo ($_forum_information['number_posts'] . " posts"); ?></div>
                        <div class="n_topics_forum"><?php echo ($_forum_information['number_topics'] . " topics"); ?></div>
                    </div>
                    <div class="forum_desc_groupc">
                        <div class="last_message_forum">
                            <div class="message"><?php echo $_forum_information['last_active_topic_title']; ?></div>
                            <div class="date_post"><?php echo $_forum_information['lat_time_from_last_activity']; ?></div>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>


            <div class="article" id="forums_software">
            <div class="h_forums_desc">
                <h3 class="h_forums_desc_1">Software</h3>
                <h3 class="h_forums_desc_2">Topics/Posts</h3>
                <h3 class="h_forums_desc_3">Last active topic</h3>
            </div>

            <?php
                foreach($forums_software as $_forum_name => $_forum_information){
            ?>
            <div class="forum_desc">
                <div class="forum_desc_groupa">
                    <div class="forum_name"><?php echo $_forum_name; ?></div>
                    <div class="forum_small_desc"><?php echo $_forum_information['forum_desc']; ?></div>
                </div>
                <div class="forum_desc_groupb">
                    <div class="n_messages_forum"><?php echo ($_forum_information['number_posts'] . " posts"); ?></div>
                    <div class="n_topics_forum"><?php echo ($_forum_information['number_topics'] . " topics"); ?></div>
                </div>
                <div class="forum_desc_groupc">
                    <div class="last_message_forum">
                        <div class="message"><?php echo $_forum_information['last_active_topic_title']; ?></div>
                        <div class="date_message"><?php echo $_forum_information['lat_time_from_last_activity']; ?></div>
                    </div>
                </div>
            </div>

            <?php } ?>

        </div>

        <div class="article" id="forums_forum_functioning">
            <div class="h_forums_desc">
                <h3 class="h_forums_desc_1">Forum Functioning</h3>
                <h3 class="h_forums_desc_2">Topics/Posts</h3>
                <h3 class="h_forums_desc_3">Last active topic</h3>
            </div>

           <?php
               foreach($forums_forum_functioning as $_forum_name => $_forum_information){
           ?>
           <div class="forum_desc">
               <div class="forum_desc_groupa">
                   <div class="forum_name"><?php echo $_forum_name; ?></div>
                   <div class="forum_small_desc"><?php echo $_forum_information['forum_desc']; ?></div>
               </div>
               <div class="forum_desc_groupb">
                   <div class="n_messages_forum"><?php echo ($_forum_information['number_posts'] . " posts"); ?></div>
                   <div class="n_topics_forum"><?php echo ($_forum_information['number_topics'] . " topics"); ?></div>
               </div>
               <div class="forum_desc_groupc">
                   <div class="last_message_forum">
                        <div class="message"><?php echo $_forum_information['last_active_topic_title']; ?></div>
                        <div class="date_message"><?php echo $_forum_information['lat_time_from_last_activity']; ?></div>
                   </div>
               </div>
           </div>

           <?php } ?>

        </div>
    </article>
</div>
