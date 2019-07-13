function clickForumDesc(forum){

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

    document.location.href = ("/forum.php?forum_part=forum&forum_id="+forum_id+"&topic_no_pinned_page=1&topic_pinned_page=1");
}

function requestSessionData(){

    $.ajax({
        type: "GET",
        url: "/src/php_for_ajax/session_control_for_javascript.php",
        dataType: "xml",
        success: function(xml){
            readDataSession(xml);
        }
    });

}

function readDataSession(xml_data){

    connected = $(xml_data).find("connected").text();

    if(connected == "true"){

        var session_username = $(xml_data).find("username").text();

        $("#disconnect_button").css("display", "block");

        $(".username").html("<a href='/profile.php'>"+ session_username+"</a>");
        $("#h_userb").css("display", "block");

        if($(xml_data).find("animation_connection").text() == "true"){

            $("#message_user p").text(session_username);

            $("#reconnection").show();
            $("#reconnection").animate({right: '+=210'}, 2000);
            setTimeout(function(){hideMessageConnection()}, 4000);
        }

    }else{

        $("#login_button").css("display", "block");
        $("#register_button").css("display", "block");
    }



    console.log(connected);
    console.log(session_username);

}

$(document).ready(function(){

    $("#account").css("margin-left", "20px");

    //On recupère les données de l'utilisateur si il est connecté
    requestSessionData();

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

});
