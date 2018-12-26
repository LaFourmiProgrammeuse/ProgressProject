<?php

try{
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$topic_id = $_GET['topic_id'];

$list_posts = array();
$list_authors = array();

$n_posts = 0;



//On récupère les posts dans la bdd
$qprepare = $bdd->prepare("SELECT post_index, post_content, post_title, author, date_of_publication, n_like, n_dislike FROM posts WHERE topic=? ORDER BY post_index");
$qprepare->execute(array(intval($topic_id)));

while($qrep = $qprepare->fetch(PDO::FETCH_NAMED)){

	//On formate les données des posts

	$post_index = '#' . ($qrep['post_index']+1);

	//Formatage des dates
	$date_of_publication_ymd = substr($qrep['date_of_publication'], 0, 10);
	$date_of_publication_hms = substr($qrep['date_of_publication'], 11);

	$date_of_publication_ymd = str_replace("-", "/", $date_of_publication_ymd);

	$date_of_publication_hms = substr($date_of_publication_hms, 0, 2) . "h" . explode(":", $date_of_publication_hms)[1];

	$date_of_publication = $date_of_publication_ymd . ", à " . $date_of_publication_hms;

	array_push($list_posts, ['post_index' => $post_index, 'post_content' => $qrep['post_content'], 'author' => $qrep['author'], 'date_of_publication' => $date_of_publication, 'n_like' => $qrep['n_like'], 'n_dislike' => $qrep['n_dislike']]);



	// Si on a pas encore récupérer les données du l'utilsateur qui a écrit ce post on les récupere
	if(!array_search($qrep['author'], $list_authors)){


		//On recupère les données de l'utilisateur
		$qprepare_2 = $bdd->prepare('SELECT like_received, number_message_sent, registered_date, last_activity FROM users WHERE username=?');
		$qprepare_2->execute(array($qrep['author']));

		$qrep_2 = $qprepare_2->fetch(PDO::FETCH_NAMED);

		// On formate les données de l'utilisateurs

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

		$author = ['like_received' => $like_received, 'number_message_sent' => $number_message_sent, 'registered_date' => $qrep_2['registered_date'], 'last_activity' => $last_activity];

		$list_authors[$qrep['author']] = $author;
	}
}

//var_dump($list_posts);
//var_dump($list_authors);
?>

<head>
	<link rel="stylesheet" type="text/css" href="/src/forum/onglets_forum/css/forum_topic.css" />
</head>
<div class="central_onglet_body">

	<article>
		<div class="article">

		<?php 
			foreach($list_posts as $post){
				$author = $list_authors[$post['author']];
		?>
			<div class="post_frame_1">

				<div class="post_header">
					<div class="date_of_publication">
						<?php echo $post['date_of_publication']; ?>
					</div>
					<div class="post_index">
						<?php echo $post['post_index']; ?>
					</div>
				</div>

				<div class="post_frame_2">

					<div class="user_information">

						<h3 class="post_author"> <?php echo $post['author']; ?> </h3>

						<img class="user_img" src="/images/user_image/Default_profile_image.png"/>

						<div class="user_forum_stats">
							<h5>Last activity : <span class="last_activity_value"> <?php echo $author['last_activity']; ?> </span></h5>
							<h5>Registered the : <span class="registered_date_value"> <?php echo $author['registered_date']; ?> </span></h5>
							<h5>Messages : <span class="n_messages_value"> <?php echo $author['number_message_sent']; ?> </span></h5>
							<h5>Liked : <span class="n_likes_value "> <?php echo $author['like_received']; ?> </span></h5>
						</div>
					</div>

					<div class="post_frame_3">

						<div class="post_title">
							<?php echo $post['post_title']; ?>
						</div>

						<div class="separator"></div>

						<div class="post_content">
							<?php echo $post['post_content']; ?>
						</div>

					</div>
				</div>

				<div class="post_footer">

						<div class="reaction">
								<img class="like_button" src="/images/like.png" />
								<span class="n_like"> <?php echo $post['n_like']; ?> </span>
								<img class="dislike_button" src="/images/dislike.png" />
								<span class="n_dislike"> <?php echo $post['n_dislike']; ?> </span>
						</div>
				</div>

			</div>
		<?php } ?>
		</div>
		<div class="article">
			<div id="part_reply">

				<h1>Leave a posts</h1>

				<form id="form_reply" action="/src/forum/php/send_post.php" method="post">
					<div class="form_header">
						<div class="text_formatting">
							<div class="text_style">
								<span class="label">Style</span>
								<img src="/images/arrows/a_down.png" />
							</div>
							<div class="text_size">
								<span class="label">Size</span>
								<img src="/images/arrows/a_down.png" />
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
						<textarea form="form_reply" name="post_content">

						</textarea>
					</div>
					<div class="form_footer">
						<div class="send">
							<input type="button" name="send" value="Send" class="send" />
						</div>
						<input type="text" name="post_topic" value=" <?php echo $_GET['topic_id']; ?> " style="display: none;"></input>
					</div>
				</form>
			</div>
		</div>
	</article>

</div>