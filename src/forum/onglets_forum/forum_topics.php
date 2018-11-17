<?php
	
	//PART FORUM PART : FORUM (list topics)
    if($_GET['forum_part'] == "forum" && isset($_GET['forum_id'])){

        $forum_name = "";
        $has_topic_pinned = false;
        $has_topic = false;

        $number_topics_per_page = 10;

        $forum_id = $_GET['forum_id'];

        $qprepare = $bdd->prepare("SELECT name, number_topics FROM forums WHERE id=?");
        $qprepare->execute(array($forum_id));

        $qrep = $qprepare->fetch();
        $forum_name = $qrep[0];
        $forum_number_topics = $qrep[1];
    }

    if($forum_number_topics != 0){

        $list_topics = array();
        $list_pinned_topics = array();

        //Recup des informations sur les topics du forum
        $qprepare_2 = $bdd->prepare("SELECT author, post_title, last_activity, pinned, number_posts, number_views FROM topics WHERE forum_id=? ORDER BY last_activity DESC LIMIT 2");
        $qprepare_2->execute(array($forum_id));

        $n = 0;
        while($qrep_2 = $qprepare_2->fetch(PDO::FETCH_NAMED)){

        	if($qrep_2['pinned'] == "0"){
        		$list_topics[$n] = ['post_title' => $qrep_2['post_title'], 'author' => $qrep_2['author'], 'number_posts' => $qrep_2['number_posts'], 'number_views' => $qrep_2['number_views']];
        		$has_topic = true;
            }
            else if($qrep_2['pinned'] == "1"){
            	$list_pinned_topics[$n] = ['post_title' => $qrep_2['post_title'], 'author' => $qrep_2['author'], 'posts' => $qrep_2['number_posts'], 'number_views' => $qrep_2['number_views']];
            	$has_topic_pinned = true;
            }
            $n++;
        }

    }
?>

<head>
	<link rel="stylesheet" type="text/css" href="/src/forum/onglets_forum/css/forum_topics.css">
</head>
<div id="central_onglet_body">

<div class="forum_index">
        <h3>You are here :</h3>
        <span class="forum_index_path">Index/Forums/<?php echo "Forum " . $forum_name ?> </span>
    </div>

	<article>
		<div class="article">
			<div class="h_topics_desc">
                <h3 class="h_topics_desc_1">Topics pinned</h3>
                <h3 class="h_topics_desc_2">Messages/Views</h3>
                <h3 class="h_topics_desc_3">Last message</h3>
            </div>

            <div class="topics_pinned">

            	<?php
            		if($has_topic_pinned == false){ 	
            	?>
            	<div class="no_pinned_topic">
            		No pinned topic
            	</div>
            	<?php
            		}
            		else{
            			foreach($list_pinned_topics as $topic_information){
            	?>
            	<div class="topic_desc">

            		<div class="topic_desc_groupa">
            			<div class="topic_title">
            				<?php echo $topic_information['post_title']; ?>
            			</div>
            			<div class="topic_author">
            				<?php echo "Par <i>" . $topic_information['author'] . "</i>"; ?>
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
            			<div class="topic_last_message">
            				<div class="message">
            					Je suis un message
            				</div>
            				<div class="date_message">
            					18/08/21
            				</div>
            			</div>
            		</div>
            	</div>
            <?php }} ?>
            </div>
        </div>
        <div class="article">
        	<div class="h_topics_desc">
                <h3 class="h_topics_desc_1">Lasted Topics</h3>
                <h3 class="h_topics_desc_2">Messages/Views</h3>
                <h3 class="h_topics_desc_3">Last message</h3>
            </div>

            <div class="topics_lasted">
            	<?php 
            		foreach($list_topics as $topic_information){
            	?>
            	<div class="topic_desc">

            		<div class="topic_desc_groupa">
            			<div class="topic_title">
            				<?php echo $topic_information['post_title']; ?>
            			</div>
            			<div class="topic_author">
            				<?php echo "Par <i>" . $topic_information['author'] . "</i>"; ?>
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
            			<div class="topic_last_message">
            				<div class="message">
            					Je suis un message
            				</div>
            				<div class="date_message">
            					18/08/21
            				</div>
            			</div>
            		</div>
            	</div>
            	<?php } ?>
            </div>
		</div>
	</article>
</div>