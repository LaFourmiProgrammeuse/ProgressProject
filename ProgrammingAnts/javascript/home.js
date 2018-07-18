var session_username;
var connected;

function readDataSession(xml_data){

    connected = $(xml_data).find("connected").text();

    if(connected == "true"){

        session_username = $(xml_data).find("username").text();

        $(".disconnect").show();

        $(".username").html(session_username);
        $("#user").show();

        if($(xml_data).find("connection_from_register").text() == "false"){
            $("#reconnection").show();
            $("#reconnection").animate({right: '+=200'}, 2000);
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
            url: "../php/session_control_for_javascript.php",
            dataType: "xml",
            success: function(xml){
                readDataSession(xml);
            }
    });

}

function hideMessageConnection(){

}

$(document).ready(function(){

    $(".identification").hide();
    $(".identification disconnect").hide();
    $("#user").hide();
    $("#reconnection").hide();

    requestSessionData();

});
