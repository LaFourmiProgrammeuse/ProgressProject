
function requestStatsForum(){

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

});
