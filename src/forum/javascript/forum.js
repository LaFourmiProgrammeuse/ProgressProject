// *** Les variables sessions javascript sont définis dans le header.js ***

//Redirige vers le forum clické
function clickForumDesc(forum){

    console.log($(forum).find(".forum_name").text());

    var forum_name = $(forum).find(".forum_name").text();

    $.ajax({
        url: "/src/forum/php/get_forum_id.php",
        cache: false,
        data: {forum_name: forum_name},
        method: "POST",
        success: function(data){
            redirectToForumClicked(data);
        },
        error: function(){
            alert("error");
        }

    });
}

function redirectToForumClicked(forum_id){

    document.location.href = ("/forum.php?forum_part=forum&forum_id="+forum_id+"&topic_no_pinned_page=1&topic_pinned_page=1");
}

function getPostIndexFromReactionsButtons(dom){ //A partir

    var post_index = dom.parents(".bottom_frame").find(".post_index").text();
    post_index = post_index.substring(1); //On enlève le # devant l'index

    return post_index;
}

function getPostId(dom){

    var post_id = dom.parents(".p_part").attr("id");
    post_id = post_id.substr(5);

    return post_id;
}

function postLikeButtonPressed(){

    if(user_connected == "false"){
        return;
    }

    //On récupère l'id du post pour l'identifier
    var post_id = getPostId($(this));

    //On envoie les informations néscessaires au serveur gérer l'evênement de l'appuie sur le bouton like
    $.ajax({
        url: "/src/forum/php/reactions.php",
        cache: false,
        method: "POST",
        data: {author: session_username, action_type: "like", object_type: "post", post_id: post_id},
        error: function(){
            console.log("Error: Like");
        },
        success: function(data){
            updateGraphicalsPostReactions(data, post_id);
        }
    });
}

function postDislikeButtonPressed(){

    if(user_connected == "false"){
        return;
    }

    //On récupère l'id du post pour l'identifier
    var post_id = getPostId($(this));

    $.ajax({
        url: "/src/forum/php/reactions.php",
        cache: false,
        method: "POST",
        data: {author: session_username, action_type: "dislike", object_type: "post", post_id: post_id},
        error: function(){
            console.log("Error: Dislike");
        },
        success: function(data){
            updateGraphicalsPostReactions(data, post_id);
        }
    });
}

//Fonction appelée seulement après la réponse du serveur
function updateGraphicalsPostReactions(data, post_id){

    var post_id_str = "post-" + post_id;
    var n_like_display_identifier_path = "#" + post_id_str + " .n_like";
    var n_dislike_display_identifier_path = "#" + post_id_str + " .n_dislike";

    var n_like = $(data).find("n_like").text();
    var n_dislike = $(data).find("n_dislike").text();

    $(n_like_display_identifier_path).text(n_like);
    $(n_dislike_display_identifier_path).text(n_dislike);
}

function topicFolowButtonPressed(){

    if(user_connected == "false"){
        return;
    }

    var topic_id = $_GET("topic_id");

    $.ajax({
        url: "/src/forum/php/reactions.php",
        cache: false,
        method: "POST",
        data: {author: session_username, action_type: "folow", object_type: "topic", topic_id: topic_id},
        error: function(){
            console.log("Error: Folow Topic");
        },
        success: function(data){
            updateTopicFolowButton(data);
        }
    });
}

function updateTopicFolowButton(data){

    var topic_folowed = $(data).find("topic_folowed").text();

    if(topic_folowed == "true"){
        $(".t_folow img").attr("src", "/images/yellow_star.svg");
    }else if(topic_folowed == "false"){
        $(".t_folow img").attr("src", "/images/grey_star.svg");
    }
}

$(document).ready(function(){

    $("#account").css("margin-left", "20px");

    //On recupère les données de l'utilisateur si il est connecté
    //requestSessionData();

    // CLICK EVENT TOPIC DESC
    $(".topic_desc").click(function(){

        console.log($(this).find(".topic_name").text());

        var topic_name = $(this).find(".forum_name").text();
    });

        /* CLICK EVENT FORUM DESCRIPTION */

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



    //Event pour envoyer les formulaires
    $("#form_reply .send").click(function(){
        $("#form_reply").submit();
    });

    $("#form_new_topic .send").click(function(){
        $("#form_new_topic").submit();
    });


        /* MODAL WARNING NO CONTENT */

    $(".nav_element_error_wiki").click(function(){
        $("#modal_warning_no_content").css("display", "block");
    });

    $(".nav_element_projects").click(function(){
        $("#modal_warning_no_content").css("display", "block");
    });

    $(".nav_element_about").click(function(){
        $("#modal_warning_no_content").css("display", "block");
    });

    $(".nav_element_contact").click(function(){
        $("#modal_warning_no_content").css("display", "block");
    });

    $("#modal_warning_no_content .modal_content").click(function(e){
        e.stopPropagation();
    });

    $("#modal_warning_no_content .modal_background").click(function(e){
        $("#modal_warning_no_content").css("display", "none");
    });


        /* VERTICAL MENU FOR SMALL RESOLUTION */

    $(".h_small_resolution img").mouseenter(function(){
        $("#h_vertical_menu").css("display", "flex");
    });

    $("section").mouseenter(function(){
        $("#h_vertical_menu").css("display", "none");
    });

    $("#h_groupa").mouseenter(function(){
        $("#h_vertical_menu").css("display", "none");
    });

    $("#h_groupc").mouseenter(function(){
        $("#h_vertical_menu").css("display", "none");
    });

    $(".nav_element").click(function(){
        $("#h_vertical_menu").css("display", "none");
    });


        /* REACTIONS EVENTS */

    $(".like").click(postLikeButtonPressed);
    $(".dislike").click(postDislikeButtonPressed);

    $(".t_folow").click(topicFolowButtonPressed);

        /* TOOL TIP FOR NEEDED CONNECTION */


});
