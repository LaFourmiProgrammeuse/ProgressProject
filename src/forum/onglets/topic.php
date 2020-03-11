<?php

try{
    $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$topic_id = $_GET['topic_id'];

$list_posts = array();
$list_authors = array();

$n_posts = 0;



//On récupère les posts dans la bdd
$qprepare = $db->prepare("SELECT id, post_index, post_content, post_title, author, date_of_publication, n_like, n_dislike FROM posts WHERE topic=? ORDER BY post_index");
$qprepare->execute(array(intval($topic_id)));

while($qrep = $qprepare->fetch(PDO::FETCH_NAMED)){

	//On formate les données des posts

	$post_index = '#' . ($qrep['post_index']+1);

	//Formatage des dates
	$date_of_publication_ymd = substr($qrep['date_of_publication'], 0, 10);
	$date_of_publication_hms = substr($qrep['date_of_publication'], 11);

	$date_of_publication_ymd = str_replace("-", "/", $date_of_publication_ymd);

	$date_of_publication_hms = substr($date_of_publication_hms, 0, 2) . "h" . explode(":", $date_of_publication_hms)[1];

	$date_of_publication = $date_of_publication_ymd . ", at " . $date_of_publication_hms;

    //On met les données de chaque post dans un tableau
	array_push($list_posts, ['post_id' => $qrep['id'], 'post_index' => $post_index, 'post_content' => $qrep['post_content'], 'author' => $qrep['author'], 'date_of_publication' => $date_of_publication, 'n_like' => $qrep['n_like'], 'n_dislike' => $qrep['n_dislike']]);



	// Si on a pas encore récupérer les données du l'utilsateur qui a écrit ce post on les récupere
	if(!array_search($qrep['author'], $list_authors)){


		//On recupère les données de l'utilisateur
		$qprepare_2 = $db->prepare('SELECT like_received, number_message_sent, registered_date, last_activity, rank FROM users WHERE username=?');
		$qprepare_2->execute(array($qrep['author']));

		$qrep_2 = $qprepare_2->fetch(PDO::FETCH_NAMED);

        $author_rank = $qrep_2['rank'];

		// On formate certaines données de l'utilisateurs
		$user_registered_date = $qrep_2['registered_date'];
		$user_registered_date = new DateTime($user_registered_date);
		$user_registered_date = $user_registered_date->format("F Y");


		$number_message_sent = $qrep_2['number_message_sent'];
		if(intval($number_message_sent) == 1 || intval($number_message_sent) == 0){
			$number_message_sent = intval($qrep_2['number_message_sent']) . " message";
		}
		else{
			$number_message_sent = intval($number_message_sent) . " messages";
		}

		$like_received = $qrep_2['like_received'];
		if(intval($like_received) == 1 || intval($like_received) == 0){
			$like_received = intval($qrep_2['like_received']) . " like";
		}
		else{
			$like_received = intval($like_received) . " likes";
		}

		$last_activity = $qrep_2['last_activity'];
		if($qrep_2['last_activity'] == '-1'){

			$qrep_2['last_activity'] = "no activity...";
		}
		else{

			//On formate la date de derniere activite a partir d'un Timestamp

			if(intval($last_activity) < 60){

				if(intval($last_activity) == 1){
					$last_activity="1 second";
				}
				else if(intval($last_activity) == 0){
					$last_activity="Actif";
				}
				else{
					$last_activity= intval($last_activity) . " seconds";
				}

			}
			else if(intval($last_activity) >= 60 && intval($last_activity) < 3600){

				if(intval($last_activity) == 60){
					$last_activity="1 minute";
				}
				else{
					$last_activity = floor(intval($last_activity)/60) . " minutes";
				}
			}
			else if(intval($last_activity)  >= 3600 && intval($last_activity) < 86400){

				if(intval($last_activity) == 3600){
					$last_activity="1 hour";
				}
				else{
					$last_activity = floor((intval($last_activity)/60)/60) . " hours";
				}
			}
			else if(intval($last_activity)  >= 86400){

				if(intval($last_activity) == 86400){
					$last_activity="1 day";
				}
				else{
					$last_activity = floor(((intval($last_activity)/60)/60)/24) . " days";
				}
			}
		}

        //On récupère le rang principal de l'auteur
        $qprepare = $db->prepare("SELECT rank_name FROM ranks WHERE id=?");
        $qprepare->execute(array($author_rank));

        $author_rank_name = $qprepare->fetch()['rank_name'];

        //On met les données de l'auteur du post dans un tableau
		$author = ['like_received' => $like_received, 'number_message_sent' => $number_message_sent, 'registered_date' => $user_registered_date, 'last_activity' => $last_activity, 'rank_name' => $author_rank_name];

		$list_authors[$qrep['author']] = $author;
	}
}

//On récupère des informations sur le topic
$qprepare_3 = $db->prepare("SELECT number_views, topic_title, topic_subtitle, forum_id FROM topics WHERE id=?");
$qprepare_3->execute(array($topic_id));

$qrep_3 = $qprepare_3->fetch(PDO::FETCH_NAMED);

$topic_title = $qrep_3['topic_title'];
$topic_subtitle = $qrep_3['topic_subtitle'];
$forum_id = $qrep_3['forum_id'];

//On incrémente le compteur de vue dans la base de données pour ce topic
$n_views_topic = intval($qrep_3['number_views'])+1;

$qprepare_4 = $db->prepare("UPDATE topics SET number_views=? WHERE id=?");
$qprepare_4->execute(array($n_views_topic, $topic_id));

//On récupère le nom et la catégorie du forum
$qprepare_5 = $db->prepare("SELECT name, forum_type FROM forums WHERE id=?");
$qprepare_5->execute(array($forum_id));

$qrep_5 = $qprepare_5->fetch(PDO::FETCH_NAMED);
$forum_name = $qrep_5['name'];
$forum_category = strtoupper($qrep_5['forum_type']);

//var_dump($list_posts);
//var_dump($list_authors);
?>

<head>
	<link rel="stylesheet" type="text/css" href="/src/forum/onglets/css/topic.css" />
</head>

<div id="central_onglet_body">

    <?php require "/home/programmpk/www/src/forum/header/header.php"; ?>

  	<article id="posts">

      <!-- En-tête du topic -->
  		<div class="t_inf">
  		  <div class="t_name">
          <h1><?php echo $topic_title; ?></h1>
        </div>
        <div class="t_folow">
            <img src="/images/grey_star.svg" />
        </div>
  		</div>

    		<?php
                //Boucle qui va générer tout les posts
    			foreach($list_posts as $post){
    				$author = $list_authors[$post['author']];
    		?>

      <div class="p_part" id="<?php echo 'post-' . $post['post_id']; ?>">

        <div class="main_frame">
          <div class="left_frame">
    				<div class="user_inf">

    					<h3 class="post_author"> <?php echo $post['author']; ?> </h3>
    					<img class="user_img" src="/images/user_image/Default_profile_image.png"/>

    					<div class="user_forum_stats">
    						<h5>Registered in : <span class="registered_date_value"> <?php echo $author['registered_date']; ?> </span></h5>
    						<h5>Messages : <span class="n_messages_value"> <?php echo $author['number_message_sent']; ?> </span></h5>
    						<h5>Liked : <span class="n_likes_value"> <?php echo $author['like_received']; ?> </span></h5>
    					</div>
    				</div>
          </div>

          <div class="right_frame">
      			<div class="rf_groupa">
              <div class="rank">
                <h3 class="rank">| <?php echo $author['rank_name']; ?> |</h3>
              </div>

      				<div class="d_of_p">
      					<?php echo $post['date_of_publication']; ?>
      				</div>
      			</div>

    			  <div class="rf_groupb">
      				<!-- <div class="post_title">
      					<?php echo $post['post_title']; ?>
      				</div>

      				<div class="separator"></div>-->

      				<div class="post_content">
      					<?php echo $post['post_content']; ?>
      				</div>
    			  </div>
          </div>
        </div>

  			<div class="bottom_frame">

          <div class="post_index"><?php echo $post['post_index']; ?></div>

  				<div class="rating">
            <div class="like">
    					<img class="like_button" src="/images/like.png" />
    					<span class="n_like"> <?php echo $post['n_like']; ?> </span>
            </div>
            <div class="dislike">
    					<img class="dislike_button" src="/images/dislike.png" />
    					<span class="n_dislike"> <?php echo $post['n_dislike']; ?> </span>
            </div>
  				</div>
  			</div>

  		<?php } ?>

    </article>

      <!-- Outil de rédaction de post -->
    <article id="p_editor">
      <div id="p_editor_inf">
  	     <h2>Leave a post</h2>

         <div id="warn_editusage">
           <span class="warn_text">Answering old topics may be subject to sanctions</span>
           <a class="rules_reply" href="#">Learn more...</a>
         </div>

        <?php if($_SESSION["connected"] == "false"){ ?>
         <div id="warn_editusage">
           <span class="warn_text">You have to be connected to answer this topic</span>
           <a class="rules_reply" href="/login.php?redirection_path=<?php echo $current_page_path; ?>">Log In...</a>
         </div>
        <?php } ?>

       </div>

       <form id="form_reply" action="/src/forum/php/send_post.php" method="post">

         <div id="form_header">
           <div class="text_formatting">
             <div class="text_style">
               <span class="label">Style</span>
               <img class="a_down" src="/images/arrows/a_down.png" />
             </div>

             <div class="text_size">
               <span class="label">Size</span>
               <img class="a_down" src="/images/arrows/a_down.png" />
             </div>

             <div class="text_bold">
               B
             </div>

             <div class="text_underline">
               U
             </div>

             <div class="text_italic">
               I
             </div>

             <div class="text_color">

             </div>
           </div>

           <div class="editor_type">
             <h3>
               <span>Editor </span>
                 -
               <span> Markdown</span>
             </h3>
           </div>
         </div>

         <div class="form_content">
           <textarea form="form_reply" name="post_content"></textarea>
         </div>

         <div class="form_footer">
           <div class="send">
             <input type="button" name="send" value="Send" class="send" />
           </div>
           <input type="text" name="post_topic" value=" <?php echo $_GET['topic_id']; ?> " style="display: none;"></input>
         </div>
       </form>
     </article>

</div>
