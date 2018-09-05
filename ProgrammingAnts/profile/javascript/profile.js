
function requestStatsForum(){

    var information_needed = new Array(1);
    information_needed[0] = "true";
    information_needed[1] = "false";

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
            showForumInformation(data);
        }
    });
}

function showForumInformation(data){

    var registered_date = $(data).find("registered_date").text();
    $("#date_registered_value").text(registered_date);

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

requestStatsForum();

});
