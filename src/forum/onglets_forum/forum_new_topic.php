<?php

?>

<head>
	<link rel="stylesheet" type="text/css" href="/src/forum/onglets_forum/css/forum_new_topic.css" />

    <link href="https://fonts.googleapis.com/css?family=Mandali&display=swap" rel="stylesheet">
</head>

<div class="central_onglet_body">

	<article>
        <div class="form_header_frame">
            <h1>Creating a new topic</h1>
        </div>

		<div class="form_frame">
			<form id="form_new_topic" method="post" action="/src/forum/php/create_topic.php">
				<h3>Title</h3>
				<input type="text" name="topic_title" class="topic_title" />
				<h3>Subtitle</h3>
				<input type="text" name="topic_subtitle" class="topic_subtitle" />

                <h3 class="label_message">Your message or question</h3>
				<div class="message_header">
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
					<div class="message_content">
						<textarea form="form_new_topic" name="first_post_content"></textarea>
					</div>
					<div class="message_footer">
						<div class="send">
							<input type="button" name="send" value="Send" class="send" />
						</div>
						<input type="text" name="forum_id" value=" <?php echo $_GET['forum_id']; ?> " style="display: none;"></input>
					</div>
			</form>
            <div class="warning_rules">
                <p>Make sure you have read the rules and respect them. If not, your message will be deleted and you can be banned !</p>
            </div>

		</div>
	</article>
</div>
