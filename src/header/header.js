var session_username = "";
var user_connected = "false";

var small_resolution_mode = false;
var small_resolution_menu_opened = false;


    /* SESSION */

function readDataSession(xml_data){

    console.log(user_connected);

 user_connected = $(xml_data).find("connected").text(); console.log(user_connected);

 if(user_connected == "true"){

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

 console.log(user_connected);
 console.log(session_username);

}

function requestSessionData(){

    $.ajax({
            type: "GET",
            url: "/src/php_for_ajax/session_control_for_javascript.php",
            dataType: "xml",
            success: function(xml){
                readDataSession(xml); console.log(xml);
            },
            error: function(){
                alert("error");
            }
    });

}



    /* METHODS ESPECIALLY FOR SMALLS RESOLUTIONS */

function ActivateSmallResolutionMode(){

    //On déplace les boutons de connection dans le menu déroulant de navigation
    var begin_div_head = "<div class='nav_element nav_element_logs'><div class='small_resolution' id=h_usera>";
    var end_div_head = "</div></div>";

    var new_usera = $(begin_div_head + $("#h_usera").html() + end_div_head); console.log(new_usera);
    $(new_usera).find("#login_button").addClass("small_resolution");
    $(new_usera).find("#login_button").addClass("nav_element_login");
    $(new_usera).find("#register_button").addClass("small_resolution");
    $(new_usera).find("#register_button").addClass("nav_element_register");

    $("#h_usera").remove();
    $("#h_vertical_menu").append(new_usera);
}

function DesactivateSmallResolutionMode(){

    //On remet les boutons de connection à leur place initial dans le header
    var begin_div_usera = "<div id=h_usera>";
    var end_div_usera = "</div>";
    var div_usera_filled = $(begin_div_usera + $(".nav_element_logs").html() + end_div_usera); console.log(div_usera_filled);

     $(div_usera_filled).find("#h_usera").removeClass("small_resolution");
     $(div_usera_filled).find("#login_button").removeClass("small_resolution");
     $(div_usera_filled).find("#login_button").removeClass("nav_element_login");
     $(div_usera_filled).find("#register_button").removeClass("small_resolution");
     $(div_usera_filled).find("#register_button").removeClass("nav_element_register");

    $("#h_usera").remove();
    $("#h_groupc").prepend(div_usera_filled);
}


    /* EVENT */

//WINDOW EVENT
function window_resized(){

    //Si l'utilisateur a une petite résolution, on arrange le code (déplacement et ajout d'attribut) afin d'adapter le site
    if(window.innerWidth < 1024){

        if(small_resolution_mode == false){
            small_resolution_mode = true;
            ActivateSmallResolutionMode();
        }
    }
    else{
        if(small_resolution_mode == true){
            small_resolution_mode = false;
            DesactivateSmallResolutionMode();
        }
    }
}



$(document).ready(function(){

    $("#account").css("margin-left", "20px");

    window.onresize = window_resized;
    window_resized();

    requestSessionData();



        /* VERTICAL MENU FOR SMALL RESOLUTION */

    $("#small_resolution_menu_icon").mouseenter(function(){
        $(".h_small_resolution").css("display", "flex");
        $("#h_vertical_menu").css("display", "flex");
    });

    $("section").mouseenter(function(){
        $(".h_small_resolution").css("display", "none");
        $("#h_small_resolution").css("display", "none");
    });

    $("#h_groupa").mouseenter(function(){
        $(".h_small_resolution").css("display", "none");
        $("#h_vertical_menu").css("display", "none");
    });

    $("#h_groupb").mouseenter(function(){
        $(".h_small_resolution").css("display", "none");
        $("#h_vertical_menu").css("display", "none");
    });

    $(".nav_element").click(function(){
        $(".h_small_resolution").css("display", "none");
        $("#h_vertical_menu").css("display", "none");
    });

});
