var session_username;
var connected;

function hideMessageConnection(){

    $("#reconnection").animate({right: '-=210'}, 2000);
}

function readDataSession(xml_data){

    connected = $(xml_data).find("connected").text();

    if(connected == "true"){

        session_username = $(xml_data).find("username").text();

        $("#disconnect_button").css("display", "block");

        $(".username").html("<a href='../../profile/profile.php'>"+ session_username+"</a>");
        $("#h_userb").css("display", "block");

        if($(xml_data).find("animation_connection").text() == "true"){

             $("#message_user p").text(session_username);

            $("#reconnection").show();
            $("#reconnection").animate({right: '+=210'}, 2000);
            setTimeout(function(){hideMessageConnection()}, 4000);
        }

    }else{

        $("#login_button").css("display", "block");
        $("#register_button").css("display", "block");
    }

    console.log(connected);
    console.log(session_username);

}

function requestSessionData(){

    $.ajax({
            type: "GET",
            url: "../../php_for_ajax/session_control_for_javascript.php",
            dataType: "xml",
            success: function(xml){
                readDataSession(xml);
            }
    });

}

$(document).ready(function(){

    $("#h_usera").css("order", "2");
    $("#h_userb").css("order", "1");
    $("#account").css("margin-left", "20px");

    requestSessionData();

});
