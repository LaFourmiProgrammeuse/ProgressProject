<?php

    require "/home/programmpk/www/src/php_for_all/session_control.php";

    //On vérifie que l'on récupère toute les informations (pas de champ vide)
    if($_POST['post_content'] == "" || $_POST['post_topic'] == ""){
        header("Location: /forum.php");
        exit();
    }

    $author = $_SESSION['username'];
	$post_content = strip_tags($_POST['post_content']);
	$post_topic = strip_tags($_POST['post_topic']);
	$post_title = ""; //Récupéré ensuite dans la bdd

    $redirection_path_to_this_page = base64_encode(("/forum.php?forum_part=topic&topic_id=" . $post_topic));

    if($_SESSION['connected'] == 'false'){
        header("Location: /login.php?redirection_path=" . $redirection_path_to_this_page);
        exit();
    }


	try{
    	$db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
	}
	catch(Exception $e){
    	die('Erreur : ' . $e->getMessage());
	}

	$qprepare = $db->prepare("SELECT post_index FROM posts WHERE topic=? ORDER BY post_index DESC");
    $qprepare->execute(array($post_topic));

	$qrep = $qprepare->fetch(PDO::FETCH_NAMED);

	$post_index = intval($qrep['post_index'])+1;

	//On insert le post dans la bdd
	$qprepare_2 = $db->prepare("INSERT INTO posts (author, post_content, post_title, post_index, topic) VALUES (?, ?, ?, ?, ?)");
	$qprepare_2->execute(array($author, $post_content, $post_title, $post_index, $post_topic));


	//On met le temps depuis activité du l'user a 0
	$qprepare_3 = $db->prepare("UPDATE users SET last_activity=? WHERE username=?");
	$qprepare_3->execute(array(0, $author));



	//On update les informations du topic
	$qprepare_4 = $db->prepare("SELECT number_posts, forum_id FROM topics WHERE id=?");
	$qprepare_4->execute(array($post_topic));

	$qrep_4 = $qprepare_4->fetch(PDO::FETCH_NAMED);
	$n_posts_topic = intval($qrep_4['number_posts'])+1;

	$forum_id = $qrep_4['forum_id'];

	$qprepare_5 = $db->prepare("UPDATE topics SET number_posts=? WHERE id=?");
	$qprepare_5->execute(array($n_posts_topic, $post_topic));



	//On update les informations du forum
	$qprepare_6 = $db->prepare("SELECT number_posts FROM forums WHERE id=?");
	$qprepare_6->execute(array($forum_id));

	$qrep_6 = $qprepare_6->fetch(PDO::FETCH_NAMED);
	$n_posts_forum = intval($qrep_6['number_posts'])+1;

	$qprepare_7 = $db->prepare("UPDATE forums SET number_posts=?, last_active_topic=? WHERE id=?");
	$qprepare_7->execute(array($n_posts_forum, $post_topic, $forum_id));

	$link_topic = "/src/forum.php?forum_part=topic&topic_id=" . $post_topic;
	header("Location: " . $link_topic);


	//On update les informations de l'utilisateur
	$qprepare_8 = $db->prepare("SELECT number_message_sent FROM users WHERE username=?");
	$qprepare_8->execute(array($author));

	$qrep_8 = $qprepare_8->fetch(PDO::FETCH_NAMED);
	$n_messages_sent = intval($qrep_8['number_message_sent'])+1;

	$qprepare_9 = $db->prepare("UPDATE users SET number_message_sent=? WHERE username=?");
	$qprepare_9->execute(array($n_messages_sent, $author));

?>
