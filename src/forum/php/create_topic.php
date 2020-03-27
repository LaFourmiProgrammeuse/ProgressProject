<?php

	require "/home/programmpk/www/src/php_for_all/session_control.php";

    $redirection_path_to_this_page = base64_encode("/forum.php?forum_part=new_topic");

    if($_SESSION['connected'] == "false"){
        header("Location: /login.php?redirection_path=" . $redirection_path_to_this_page);
        exit();
    }

    //On vérifie que l'on récupère toute les informations (pas de champ vide)
    if($_POST['topic_title'] == "" || $_POST['topic_subtitle'] == "" || $_POST['first_post_content'] == "") {
        header("Location: /forum.php");
        exit();
    }

	$topic_title = strip_tags($_POST['topic_title']);
	$topic_subtitle = strip_tags($_POST['topic_subtitle']);
	$first_post_content = strip_tags($_POST['first_post_content']);

	$forum_id = strip_tags($_POST['forum_id']);
	$author = $_SESSION['username'];

	//On crée le topic dans la bdd
	$qprepare = $db->prepare("INSERT INTO topics (topic_title, topic_subtitle, forum_id, author, number_posts) VALUES(?, ?, ?, ?, ?)");
	$qprepare->execute(array($topic_title, $topic_subtitle, $forum_id, $author, 1));

	//On récupère l'id du topic que l'on vient de créer
	$topic_id = $db->lastInsertId();

	//On crée le post dans la bdd qu'on associe a ce topic
	$qprepare_2 = $db->prepare("INSERT INTO posts (topic, post_content, post_index, post_title, author) VALUES(?, ?, ?, ?, ?)");
	$qprepare_2->execute(array($topic_id, $first_post_content, 0, " ", $author));

	//On update les informations du topic
	$qprepare_3 = $db->prepare("SELECT number_topics FROM forums WHERE id=?");
	$qprepare_3->execute(array($forum_id));

	$qrep_3 = $qprepare_3->fetch(PDO::FETCH_NAMED);
	$n_topics = intval($qrep_3['number_topics'])+1;

	$qprepare_4 = $db->prepare("UPDATE forums SET number_topics=? WHERE id=?");
	$qprepare_4->execute(array($n_topics, $forum_id));


	//On update les informations du forum
	$qprepare_5 = $db->prepare("SELECT number_posts FROM forums WHERE id=?");
	$qprepare_5->execute(array($forum_id));

	$qrep_5 = $qprepare_5->fetch(PDO::FETCH_NAMED);
	$n_posts_forum = intval($qrep_5['number_posts'])+1;

	$qprepare_6= $db->prepare("UPDATE forums SET number_posts=?, last_active_topic=? WHERE id=?");
	$qprepare_6->execute(array($n_posts_forum, $topic_id, $forum_id));


	$link_new_topic = "/forum.php?forum_part=topic&topic_id=" . $topic_id;
	header("Location: " . $link_new_topic);

	//On update les informations de l'utilisateur
	$qprepare_7 = $db->prepare("SELECT number_message_sent FROM users WHERE username=?");
	$qprepare_7->execute(array($author));

	$qrep_7 = $qprepare_7->fetch(PDO::FETCH_NAMED);
	$n_messages_sent = intval($qrep_7['number_message_sent'])+1;

	$qprepare_8 = $db->prepare("UPDATE users SET number_message_sent=? WHERE username=?");
	$qprepare_8->execute(array($n_messages_sent, $author));

?>
