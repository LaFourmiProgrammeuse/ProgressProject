var session_username = "";
var connected = false;

    /* Variable of the simple image viewer for the wallpaper */
var siv1_index = 0;

//Nom du fichier sur le serveur à télécharger (+sa résolution et son extension) pour chaque image si clické
var siv1_download_content_name = ["pa_official_wallpaper_1", "pa_official_wallpaper_2", "pa_official_wallpaper_3"];
var siv1_download_content_extension = ["jpg", "jpg", "png"];
var siv1_download_content_resolution = ["1920-1080", "1920-1080", "1440-900"];

//Taille minimal de la fenetre pour pouvoir afficher 3 images dans le siv
var siv1_width_for_3_images = 845;

var small_resolution_mode = false;
var small_resolution_menu_opened = false;


    /* CONNECTION MESSAGE */

function hideMessageConnection(){

    $("#reconnection").animate({right: '-=210'}, 2000);
}

    /* SESSION */

function readDataSession(xml_data){

    connected = $(xml_data).find("connected").text();

    if(connected == "true"){
        session_username = $(xml_data).find("username").text();
    }
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

  /* WIDGETS */

//SIV LOADING
function load_siv1(){

  var n_images_to_show;

  screen_width = window.innerWidth;
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
          data: {index: siv1_index, download_content_name: siv1_download_content_name, download_content_extension: siv1_download_content_extension, download_content_resolution: siv1_download_content_resolution,  n_images_to_show: n_images_to_show},
          success: function(html_response){
              $("#siv_1").html(html_response);
              init_siv1_event();
          },
          error: function(error, status, http_status){
            console.log("Error during siv loading : "+status+", "+http_status);
          }
  });

}


//SIV METHODS
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
  siv1_index = siv_previous_index(siv1_index, siv1_download_content_name);
  load_siv1();
}

function siv1_right_arrow_clicked(){
  siv1_index = siv_next_index(siv1_index, siv1_download_content_name);
  load_siv1();
}


//SIV EVENT
function init_siv1_event(){

  $("#siv_1 .left_arrow").click(function(){
    siv1_left_arrow_clicked();
  });
  $("#siv_1 .right_arrow").click(function(){
    siv1_right_arrow_clicked();
  });
}


    /* METHODS ESPECIALLY FOR SMALLS RESOLUTIONS */

function ActivateSmallResolutionMode(){

}

function DesactivateSmallResolutionMode(){

}


//WINDOW EVENT
function window_resized(){

    //On actualise le siv
    load_siv1();

    console.log(window.innerWidth); //DEBUG
}


/* LOADING FONCTION */
$(document).ready(function(){

    // SIV INIT
    load_siv1();
    init_siv1_event();

    window.onresize = window_resized;

    //Pour initialiser certains composant qui s'adapte à la taille de la fenêtre
    window_resized();

    requestSessionData();

});
