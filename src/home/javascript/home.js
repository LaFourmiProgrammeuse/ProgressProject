var session_username;
var connected;

    /* Variable of the simple image viewer for the wallpaper */
var siv1_index = 0;

//Liste des images du siv
var siv1_images = ["/content/pa_official_wallpaper_1.jpg", "/content/pa_official_wallpaper_2.jpg", "/content/pa_official_wallpaper_3.png"];

//Nom du fichier sur le serveur à télécharger pour chaque image si clické
var siv1_download_content_name = ["pa_official_wallpaper_1.jpg", "pa_official_wallpaper_2.jpg", "pa_official_wallpaper_3.png"];

var siv1_width_for_3_images = 845;

var small_resolution_mode = false;


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

  // WIDGETS

//SIV init
function load_siv1(){

  var n_images_to_show;

  screen_width = window.innerWidth; //console.log(screen_width);
  if(screen_width >= siv1_width_for_3_images){
    n_images_to_show = 3;
  }
  else{
    n_images_to_show = 1;
  }

  $.ajax({
          method: "POST",
          url: "/src/widgets/simple_image_viewer/simple_image_viewer.php",
          dataType: "html",
          data: {index: siv1_index, images: siv1_images, download_content_name: siv1_download_content_name, n_images_to_show: n_images_to_show},
          success: function(html_response){
              $("#siv_1").html(html_response);
              init_siv1_event();
          },
          error: function(error, status, http_status){
            console.log("Error during siv loading : "+status+", "+http_status);
          }
  });

}

function siv_previous_index(index, images){

  if(index-1 >= 0){
    new_index = index-1;
  }
  else{
    new_index = images.length-1;
  }

  return new_index;
}

function siv_next_index(index, images){

  if(index+1 <= images.length-1){
    new_index = index+1;
  }
  else{
    new_index = 0;
  }

  return new_index;
}

function siv1_left_arrow_clicked(){
  siv1_index = siv_previous_index(siv1_index, siv1_images);
  load_siv1();
}

function siv1_right_arrow_clicked(){
  siv1_index = siv_next_index(siv1_index, siv1_images);
  load_siv1();
}

//SIV event
function init_siv1_event(){

  $("#siv_1 .left_arrow").click(function(){
    siv1_left_arrow_clicked();
  });
  $("#siv_1 .right_arrow").click(function(){
    siv1_right_arrow_clicked();
  });
}



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

    var begin_div_usera = "<div id=h_usera>";
    var end_div_usera = "</div>";
    var div_usera_filled = $(begin_div_usera + $(".nav_element_logs").html() + end_div_usera); console.log(div_usera_filled);

     $(div_usera_filled).find("#login_button").removeClass("small_resolution");
     $(div_usera_filled).find("#login_button").removeClass("nav_element_login");
     $(div_usera_filled).find("#register_button").removeClass("small_resolution");
     $(div_usera_filled).find("#register_button").removeClass("nav_element_register");

    $("#h_usera").remove();
    $("#h_groupc").prepend(div_usera_filled);
}

//Window event
function window_resized(){

  load_siv1();

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

    //console.log(screen.width);

    $("#account").css("margin-left", "20px");

    // wallpaper
    load_siv1();

    requestSessionData();

    window.onresize = window_resized;
    window_resized();

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
