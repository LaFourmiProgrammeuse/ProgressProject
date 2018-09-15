var user_information_already_showed = false;

var list_month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

var selected_onglet = 0;

var label_how_to_upload_image_over_by_fle = false;

function requestUsersInformation(username){

    var information_needed = new Array(1);
    information_needed[0] = "true";
    information_needed[1] = "true";
    information_needed[2] = "true";

    var information_needed_string = information_needed.join(',');

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
            alert("Error");
        },
        success: function(data){
            username = $(data).find("username").text();

            if(user_information_already_showed == false){
                requestUsersInformation(username);
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


    /* WINDOW MODAL PROFILE IMAGE */

var Hdle_Drag_Over_For_Prfile_Img = function(e){

    e.originalEvent.preventDefault();

}

var Hdle_Drag_Drop_For_Prfile_Img = function(event){

    event.originalEvent.preventDefault();
    event.originalEvent.stopPropagation();

    event.dataTransfer = event.originalEvent.dataTransfer;

    //var files = event.dataTransfer.files[0].fileName;
    console.log("Event type : "+event.type);
    console.log("File name : "+event.dataTransfer.files[0].name);

    $("#modal_drag_and_drop_img form").css("width", "479px");
    $("#modal_drag_and_drop_img form").css("height", "209px");
    $("#modal_drag_and_drop_img form").css("top", "51px");
    $("#modal_drag_and_drop_img form").css("border-color", "black");
    $("#modal_drag_and_drop_img form").css("border-size", "2px");

}

var Hdle_Drag_Enter_For_Prfile_Img = function(e){

    e.originalEvent.preventDefault();

    $("#modal_drag_and_drop_img form").css("width", "450px");
    $("#modal_drag_and_drop_img form").css("height", "180px");
    $("#modal_drag_and_drop_img form").css("top", "64px");
    $("#modal_drag_and_drop_img form").css("border-color", "rgb(0, 149, 182)");
    $("#modal_drag_and_drop_img form").css("border-size", "8px");
}

var Hdle_Drag_Leave_For_Prfile_Img = function(e){

    console.log("Leave");

    e.originalEvent.preventDefault();

    $("#modal_drag_and_drop_img form").css("width", "479px");
    $("#modal_drag_and_drop_img form").css("height", "209px");
    $("#modal_drag_and_drop_img form").css("top", "51px");
    $("#modal_drag_and_drop_img form").css("border-color", "black");
    $("#modal_drag_and_drop_img form").css("border-size", "2px");
}

var Hdle_Drag_Enter_For_Label_How_Upload_Img = function(event){

    console.log("Enter");

    event.preventDefault();

    label_how_to_upload_image_over_by_fle = true;

     $("#modal_drag_and_drop_img form").css("width", "450px");
     $("#modal_drag_and_drop_img form").css("height", "180px");
     $("#modal_drag_and_drop_img form").css("top", "64px");
     $("#modal_drag_and_drop_img form").css("border-color", "rgb(0, 149, 182)");
     $("#modal_drag_and_drop_img form").css("border-size", "8px");

}

var Hdle_Drag_Leave_For_Label_How_Upload_Img = function(event){

    event.preventDefault();

    label_how_to_upload_image_over_by_fle = true;
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

$("#user_img_frame").click(function(){
    $("#modal_drag_and_drop_img").css("display", "block");
    $(".modal_background").css("display", "block");
});

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

    /* PROFILE IMAGE */

$(".modal_background").click(function(){
    $("#modal_drag_and_drop_img").css("display", "none");

    if(!is_File_Api_Supported()){
        alert("The File APIs are not fully supported in this browser");
    }

    $(".modal_background").css("display", "none");
});

    /* WINDOW MODAL PROFILE IMAGE EVENT */

$("#input_img_to_upload").change(function(){
    alert("dfsf");
});

$("#drop_zone_profile_img").bind("dragover", Hdle_Drag_Over_For_Prfile_Img);
$("#drop_zone_profile_img").bind("drop", Hdle_Drag_Drop_For_Prfile_Img);
$("#drop_zone_profile_img").bind("dragenter", Hdle_Drag_Enter_For_Prfile_Img);
$("#drop_zone_profile_img").bind("dragleave", Hdle_Drag_Leave_For_Prfile_Img);

$("#label_how_to_upload_image").bind("dragenter", Hdle_Drag_Enter_For_Label_How_Upload_Img);
$("#label_how_to_upload_image").bind("dragenter", Hdle_Drag_Leave_For_Label_How_Upload_Img);



    requestUsername();
});

function is_File_Api_Supported(){

    if(window.File && window.Blob && window.FileReader && window.FileList){
        return true;
    }
    else{
        return false;
    }
}
