$(document).ready(function(){

console.log("dsqd");

$("#nav_element_overview").click(function(){
console.log("zeqdsqdqd");
    $("#onglet_frame").load("../html-php/onglets_profile/profile_overview.html");
});

$("#nav_element_profile").click(function(){
    $("#onglet_frame").load("../html-php/onglets_profile/profile_profile.html");
});

$("#nav_element_account").click(function(){
    $("#onglet_frame").load("../html-php/onglets_profile/profile_account.html");
});

$("#nav_element_other").click(function(){
    $("#onglet_frame").load("../html-php/onglets_profile/profile_other.html");
});

});
