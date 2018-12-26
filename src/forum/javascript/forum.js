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

	document.location.href = ("/src/forum/forum.php?forum_part=forum&forum_id="+forum_id+"&topic_no_pinned_page=1&topic_pinned_page=1");
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

		/* EVENT POP UP */
		
	$("#modal_warning_no_content .modal_content").click(function(e){
        e.stopPropagation();
    });

    $("#modal_warning_no_content .modal_background").click(function(e){
        $("#modal_warning_no_content").css("display", "none");
    });

    $(".nav_element_latest").click(function(){
    	$("#modal_warning_no_content").css("display", "block");
    });

    $(".nav_element_last_activity").click(function(){
    	$("#modal_warning_no_content").css("display", "block");
    });

    $(".nav_element_stats").click(function(){
    	$("#modal_warning_no_content").css("display", "block");
    });

    $("#form_reply .send").click(function(){
    	$("#form_reply").submit();
    });
});