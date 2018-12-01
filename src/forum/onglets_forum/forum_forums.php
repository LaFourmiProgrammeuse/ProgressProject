<?php

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

    while($forum = $qprepare->fetch(PDO::FETCH_ASSOC)){

        $qprepare_2 = $bdd->prepare("SELECT forum_desc, last_post_id, number_posts, number_topics FROM forums WHERE name=?");
        $qprepare_2->execute(array($forum['name']));

        $forum_information = $qprepare_2->fetch(PDO::FETCH_ASSOC);

        if($forum_information['last_post_id'] != "-1"){

            $qprepare_3 = $bdd->prepare("SELECT post_content, date_of_publication FROM posts WHERE id=?");
            $qprepare_3->execute(array($forum_information['last_post_id']));

            $last_post_information = $qprepare_3->fetch(PDO::FETCH_ASSOC);

            $forum_information['last_post_content'] = $last_post_information["post_content"];
            $forum_information['date_of_publication'] = $last_post_information["date_of_publication"];
        }
        else{

            $forum_information['last_post_content'] = "";
            $forum_information['date_of_publication'] = "";
        }

        if($forum['forum_type'] == "language"){

            $forums_language[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
            $forums_language[$forum['name']] = "last_post_content" => $forum_information['last_post_content'],
            $forums_language[$forum['name']] = "date_of_publication" => $forum_information['date_of_publication'],
            $forums_language[$forum['name']] = "number_posts" => $forum_information['number_posts'],
            $forums_language[$forum['name']] = "number_topics" => $forum_information['number_topics']];
        }
        else if($forum["forum_type"] == "system"){

            $forums_system[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
            $forums_system[$forum['name']] = "last_post_content" => $forum_information['last_post_content'],
            $forums_system[$forum['name']] = "date_of_publication" => $forum_information['date_of_publication'],
            $forums_system[$forum['name']] = "number_posts" => $forum_information['number_posts'],
            $forums_system[$forum['name']] = "number_topics" => $forum_information['number_topics']];
        }
        else if($forum["forum_type"] == "software"){

            $forums_software[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
            $forums_software[$forum['name']] = "last_post_content" => $forum_information['last_post_content'],
            $forums_software[$forum['name']] = "date_of_publication" => $forum_information['date_of_publication'],
            $forums_software[$forum['name']] = "number_posts" => $forum_information['number_posts'],
            $forums_software[$forum['name']] = "number_topics" => $forum_information['number_topics']];
        }
        else if($forum["forum_type"] == "forum_functioning"){

            $forums_forum_functioning[$forum['name']] = ["forum_desc" => $forum_information['forum_desc'],
            $forums_forum_functioning[$forum['name']] = "last_post_content" => $forum_information['last_post_content'],
            $forums_forum_functioning[$forum['name']] = "date_of_publication" => $forum_information['date_of_publication'],
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
                <h3 class="h_forums_desc_3">Last activity</h3>
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

                            <?php
                                if($_forum_information['last_post_content'] == "" && $_forum_information['date_of_publication'] == ""){
                            ?>
                                <div class="message">No recently post</div>
                                <div class="date_message"></div>
                            <?php }else{ ?>
                                <div class="message"><?php echo $_forum_information['last_post_content']; ?></div>
                                <div class="date_message"><?php echo $_forum_information['date_of_publication']; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php } ?>

        </div>


        <div class="article" id="forums_system">
            <div class="h_forums_desc">
                <h3 class="h_forums_desc_1">System</h3>
                <h3 class="h_forums_desc_2">Topics/Posts</h3>
                <h3 class="h_forums_desc_3">Last activity</h3>
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

                            <?php
                                if($_forum_information['last_post_content'] == "" && $_forum_information['date_of_publication'] == ""){
                            ?>
                                <div class="message">No recently post</div>
                            <?php }else{ ?>
                                <div class="message"><?php echo $_forum_information['last_post_content']; ?></div>
                                <div class="date_post"><?php echo $_forum_information['date_of_publication']; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>


            <div class="article" id="forums_software">
            <div class="h_forums_desc">
                <h3 class="h_forums_desc_1">Software</h3>
                <h3 class="h_forums_desc_2">Topics/Posts</h3>
                <h3 class="h_forums_desc_3">Last activity</h3>
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

                        <?php
                            if($_forum_information['last_post_content'] == "" && $_forum_information['date_of_publication'] == ""){
                        ?>
                            <div class="message">No recently post</div>
                            <div class="date_message"></div>
                        <?php }else{ ?>
                            <div class="message"><?php echo $_forum_information['last_post_content']; ?></div>
                            <div class="date_message"><?php echo $_forum_information['date_of_publication']; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php } ?>

        </div>

        <div class="article" id="forums_forum_functioning">
            <div class="h_forums_desc">
                <h3 class="h_forums_desc_1">Forum Functioning</h3>
                <h3 class="h_forums_desc_2">Topics/Posts</h3>
                <h3 class="h_forums_desc_3">Last activity</h3>
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

                       <?php
                           if($_forum_information['last_post_content'] == "" && $_forum_information['date_of_publication'] == ""){
                       ?>
                           <div class="message">No recently post</div>
                           <div class="date_message"></div>
                       <?php }else{ ?>
                           <div class="message"><?php echo $_forum_information['last_post_content']; ?></div>
                           <div class="date_message"><?php echo $_forum_information['date_of_publication']; ?></div>
                       <?php } ?>
                   </div>
               </div>
           </div>

           <?php } ?>

        </div>
    </article>
</div>
