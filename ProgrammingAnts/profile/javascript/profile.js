var user_information_already_showed = false;

var list_month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

var selected_onglet = 0;

//variable pour l'upload de l'image de profil
var profile_image_uploading = false;
var profile_image_wait_upload = false;
var profile_image_uploaded = false;
var profile_image_type_image_error = false;
var profile_image_size_image_error = false;

var file_name_profile_image = "";
var file_profile_image_url = "";

var username = "";

var list_friend_information = new Array();
var friend_page = 0;



function requestUsersInformation(){

    var information_needed = new Array(4);
    information_needed[0] = "true";
    information_needed[1] = "true";
    information_needed[2] = "true";
    information_needed[3] = "true";

    var information_needed_string = information_needed.join(',');
    alert(information_needed_string);

    $.ajax({
        url: "../../php_for_ajax/get_user_information.php",
        data: {information_needed: information_needed_string, username: username},
        cache: false,
        dataType: "xml",
        type: 'POST',
        error: function(request, error){
            alert("Erreur : "+request.responseText);
        },
        success: function(data){
            showUserInformation(data);
        }
    });
}

function requestUsername(){

    $.ajax({
        url: "../../php_for_ajax/session_control_for_javascript.php",
        dataType: "xml",
        cache: false,
        type: "GET",
        error: function(){
            alert("Erreur lors de la requete ajax pour recuperer le pseudo de l'utilisateur");
        },
        success: function(data){
            username = $(data).find("username").text();

            if(user_information_already_showed == false){
                requestUsersInformation();
                user_information_already_showed = true;
            }
        }
    });
}

function showUserInformation(data){

    var registered_date = $(data).find("registered_date").text();
    showRegisteredDate(registered_date);

    var like_received = $(data).find("like_received").text();
    $("#number_liked_received_value").text((like_received+ " (user's likes)"));

    var number_message_sent = $(data).find("number_message_sent").text();
    $("#number_message_sent_value").text((number_message_sent+" (messages sent)"));

    var last_activity = $(data).find("last_activity").text();
    showTimeLastActivity(last_activity);

    var user_rank = $(data).find("rank").text();
    showUserRank(user_rank);

    var number_friend = $(data).find("number_friend").text();
    $("#number_friend").text(number_friend);

    $("#username h3").text(username);

    var profile_image_name = $(data).find("profile_image_name").text(); alert(profile_image_name);

    if(profile_image_name != ""){
        $("#user_img").attr("src", ("../images/user_image/"+profile_image_name));
    }

    /*console.log($(data).find("friend_profile_image").text());
    console.log($(data).find("friend").text());*/

    var friend_profile_image = $(data).find("friend_profile_image").text();
    var friend = $(data).find("friend").text();

    if(friend != ""){
        var list_friend_profile_image = friend_profile_image.split(",");
        var list_friend_name = friend.split(",");

        for(var i = 0; i < list_friend_name.length; i++){
            list_friend_information[i] = new Array(list_friend_name[i], list_friend_profile_image[i]);
        }

        showFriend();
    }
    else{

    }
}

function showTimeLastActivity(last_activity){

    if(last_activity == '0'){
        $("#last_activity_value").text("no activity...");
    }else{
        $("#last_activity_value").text((last_activity+" secondes"));
    }
}

function showRegisteredDate(registered_date){

    year_string = registered_date.substring(0,4);
    month_string = registered_date.substring(5,7);
    day_string = registered_date.substring(8,10);

    day_number = parseInt(day_string, 10);
    month_number = parseInt(month_string, 10);
    year_number = parseInt(year_string, 10);

    var registered_date_formatted = day_number + ", " + list_month[month_number-1] + " " + year_number;

    $("#registered_date_value").text(registered_date_formatted);
}

function showUserRank(user_rank){

    //Rank fondateur
    if(user_rank == '5'){
        $("#user_rank h3").text("Founder");
    }

    //Rank User lamda
    else if(user_rank == "0"){
        $("#user_rank h3").text("User");
    }
}
function requestProfileImage(){

    var information_needed = new Array(4);
    information_needed[0] = "false";
    information_needed[1] = "false";
    information_needed[2] = "false";
    information_needed[3] = "true";

    var information_needed_string = information_needed.join(',');

    $.ajax({
        url: "../../php_for_ajax/get_user_information.php",
        dataType: "xml",
        cache: false,
        type: "POST",
        data: {information_needed: information_needed_string, username: username},
        success: function(data){ console.log(data);

             var profile_image_name = $(data).find("profile_image_name").text();

             if(profile_image_name != ""){
                 $("#user_img").attr("src", ("../images/user_image/"+profile_image_name));
             }
        },
        error: function(){
            alert("Erreur");
        }
    });
}

function showFriend(){

    $(".friend_1 .friend_name").text(list_friend_information[friend_page*2][0]);
    $(".friend_1 .friend_image").attr("src", ("../../images/user_image/"+list_friend_information[friend_page*2][1]));
    $(".friend_1").attr("display", "block");

    if(list_friend_information.length >= (friend_page*2+1)){

        $(".friend_2 .friend_name").text(list_friend_information[(friend_page*2+1)][0]);
        $(".friend_2 .friend_image").attr("src", ("../../images/user_image/"+list_friend_information[(friend_page*2+1)][1]));
        $(".friend_2").attr("display", "block");
    }
}



    /* WINDOW MODAL PROFILE IMAGE */

var Hdle_Drag_Over_For_Prfile_Img = function(e){

    e.originalEvent.preventDefault();

}

var Hdle_Drag_Drop_For_Prfile_Img = function(event){

    event.originalEvent.preventDefault();
    event.originalEvent.stopPropagation();

    event.dataTransfer = event.originalEvent.dataTransfer;
    file = event.dataTransfer.files[0];

    console.log("Event type : "+event.type);
    console.log("File name : "+event.dataTransfer.files[0].name);



    $("#modal_drag_and_drop_img form").css("width", "479px");
    $("#modal_drag_and_drop_img form").css("height", "209px");
    $("#modal_drag_and_drop_img form").css("top", "51px");
    $("#modal_drag_and_drop_img form").css("border-color", "black");
    $("#modal_drag_and_drop_img form").css("border-size", "2px");

    $("#how_to_upload_image").css("z-index", "1");



    file_name_split = file.name.split(".");
    file_extension = file_name_split[file_name_split.length-1].toLowerCase();
    console.log("Extension : "+file_extension);

    if(!isImage(file_extension)){
        $(".upload_error").text("Only images can be uploaded (.png, .jpg)");
        $(".upload_error").css("display", "block");
        $(".upload_error").slideDown("slow");
        $("#how_to_upload_image").animate({top: "-=18px"});

        profile_image_type_image_error = true;
        profile_image_wait_upload = false;

        return;
    }

    $("#modal_drag_and_drop_img form button").show(500);

    $(".file_wait_upload").text("File Name : "+file.name);
    $(".file_wait_upload").css("display", "block");
    $("#how_to_upload_image").css("display", "none");

    profile_image_wait_upload = true;
    profile_image_type_image_error = false;

    file_name_profile_image = (username+"_profile_image."+file_extension);


    //Partie on l'on upload l'image

    fr = new FileReader();

    fr.onload = function(image_url){
        file_profile_image_url = image_url.target.result;
        console.log(image_url.target.result);
    }

    fr.onerror = function(event_){
        console.log("Erreur lors de la conversion de l'image en Url selon une base 64");
    }

    fr.readAsDataURL(file);

}


var Hdle_Drag_Enter_For_Prfile_Img = function(e){

    e.originalEvent.preventDefault();
    e.originalEvent.stopPropagation();

    if(profile_image_type_image_error == true){

        $("#how_to_upload_image").css("display", "block");
        $("#how_to_upload_image").css("top", "50%");
        $(".upload_error").css("display", "none");

        profile_image_type_image_error = false;
    }
    else if(profile_image_wait_upload == true){

        $("#how_to_upload_image").css("display", "block");
        $("#how_to_upload_image").css("top", "50%");

        $("#modal_drag_and_drop_img form button").css("display", "none");
        $("#modal_drag_and_drop_img form .file_wait_upload").css("display", "none");

        profile_image_wait_upload = false;

    }

    if(profile_image_uploaded == true){

        $(".uploading_message").css("display", "none");
        $(".uploading_message").text("Uploading...");

        $("#how_to_upload_image").css("display", "block");
        $("#how_to_upload_image").css("top", "50%");

        profile_image_uploaded = false;
    }

    $("#modal_drag_and_drop_img form").css("width", "450px");
    $("#modal_drag_and_drop_img form").css("height", "180px");
    $("#modal_drag_and_drop_img form").css("top", "64px");
    $("#modal_drag_and_drop_img form").css("border-color", "rgb(0, 149, 182)");
    $("#modal_drag_and_drop_img form").css("border-size", "8px");

    $("#how_to_upload_image").css("z-index", "-1");

}

var Hdle_Drag_Leave_For_Prfile_Img = function(e){

    console.log("Leave");

    e.originalEvent.preventDefault();

    $("#modal_drag_and_drop_img form").css("width", "479px");
    $("#modal_drag_and_drop_img form").css("height", "209px");
    $("#modal_drag_and_drop_img form").css("top", "51px");
    $("#modal_drag_and_drop_img form").css("border-color", "black");
    $("#modal_drag_and_drop_img form").css("border-size", "2px");

    $("#how_to_upload_image").css("z-index", "1");
}


function isImage(file_extension){

    if(file_extension == "png" || file_extension == "jpg"){
        return true;
    }
    else{
        return false;
    }
}

function close_Modal_Profile_Img(){

    $("#modal_drag_and_drop_img").css("display", "none");
    $(".modal_background").css("display", "none");

    $(".upload_error").css("display", "none");

    if(profile_image_wait_upload == false){
        $("#modal_drag_and_drop_img .button_upload").css("display", "none");
        $(".file_wait_upload").css("display", "none");

    }

    if(profile_image_uploading == false){
        $(".uploading_message").css("display", "none");
        $(".uploading_message").text("Uploading...");

    }

    if(profile_image_uploading == false && profile_image_wait_upload == false){

         $("#how_to_upload_image").css("display", "block");
         $("#how_to_upload_image").css("top", "50%");
    }

}


//Upload l'image de profile sur le serveur et affiche les messages en fonction de l'état de l'upload
function upload_image_url(){

    profile_image_wait_upload = false;
    profile_image_uploading = true;

    $("#modal_drag_and_drop_img .uploading_message").css("display", "block");
    $("#modal_drag_and_drop_img .button_upload").css("display", "none");
    $("#modal_drag_and_drop_img .file_wait_upload").css("display", "none");

    $.ajax({
        url: "/profile/php/upload_profile_image.php",
        type: "POST",
        cache: false,
        data: {image_url: file_profile_image_url, file_name: file_name_profile_image, username: username},
        dataType: "text",
        success: function(data){
            console.log("Image uploaded successfully "+data);

            $("#modal_drag_and_drop_img .uploading_message").text("Profile image successfully uploaded !");

            profile_image_uploaded = true;
            profile_image_uploading = false;

            requestProfileImage();

        },
        error: function(){
            console.log("Error during the image upload");

             $("#modal_drag_and_drop_img .uploading_message").text("Error during the profile image upload !");
        }
    });
}




$(document).ready(function(){

    /* ONGLETS LOADING */

$("#nav_element_overview").click(function(){
    $("#onglet_frame").html('<img class="ajax_loader" id="onglet_ajax_loader" src="../images/ajax-loader_2.gif">');
    $("#onglet_frame").load("../../profile/onglets_profile/profile_overview.html");

});

$("#nav_element_profile").click(function(){
    $("#onglet_frame").html('<img class="ajax_loader" id="onglet_ajax_loader" src="../images/ajax-loader_2.gif">');
    $("#onglet_frame").load("../../profile/onglets_profile/profile_profile.html");
});

$("#nav_element_account").click(function(){
    $("#onglet_frame").html('<img class="ajax_loader" id="onglet_ajax_loader" src="../images/ajax-loader_2.gif">');
    $("#onglet_frame").load("../../profile/onglets_profile/profile_account.html");
});

$("#nav_element_other").click(function(){
    $("#onglet_frame").html('<img class="ajax_loader" id="onglet_ajax_loader" src="../images/ajax-loader_2.gif">');
    $("#onglet_frame").load("../../profile/onglets_profile/profile_other.html");
});


    /* EVENT PROFILE IMAGE */

$("#user_img_frame").click(function(){

    if(!is_File_Api_Supported()){
        alert("The File APIs are not fully supported in this browser");
        return;
    }

    $("#modal_drag_and_drop_img").css("display", "block");
    $(".modal_background").css("display", "block");

    has_window_popup_opened = true;
});


    /* WINDOW MODAL PROFILE IMAGE EVENT */

$(".modal_background").click(function(){

       close_Modal_Profile_Img();

});

$("#modal_drag_and_drop_img").click(function(e){

    e.originalEvent.preventDefault();
    e.originalEvent.stopPropagation();

});

$("#input_img_to_upload").change(function(){

});

$("#drop_zone_profile_img").bind("dragover", Hdle_Drag_Over_For_Prfile_Img);
$("#drop_zone_profile_img").bind("drop", Hdle_Drag_Drop_For_Prfile_Img);
$("#drop_zone_profile_img").bind("dragenter", Hdle_Drag_Enter_For_Prfile_Img);
$("#drop_zone_profile_img").bind("dragleave", Hdle_Drag_Leave_For_Prfile_Img);

    requestUsername();


$("#modal_drag_and_drop_img .button_upload").click(function(){
    upload_image_url();
});




//On charge un onglet au chargement de la page
$("#onglet_frame").load("../../profile/onglets_profile/profile_overview.html");

$("#nav_element_signout").click(function(){

    /*$.ajax({
        url: "/php_for_all/disconnect.php",
        success: function(){
            alert("nice");
        },
        error: function(){
            alert(error);
        }
    });*/
});

});



function is_File_Api_Supported(){

    if(window.File && window.Blob && window.FileReader && window.FileList){
        return true;
    }
    else{
        return false;
    }
}
