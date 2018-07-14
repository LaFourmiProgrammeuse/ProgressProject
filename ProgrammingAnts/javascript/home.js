var session_nickname;

$(document).ready(function(){

    session_nickname = '<?php echo $_SESSION["identifiant"]; ?>';

    console.log(session_nickname);

$("#message_user p").text("Pseudo");

});
