function clickForumDesc(forum){

	console.log("2");
	console.log($(forum).find(".forum_name").text());

	var forum_name = $(forum).find(".forum_name").text();

	$.ajax({
		url: "/src/forum/php/get_forum_id.php",
		cache: false,
		data: {forum_name: forum_name},
		method: "POST",
		success: function(data){
			answerForumIdRequest(data);
		},
		error: function(){
			alert("error");
		}

	});
}

function answerForumIdRequest(forum_id){

	document.location.href = ("/src/forum/forum.php?forum_part=forum&forum_id="+forum_id);
}

$(document).ready(function(){
	
	// CLICK EVENT TOPIC DESC
	$(".topic_desc").click(function(){

		console.log("1");
		console.log($(this).find(".topic_name").text());

		var topic_name = $(this).find(".forum_name").text();

	});

	// CLICK EVENT FORUM DESC
	$(".forum_desc").click(function(){

		clickForumDesc(this);
	});
});