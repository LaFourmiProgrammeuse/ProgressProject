var username;
var user_information_already_showed = false;


function requestUsersInformation(){

    var information_needed = new Array(1);
    information_needed[0] = "true";
    information_needed[1] = "true";

    var information_needed_string = information_needed.join(',');
    alert(information_needed_string);

    $.ajax({
        url: "../../php_for_ajax/get_user_information.php",
        data: {information_needed: information_needed_string, username: "Antoine"},
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
                requestUsersInformation();
                user_information_already_showed = true;
            }
        }
    });
}

function showUserInformation(data){

    var registered_date = $(data).find("registered_date").text();
    $("#registered_date_value").text(registered_date);

    var like_received = $(data).find("like_received").text();
    $("#number_liked_received_value").text((like_received+ " (user's likes)"));

    var number_message_sent = $(data).find("number_message_sent").text();
    $("#number_message_sent_value").text((number_message_sent+" (messages sent)"));

    var last_activity = $(data).find("last_activity").text();
    $("#last_activity_value").text((last_activity+" secondes"));

    var user_rank = $(data).find("rank").text();
    //$("#user_rank h3").text(user_rank);

    $("#username h3").text(username);

    console.log(registered_date);
}

$(document).ready(function(){

$("#nav_element_overview").click(function(){
    $("#onglet_frame").load("../../profile/onglets_profile/profile_overview.html");
});

$("#nav_element_profile").click(function(){
    $("#onglet_frame").load("../../profile/onglets_profile/profile_profile.html");
});

$("#nav_element_account").click(function(){
    $("#onglet_frame").load("../../profile/onglets_profile/profile_account.html");
});

$("#nav_element_other").click(function(){
    $("#onglet_frame").load("../../profile/onglets_profile/profile_other.html");
});
    requestUsername();
});
