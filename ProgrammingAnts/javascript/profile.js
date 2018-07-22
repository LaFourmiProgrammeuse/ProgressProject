$(document).ready(function(){

console.log("dsqd");

$("#nav_element_overview").click(function(){
console.log("zeqdsqdqd");
    $("section").load("../html-php/onglets_profile/profile_overview.html");
});

$("#nav_element_profile").click(function(){
    $("section").load("../html-php/onglets_profile/profile_profile.html");
});

});
