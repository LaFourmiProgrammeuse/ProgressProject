var session_username;
var connected;

function hideMessageConnection(){

    $("#reconnection").animate({right: '-=210'}, 2000);
}

function readDataSession(xml_data){

    connected = $(xml_data).find("connected").text();

    if(connected == "true"){

        session_username = $(xml_data).find("username").text();

        $("#disconnect_button").css("display", "block");

        $(".username").html("<a href='/src/profile/profile.php'>"+ session_username+"</a>");
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

/*var last_scroll_pos_y = 0;

function window_scrolled(){

    new_scroll_pos_y = document.body.scrollTop;

    if(new_scroll_pos_y > last_scroll_pos_y){
        $("header").css("visibility", "hidden")
    }
    else if(new_scroll_pos_y < last_scroll_pos_y){
        $("header").css("visibility", "visible");
    }

    last_scroll_pos_y = new_scroll_pos_y;
}*/

$(document).ready(function(){

    $("#h_usera").css("order", "2");
    $("#h_userb").css("order", "1");
    $("#account").css("margin-left", "20px");

    //window.onscroll = function() {window_scrolled();};

    requestSessionData();

    //Gestion des clicks sur des boutons menant à des parties du site pas encore commencé
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

    $("#h_groupb .h_small_resolution img").mouseenter(function(){
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
