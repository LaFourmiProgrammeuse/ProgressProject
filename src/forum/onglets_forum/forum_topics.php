<?php

//PART FORUM PART : FORUM (list topics)
$forum_name = "";
$has_topic_pinned = false;
$has_topic = false;

$topic_pinned_page = $_GET['topic_pinned_page'];
$topic_no_pinned_page = $_GET['topic_no_pinned_page'];

$n_topics_per_page = 2;
$n_pinned_topic_beginner = ($topic_pinned_page-1)*$n_topics_per_page;
$n_no_pinned_topic_beginner = ($topic_no_pinned_page-1)*$n_topics_per_page;

$forum_id = $_GET['forum_id'];

$qprepare = $bdd->prepare("SELECT name, number_topics FROM forums WHERE id=?");
$qprepare->execute(array($forum_id));

$qrep = $qprepare->fetch();
$forum_name = $qrep[0];
$forum_number_topics = $qrep[1];

$list_topics = array();
$list_pinned_topics = array();


    //On cherche la categorie du topic
    $qprepare = $bdd->prepare("SELECT forum_type FROM forums WHERE id=?");
    $qprepare->execute(array($forum_id));

    $forum_category = $qprepare->fetch()[0];
    $forum_category = strtoupper($forum_category);

    //On cherche le nombre de topics de chaque type (épinglé ou non)
    //On commence par chercher le nombre de topic non épinglé


    //Récuperation du nombre de topic épinglé et non épinglé
    $qprepare_6 = $bdd->prepare("SELECT id FROM topics WHERE pinned=0 && forum_id=?");
    $qprepare_6->execute(array($forum_id));

    $qrep_6 = $qprepare_6->fetch();
    $n_of_page_no_pinned_topic = ceil($qprepare_6->rowCount()/$n_topics_per_page);


    $qprepare_7 = $bdd->prepare("SELECT id FROM topics WHERE pinned=1 && forum_id=?");
    $qprepare_7->execute(array($forum_id));

    $qrep_7 = $qprepare_7->fetch();
    $n_of_page_pinned_topic = ceil($qprepare_7->rowCount()/$n_topics_per_page);



    //Recup des informations sur les topics non épinglés du forum
    $qprepare_2 = $bdd->prepare("SELECT id, author, topic_title, last_activity, number_posts, number_views FROM topics WHERE forum_id=? && pinned=0 ORDER BY last_activity DESC LIMIT " . $n_no_pinned_topic_beginner . ", " . $n_topics_per_page);
    $qprepare_2->execute(array($forum_id/*, $n_no_pinned_topic_beginner*//*, $n_topics_per_page*/));

    //Recup des informations sur les topics épinglés du forum
    $qprepare_4 = $bdd->prepare("SELECT id, author, topic_title, last_activity, pinned, number_posts, number_views FROM topics WHERE forum_id=? && pinned=1 ORDER BY last_activity DESC LIMIT " . $n_pinned_topic_beginner . ", " . $n_topics_per_page);
    $qprepare_4->execute(array($forum_id/*, $n_pinned_topic_beginner, $n_topics_per_page*/));





//Recup des informations du dernier post des topics non épinglés
$n = 0;
while($qrep_2 = $qprepare_2->fetch(PDO::FETCH_NAMED)){

    $has_topic = true;

    $qprepare_3 = $bdd->prepare("SELECT author, date_of_publication FROM posts WHERE topic=? ORDER BY date_of_publication DESC LIMIT 1");
    $qprepare_3->execute(array($qrep_2['id']));
    $qrep_3 = $qprepare_3->fetch(PDO::FETCH_NAMED);

    //On déduit le temps écoulé depuis la derniere publication dans le topic
    $date_of_publication_no_formatted = $qrep_3['date_of_publication'];
    $date_of_publication = new DateTime($date_of_publication_no_formatted);
    $date_now = new DateTime("now");
    $time_from_publication = $date_of_publication->diff($date_now);

    //On formate le résultat sous forme de temps écoulé
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

    //On met les informations sur les topics non épinglés dans un tableau
    $list_topics[$n] = ['topic_id' => $qrep_2['id'],'topic_title' => $qrep_2['topic_title'], 'topic_author' => $qrep_2['author'], 'number_posts' => $qrep_2['number_posts'], 'number_views' => $qrep_2['number_views'], 'last_post_author' => $qrep_3['author'], 'last_post_date' => $time_from_publication_str];

    $n++;
}




//Recup des informations du dernier post des topics épinglés
$n = 0;
while($qrep_4 = $qprepare_4->fetch(PDO::FETCH_NAMED)){

    $has_topic_pinned = true;

    $qprepare_5 = $bdd->prepare("SELECT author, date_of_publication FROM posts WHERE topic=? ORDER BY date_of_publication DESC LIMIT 1");
    $qprepare_5->execute(array($qrep_4['id']));
    $qrep_5 = $qprepare_5->fetch(PDO::FETCH_NAMED);


    //On déduit le temps écoulé depuis la derniere publication dans le topic
    $date_of_publication_no_formatted = $qrep_5['date_of_publication'];
    $date_of_publication = new DateTime($date_of_publication_no_formatted);
    $date_now = new DateTime("now");
    $time_from_publication = $date_of_publication->diff($date_now);

    //On formate le résultat sous forme de temps écoulé
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

    //On met les informations sur les topics épinglés misent dans un tableau
    $list_pinned_topics[$n] = ['topic_id' => $qrep_4['id'], 'topic_title' => $qrep_4['topic_title'], 'topic_author' => $qrep_4['author'], 'number_posts' => $qrep_4['number_posts'], 'number_views' => $qrep_4['number_views'], 'last_post_author' => $qrep_5['author'], 'last_post_date' => $time_from_publication_str];

    $n++;
}

?>

<head>
    <link rel="stylesheet" type="text/css" href="/src/forum/onglets_forum/css/forum_topics.css">
</head>

<div id="central_onglet_body">

    <div class="path">
        <span class="index_path">INDEX > <a id="previous_page" href="/forum.php?forum_part=forums">FORUMS</a> > <?php echo $forum_category; ?>> <span id="index_path_smll"> <?php echo $forum_name ?></span></span>
    </div>

    <div id="top_nav">
      <div id="tn_groupa">

        <div class="tn_groupa_elem"><a href="/forum.php?forum_part=forums">Choose a forum</a></div>
        <div class="tn_groupa_elem"><a href="forum_stats.php">Stats</a></div>
        <div class="tn_groupa_elem"><a href="forum_rules.php">Rules</a></div>

      </div>

      <div id="tn_groupb">

        <form action="/search" id="searchthis" method="get">
          <input id="search" name="tn_searchbar" type="text" placeholder="Type here to search" />
          <button type=submit id="search-btn"><img id="search-icn" src=/images/icons/normal/search.svg></button>
        </form>

      </div>
    </div>

    <article>

      <!-- En-tête du forum -->
      <div class="f_inf">
        <div class="f_name">
          <h1><?php echo $forum_name ?></h1>
        </div>
        <div class="create_topic">
          <?php $link = "<a href=forum.php?forum_part=new_topic&forum_id=" . $_GET['forum_id'] . ">Click here to create a new topic</a>"; ?>
          <h3>A question to ask ? <?php echo $link ?></h3>
        </div>
      </div>

      <div class="t_part">

        <!-- Les sujets épinglés -->
        <div class="topics_pinned">
          <?php
            if($has_topic_pinned == false){
          ?>
            <div class="no_pinned_topic">
              <p>No pinned topic</p>
            </div>
            <?php
            }
            else{
              foreach($list_pinned_topics as $topic_information){
                echo "<a class='link_topic_desc' href=/forum.php?forum_part=topic&topic_id=" . $topic_information['topic_id'] . ">";
            ?>
               <div class="topic_desc">
                 <div class="topic_desc_groupa">
                   <div class="topic_title">
                     <?php echo $topic_information['topic_title']; ?>
                   </div>
                   <div class="topic_author">
                     <?php echo "By <i>" . $topic_information['topic_author'] . "</i>"; ?>
                   </div>
                 </div>

                 <div class="topic_desc_groupb">
                   <div class="n_message_topic">
                     <?php echo $topic_information['number_posts'] . " post(s)"; ?>
                   </div>
                   <div class="n_view_topic">
                     <?php echo $topic_information['number_views'] . " view(s)"; ?>
                   </div>
                 </div>

                 <div class="topic_desc_groupc">
                   <div class="topic_last_post">
                     <p class="label_post_author">Last post by</p>
                     <div class="post_author"><?php echo $topic_information['last_post_author']; ?></div>
                     <p class="date_post"><?php echo $topic_information['last_post_date']; ?></p>
                   </div>
                 </div>
               </div>
            <?php
              echo "</a>";
              }}
            ?>
        </div>

        <!-- Les sujets non épinglés -->
        <div class="topics_lasted">
          <?php
            if($has_topic != true){
          ?>
            <div class="no_topic">
              <p>The forum has no topic</p>
              <?php $link = "<a href=forum.php?forum_part=new_topic&forum_id=" . $_GET['forum_id'] . ">click here</a>"; ?>
              <h4>Be the first to ask a question,  <?php echo $link ?></h4>
            </div>
          <?php
            }
            else{
              foreach($list_topics as $topic_information){
                echo "<a class='link_topic_desc' href=/forum.php?forum_part=topic&topic_id=" . $topic_information['topic_id'] . ">";
          ?>

          <div class="topic_desc">
            <div class="topic_desc_groupa">
              <div class="topic_title">
                <?php echo $topic_information['topic_title']; ?>
              </div>
              <div class="topic_author">
                <?php echo "By <span class='spec_ib'>" . $topic_information['topic_author'] . "</span>"; ?>
              </div>
            </div>

            <div class="topic_desc_groupb">
              <div class="n_message_topic">
                <?php echo $topic_information['number_posts'] . " post(s)"; ?>
              </div>
              <div class="n_view_topic">
                <?php echo $topic_information['number_views'] . " view(s)"; ?>
              </div>
            </div>

            <div class="topic_desc_groupc">
              <div class="topic_last_post">
                <p class="label_post_author">Last post by</p>
                <div class="post_author"><?php echo $topic_information['last_post_author']; ?></div>
                <p class="date_post"><?php echo $topic_information['last_post_date']; ?></p>
              </div>
            </div>
          </div>
          <?php
            echo "</a>";
          }}
          ?>
        </div>

        <div id="topic_no_pinned_page" class="topic_page">
          <div class="page_selector">
            <?php
              if($_GET["topic_no_pinned_page"]-1 < 1){
                echo "<a href=forum.php?forum_part=forum" . "&forum_id=" . $_GET["forum_id"] . "&topic_no_pinned_page=" . $n_of_page_no_pinned_topic . "&topic_pinned_page=" . $_GET["topic_pinned_page"] . ">";
              }
              else{
                echo "<a href=forum.php?forum_part=forum" . "&forum_id=" . $_GET["forum_id"] . "&topic_no_pinned_page=" . ($_GET["topic_no_pinned_page"]-1) . "&topic_pinned_page=" . $_GET["topic_pinned_page"] . ">";
              }
            ?>

            <img class="arrow_left" src="/images/arrows/a_left.png" />
              <?php
                echo "</a>";
              ?>

            <div class="pages">
              <?php
                if($n_of_page_no_pinned_topic == 0){
                  echo "<a href=forum.php?forum_part=forum" . "&forum_id=" . $_GET["forum_id"] . "&topic_no_pinned_page=" . 1 . "&topic_pinned_page=" . $_GET["topic_pinned_page"] . ">";
                  echo "1";
                  echo "</a>";
                }
                else{
                  for ($i=0; $i < $n_of_page_no_pinned_topic; $i++) {
                    if($i != 0){
                      echo " - ";
                    }

                    echo "<a href=forum.php?forum_part=forum" . "&forum_id=" . $_GET["forum_id"] . "&topic_no_pinned_page=" . ($i+1) . "&topic_pinned_page=" . $_GET["topic_pinned_page"] . ">";
                    echo $i+1;
                    echo "</a>";
                  }
                }
              ?>
            </div>

            <?php
              if(($_GET["topic_no_pinned_page"]+1) > $n_of_page_no_pinned_topic){
                echo "<a href=forum.php?forum_part=forum" . "&forum_id=" . $_GET["forum_id"] . "&topic_no_pinned_page=" . 1 . "&topic_pinned_page=" . $_GET["topic_pinned_page"] . ">";
              }
              else{
                echo "<a href=forum.php?forum_part=forum" . "&forum_id=" . $_GET["forum_id"] . "&topic_no_pinned_page=" . ($_GET["topic_no_pinned_page"]+1) . "&topic_pinned_page=" . $_GET["topic_pinned_page"] . ">";
              }
            ?>

            <img class="arrow_right" src="/images/arrows/a_right.png" />
              <?php
                echo "</a>";
              ?>
          </div>
        </div>

      </div>

    </article>

</div>
