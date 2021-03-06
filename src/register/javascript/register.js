var special_character = new Array('&', '@', '#', '*', '$');
var number = new Array('1', '2', '3', '4', '5', '6', '7', '8', '9');
var character_alphanumeric = new Array('a', 'b','c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', "Y", 'Z');

var pass_special_character_needed = 0;
var pass_number_needed = 2;
var pass_character_needed = 8;

var nickname_character_needed = 6;
var nickname_character_max = 11;

//For icon clear IE/EDGE
var nickname_old_value = "";
var email_old_value = "";

var xhr = null;
var nickname_use_now = false;
var mail_use_now = false;

var form_already_sent = false;


function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi,
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;
	}
	return vars;
}


        /* AJAX */


function getXmlHttpRequest(){

    if(window.XMLHttpRequest || window.ActiveXObject){

        if(window.ActiveXObject){

            try{
                xhr = new XMLHttpRequest("Msxml12.XMLHTTP");
            }catch(e){
                xhr = new XMLHttpRequest("Microsoft.XMLHTTP");
            }
        }
        else{
            xhr = new XMLHttpRequest();
        }
    }
    else{
        alert("Votre naviguateur ne supporte pas l'objet XMLHttpRequest");
        return null;
    }

    return xhr;

}

function readData(data){

    console.log(data);

    if(data == "true"){

        Show_Nickname_Error(true);

        nickname_use_now = true;
    }
    else{
        Show_Nickname_Error(false);

        nickname_use_now = false;
    }
}

function requestValidationNickname(){

    var nickname = $("#nickname").val();

    console.log("requestValidationNickname : "+nickname);

    if(xhr && xhr.readyState != 0){
        return;
    }

    var xhr = getXmlHttpRequest();

    xhr.onreadystatechange = function(){

    if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){

        readData(xhr.responseText);
    }

    }

    xhr.open("POST", "/src/register/php/verif_name.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("nickname="+nickname);

}


        /* ERROR */


function Show_Nickname_Error(nickname_use_now){

    $("#message_error_password").hide(0);
    $("#message_error_confirmation_password").hide(0);
    $("#message_error_email").hide(0);
    $("#message_error_bad_filled").hide(0);

    if(!NicknameValidation(nickname_use_now) && $("#nickname").val() != ""){

        var error = "The nickname is not valid because :<br/><ul>";

        var nickname_value = $("#nickname").val();
        if(nickname_value.length < nickname_character_needed){
            error = error+"<li>The nickname must be at least 6 characters !</li>";
        }
        else if(nickname_value.length > nickname_character_max){
            error = error+"<li>The nickname must be at max 11 characters !</li>";
        }
        if(!hasSpecialCharacter(nickname_value, 0)){
            error = error+"<li>The nickname can't be composed by special characters !</li>";
        } console.log("Show_Nickname_Error : "+nickname_use_now);

        if(nickname_use_now == true){

            error = error+"<li>The nickname is already used !</li>";
        }

        error = error+"</ul>";

        $("#message_error_nickname p").html(error);

        $("#message_error_nickname").show(0);

    }
    else{

        $("#message_error_nickname").hide(0);

    }
}

function Show_Pass_Error(){

    $("#message_error_nickname").hide(0);
    $("#message_error_confirmation_password").hide(0);
    $("#message_error_email").hide(0);
    $("#message_error_bad_filled").hide(0);

    if(!PassValidation() && $("#pass").val() != ""){

        var error = "The password is not valid because :<br/><ul>";

        var pass_value = $("#pass").val();
        if(pass_value.length < pass_character_needed){
            error = error+"<li>The password must be at least 8 characters !</li>";
        }
        if(!hasSpecialCharacter(pass_value, pass_special_character_needed)){
            error = error+"<li>The password must be at least 2 specials characters ! (as : &, @, #, *, $)</li>";
        }

        error = error+"</ul>";

        $("#message_error_password p").html(error);

        $("#message_error_password").show(0);

    }
    else{

        $("#message_error_password").hide(0);
    }
}

function Show_Pass_Confirm_Error(){

    $("#message_error_nickname").hide(0);
    $("#message_error_password").hide(0);
    $("#message_error_email").hide(0);
    $("#message_error_bad_filled").hide(0);

    if(!PassConfirmValidation() && $("#pass_confirm").val() != ""){

        var error = "The confirmation password is not valid because :<br/><ul>";

        var confirmation_password_value = $("#pass_confirm").val();
        if($("#pass").val() != confirmation_password_value){
            error = error+"<li>The confirmation password does not match the password !</li>";
        }

        error = error+"</ul>";

        $("#message_error_confirmation_password p").html(error);

        $("#message_error_confirmation_password").show(0);

    }
    else{

        $("#message_error_confirmation_password").hide(0);

    }
}

function Show_Email_Error(){

    $("#message_error_nickname").hide(0);
    $("#message_error_confirmation_password").hide(0);
    $("#message_error_password").hide(0);
    $("#message_error_bad_filled").hide(0);

    if(!EmailValidation() && $("#email").val() != ""){

        var error = "The email is not valid because :<br/><ul>";

        if(mail_use_now == false){
            error+="<li>The format of the email is incorrect !</li>";
        }

        $("#message_error_email p").html(error);

        $("#message_error_email").show(0);

    }
    else{

        $("#message_error_email").hide(0);
    }
}


        /* UTILS */


function hasSpecialCharacter(string, number_special_character_to_found){

    var special_character_found = 0;

    if(number_special_character_to_found == 0){
      return true;
    }

    for(var i = 0; i < string.length; i++){

        for(var e = 0; e < special_character.length; e++){

            if(string[i] == special_character[e]){

                special_character_found++;

                if(special_character_found == number_special_character_to_found){


                     return true;
                }
                else{
                    break;
                }
            }
        }
    }

    return false;
}

function hasNumber(string, number_to_found){

    var number_found = 0;

    if(number_to_found == 0){
      return true;
    }

    for(var i = 0; i < string.length; i++){

        for(var e = 0; e < number.length; e++){

            if(string[i] == number[e]){

                number_found++;

                if(number_found == number_to_found){
                    return true;
                }
                else{
                    break;
                }
            }
        }
    }

    return false;
}

function isValidMail(mail){

    var reg_exp = new RegExp("^(([^<>()[]\\.,;:s@]+(.[^<>()[]\\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$");

    return reg_exp.test(mail);
}



    /* VALIDATION */


function PassValidation(){

    var pass_value = $("#pass").val();

    if(pass_value.length == 0){

        console.log("1");
        $("#validation_pass").css("visibility", "hidden");

        return false;

    }
    else if(pass_value.length < pass_character_needed || !hasSpecialCharacter(pass_value, pass_special_character_needed)){

        console.log("2");
        $("#validation_pass").attr("src", "/images/wrong.png");
        $("#validation_pass").css("visibility", "visible");

        return false;

    }
    else{

        console.log("3");
        $("#validation_pass").attr("src", "/images/check.png");
        $("#validation_pass").css("visibility", "visible");

        return true;

    }
}

function NicknameValidation(nickname_use){

    var nickname_value = $("#nickname").val();

    if(nickname_value.length == 0){

        console.log("1");
        $("#validation_nickname").css("visibility", "hidden");

        return false;

    }
    else if(nickname_value.length < nickname_character_needed || !hasSpecialCharacter(nickname_value, 0) || nickname_value.length > nickname_character_max || nickname_use == true){

        console.log("2");
        $("#validation_nickname").attr("src", "/images/wrong.png");
        $("#validation_nickname").css("visibility", "visible");

        return false;

    }
    else{

        console.log("3");
        $("#validation_nickname").attr("src", "/images/check.png");
        $("#validation_nickname").css("visibility", "visible");

        return true;

    }
}

function PassConfirmValidation(){

    var pass_confirm_value = $("#pass_confirm").val();
    var pass_value = $("#pass").val();

    if(pass_confirm_value.length == 0){

        console.log("1");
        $("#validation_pass_confirm").css("visibility", "hidden");

        return false;

    }
    else if(pass_confirm_value != pass_value){

        console.log("2");
        $("#validation_pass_confirm").attr("src", "/images/wrong.png");
        $("#validation_pass_confirm").css("visibility", "visible");

        return false;

    }
    else{

        console.log("3");
        $("#validation_pass_confirm").attr("src", "/images/check.png");
        $("#validation_pass_confirm").css("visibility", "visible");

        return true;

    }
}

function EmailValidation(){

    var email_value = $("#email").val();

    if(email_value.length == 0){

        $("#validation_email").css("visibility", "hidden");

        return false;

    }
    else if(!isValidMail(email_value)){

        $("#validation_email").attr("src", "/images/wrong.png");
        $("#validation_email").css("visibility", "visible");

        return false;

    }
    else{

        $("#validation_email").attr("src", "/images/check.png");
        $("#validation_email").css("visibility", "visible");

        return true;

    }

}

function Validation(){

    if(NicknameValidation() == true && PassValidation() == true && PassConfirmValidation() == true && EmailValidation() == true){

        if(nickname_use_now == true){
            $("#message_error_bad_filled").show();
            return false;
        }

        return true;
    }
    else{
        return false;
    }
}

function Send(){

    if(Validation()){

        if(form_already_sent == true){
            return;
        }

        form_already_sent = true;

        $("form").submit();
    }
    else{
        $("#message_error_nickname").hide();
        $("#message_error_confirmation_password").hide();
        $("#message_error_password").hide();
        $("#message_error_email").hide();

        $("#message_error_bad_filled").show();
    }
}






    /* EVENTS */

    /* - change pour gérer le copier coller
       - click pour gérer le retour depuis
         un autre champ
       - keyup pour gérer le changement de
         texte
       - mouseup pour gérer la croix de
         delete
       - keypress pour gérer la pression de la touche entrée
    */


function NicknameFieldKeyPressed(e){

    if( e.which == 13 ){  //ENTER
        $("#nickname").blur();
        Send();
    }
}

function PassFieldKeyPressed(e){

    if( e.which == 13 ){
        $("#pass").blur();
        Send();
    }
}

function PassConfirmFieldKeyPressed(e){

    if( e.which == 13 ){
        $("#pass_confirm").blur();
        Send();
    }
}

function EmailFieldKeyPressed(e){

    if( e.which == 13 ){
        $("#email").blur();
        Send();
    }
}



$(document).ready(function(){

/* NICKNAME INPUT */
$("#nickname").change(function(){

    nickname_old_value = $("#nickname").val();

    NicknameValidation();

    if(NicknameValidation()){

    /* A l'issue de cette fonction quelque
       que soit le résultat final la fonction
       Show_Nickname_Error sera executer avec
       comme param le resultatde cette requete
       Http */

        requestValidationNickname();
    }
    else{
        Show_Nickname_Error();
    }
});

$("#nickname").keyup(function(){

    console.log("Nickname old value setted");

    nickname_old_value = $("#nickname").val();

        requestValidationNickname();

});

$("#nickname").mouseup(function(){

    setTimeout(function(){

        var nickname_new_value = $("#nickname").val();

        if(nickname_new_value == "" && nickname_old_value != ""){

            NicknameValidation();
        }
    }, 30);

});

$("#nickname").click(function(){

       requestValidationNickname();

});

$("#nickname").keypress(function(e){

    NicknameFieldKeyPressed(e);

});


/* PASSWORD INPUT */
$("#pass").keyup(function(){

    PassValidation();
    Show_Pass_Error();
    PassConfirmValidation();

});

$("#pass").click(function(){

    Show_Pass_Error();

});

$("#pass").keypress(function(e){

    PassFieldKeyPressed(e);

});


/* CONFIRMATION PASSWORD INPUT */
$("#pass_confirm").keyup(function(){

    PassConfirmValidation();
    Show_Pass_Confirm_Error();

});

$("#pass_confirm").click(function(){

    Show_Pass_Confirm_Error();

});

$("#pass_confirm").keypress(function(e){

    PassConfirmFieldKeyPressed(e);

});


/* EMAIL INPUT */
$("#email").change(function(){

    email_old_value = $("#email").val();

    EmailValidation();
    Show_Email_Error();

});

$("#email").keyup(function(){

    email_old_value = $("#email").val();

    EmailValidation();
    Show_Email_Error();

});

$("#email").mouseup(function(){

    setTimeout(function(){

        var email_new_value = $("#email").val();

        if(email_new_value == "" && email_old_value != ""){

            EmailValidation();
        }
    }, 30);

});

$("#email").click(function(){

    Show_Email_Error();

});

$("#email").keypress(function(e){

    EmailFieldKeyPressed(e);

});


/* BUTTON SEND */
$("#send").click(function(){
    Send();
});

});
