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
        $qprepare_2 = $bdd->prepare("SELECT id, author, topic_title, last_activity, pinned, number_posts, number_views FROM topics WHERE forum_id=? ORDER BY last_activity DESC LIMIT 2");
        $qprepare_2->execute(array($forum_id));

        $n = 0;
        while($qrep_2 = $qprepare_2->fetch(PDO::FETCH_NAMED)){

        	//Recup des informations du dernier post de chaque topic
        	$qprepare_3 = $bdd->prepare("SELECT author, date_of_publication FROM posts WHERE topic=? && post_index=?");
        	$qprepare_3->execute(array($qrep_2['id'], 0));
        	$qrep_3 = $qprepare_3->fetch(PDO::FETCH_NAMED);

        	if($qrep_2['pinned'] == "0"){
        		$list_topics[$n] = ['topic_title' => $qrep_2['topic_title'], 'topic_author' => $qrep_2['author'], 'number_posts' => $qrep_2['number_posts'], 'number_views' => $qrep_2['number_views'], 'last_post_author' => $qrep_3['author'], 'last_post_date' => $qrep_3['date_of_publication']];
        		$has_topic = true;
            }
            else if($qrep_2['pinned'] == "1"){
            	$list_pinned_topics[$n] = ['topic_title' => $qrep_2['topic_title'], 'topic_author' => $qrep_2['author'], 'number_posts' => $qrep_2['number_posts'], 'number_views' => $qrep_2['number_views'], 'last_post_author' => $qrep_3['author'], 'last_post_date' => $qrep_3['date_of_publication']];
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
        <span class="forum_index_path">Index/<a href="/src/forum/forum.php?forum_part=forums">Forums</a>/<?php echo "Forum " . $forum_name ?> </span>
    </div>

	<article>
		<div class="article">
			<div class="h_topics_desc">
                <h3 class="h_topics_desc_1">Topics pinned</h3>
                <h3 class="h_topics_desc_2">Posts/Views</h3>
                <h3 class="h_topics_desc_3">Last Post</h3>
            </div>

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
            	?>
            	<div class="topic_desc">

            		<div class="topic_desc_groupa">
            			<div class="topic_title">
            				<?php echo $topic_information['topic_title']; ?>
            			</div>
            			<div class="topic_author">
            				<?php echo "Par <i>" . $topic_information['topic_author'] . "</i>"; ?>
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
            				<p class="label_post_author">Last post by
            					<span class="post_author">
            						<?php echo $topic_information['last_post_author']; ?>
            					</span>
            				</p>
            				<p class="date_post">
            					<?php echo $topic_information['last_post_date']; ?>
            				</p>
            			</div>
            		</div>
            	</div>
            <?php }} ?>
            </div>
        </div>
        <div class="article">
        	<div class="h_topics_desc">
                <h3 class="h_topics_desc_1">Lasted Topics</h3>
                <h3 class="h_topics_desc_2">Posts/Views</h3>
                <h3 class="h_topics_desc_3">Last Post</h3>
            </div>

            <div class="topics_lasted">
            	<?php
            		if($has_topic != true){
            	?>
            	<div class="no_topic">
            		<p>The forum has no topic</p>
            	</div>
            	<?php
            		}
            		else{
            			foreach($list_topics as $topic_information){
            	?>
            	<div class="topic_desc">

            		<div class="topic_desc_groupa">
            			<div class="topic_title">
            				<?php echo $topic_information['topic_title']; ?>
            			</div>
            			<div class="topic_author">
            				<?php echo "Par <i>" . $topic_information['topic_author'] . "</i>"; ?>
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
            				<p class="label_post_author">Last post by
            					<span class="post_author">
            						<?php echo $topic_information['last_post_author']; ?>
            					</span>
            				</p>
            				<p class="date_post">
            					<?php echo $topic_information['last_post_date']; ?>
            				</p>
            			</div>
            		</div>
            	</div>
            	<?php }} ?>
            </div>
		</div>
	</article>
</div>