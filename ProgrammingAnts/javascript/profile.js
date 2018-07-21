$(document).ready(function(){

console.log("dsqd");

$.ajax({
        type: "GET",
        url: "../html-php/Onglet.html",
        dataType: "xml",
        success: function(xml){
            console.log(xml);
        }
});
});
