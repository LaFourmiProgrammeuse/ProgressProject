var session_username;
var connected;

function hideMessageConnection(){

    $("#reconnection").animate({right: '-=200'}, 2000);
}

function readDataSession(xml_data){

    connected = $(xml_data).find("connected").text();

    if(connected == "true"){

        session_username = $(xml_data).find("username").text();

        $(".disconnect").show();

        $(".username").html("<a href='profile/profile.html'>"+ session_username+"</a>");
        $("#user").show();

        if($(xml_data).find("animation_connection").text() == "true"){

             $("#message_user p").text(session_username);

            $("#reconnection").show();
            $("#reconnection").animate({right: '+=200'}, 2000);
            setTimeout(function(){hideMessageConnection()}, 4000);
        }

    }else{

        $(".identification").show();
         $(".disconnect").hide();
    }

    console.log(connected);
    console.log(session_username);

}

function requestSessionData(){

    $.ajax({
            type: "GET",
            url: "../../php_without_view/session_control_for_javascript.php",
            dataType: "xml",
            success: function(xml){
                readDataSession(xml);
            }
    });

}

$(document).ready(function(){

    $(".identification").hide();
    $(".identification disconnect").hide();
    $("#user").hide();
    $("#reconnection").hide();

    $("#users").css("order", "1");
    $("#account").css("order", "2");
    $("#account").css("margin-left", "20px");

    requestSessionData();

});