var special_character = new Array('&', '@', '#', '*', '$');
var number = new Array('1', '2', '3', '4', '5', '6', '7', '8', '9');
var character_alphanumeric = new Array('a', 'b','c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

var pass_special_character_needed = 2;
var pass_number_needed = 2;
var pass_character_needed = 8;

var nickname_character_needed = 6;
var nickname_character_max = 11;

//For icon clear IE/EDGE
var nickname_old_value = "";
var email_old_value = "";

function hasSpecialCharacter(string, number_special_character_to_found){

    var special_character_found = 0;

    for(var i = 0; i < string.length; i++){

        for(var e = 0; e < special_character.length; e++){

            if(string[i] == special_character[e]){

                special_character_found++;

                if(special_character_found == number_special_character_to_found){

                    console.log("True");

                     return true;
                }
                else if(number_special_character_to_found == 0){
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

    for(var i = 0; i < string.length; i++){

        for(var e = 0; e < number.length; e++){

            if(string[i] == number[e]){

                number_found++;

                if(number_found == number_to_found){
                    return true;
                }
                else if(number_to_found == 0){
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

    var arobase = false;
    var point = false;

    for(var i = 0; i < mail.length; i++){

        if(mail[i] == '@'){

            if(arobase == true){
                return false;
            }
            else{
                arobase = true;
                continue;
            }
        }
        else if(mail[i] == '.'){

            if(arobase == true){
                point = true;
                continue;
            }
        }

        for(var e = 0; e < character_alphanumeric.length; e++){

            if(mail[i] == character_alphanumeric[e] || mail[i] == '.'){
                break;
            }
            else if(e == (character_alphanumeric.length-1)){
                return false;
            }
        }
    }

    if(arobase == false || point == false){
        return false;
    }

    return true;
}

function PassValidation(){

    var pass_value = $("#pass").val();

    if(pass_value.length == 0){

        console.log("1");
        $("#validation_pass").css("visibility", "hidden");

        return false;

    }
    else if(pass_value.length < pass_character_needed || !hasSpecialCharacter(pass_value, pass_special_character_needed) || !hasNumber(pass_value, pass_number_needed)){

        console.log("2");
        $("#validation_pass").attr("src", "../images/wrong.png");
        $("#validation_pass").css("visibility", "visible");

        return false;

    }
    else{

        console.log("3");
        $("#validation_pass").attr("src", "../images/check.png");
        $("#validation_pass").css("visibility", "visible");

        return true;

    }
}

function NicknameValidation(){

    var nickname_value = $("#nickname").val();

    if(nickname_value.length == 0){

        console.log("1");
        $("#validation_nickname").css("visibility", "hidden");

        return false;

    }
    else if(nickname_value.length < nickname_character_needed || hasSpecialCharacter(nickname_value, 0) || nickname_value.length > nickname_character_max){

        console.log("2");
        $("#validation_nickname").attr("src", "../images/wrong.png");
        $("#validation_nickname").css("visibility", "visible");

        return false;

    }
    else{

        console.log("3");
        $("#validation_nickname").attr("src", "../images/check.png");
        $("#validation_nickname").css("visibility", "visible");

        return true;

    }
}

function PassConfirmValidation(){

    var pass_confirm_value = $("#confirmation_password").val();
    var pass_value = $("#pass").val();

    if(pass_confirm_value.length == 0){

        console.log("1");
        $("#validation_confirmation_password").css("visibility", "hidden");

        return false;

    }
    else if(pass_confirm_value != pass_value){

        console.log("2");
        $("#validation_confirmation_password").attr("src", "../images/wrong.png");
        $("#validation_confirmation_password").css("visibility", "visible");

        return false;

    }
    else{

        console.log("3");
        $("#validation_confirmation_password").attr("src", "../images/check.png");
        $("#validation_confirmation_password").css("visibility", "visible");

        return true;

    }
}

function EmailValidation(){

    var email_value = $("#email").val();

    if(email_value.length == 0){

        console.log("1");
        $("#validation_email").css("visibility", "hidden");

        return false;

    }
    else if(!isValidMail(email_value)){

        console.log("2");
        $("#validation_email").attr("src", "../images/wrong.png");
        $("#validation_email").css("visibility", "visible");

        return false;

    }
    else{

        console.log("3");
        $("#validation_email").attr("src", "../images/check.png");
        $("#validation_email").css("visibility", "visible");

        return true;

    }

}

function Validation(){

    if(NicknameValidation() == true && PassValidation() == true && PassConfirmValidation() == true && EmailValidation() == true){
        return true;
    }
    else{
        return false;
    }
}

//On initialise les evênements lorque la page est chargée
$(document).ready(function(){

$("#pass").keyup(function(){

    PassValidation();
});

$("#nickname").change(function(){

    console.log("Nickname old value setted");

    nickname_old_value = $("#nickname").val();

    NicknameValidation();
});

$("#nickname").keyup(function(){

    console.log("Nickname old value setted");

    nickname_old_value = $("#nickname").val();

    NicknameValidation();
});

$("#nickname").mouseup(function(){

    setTimeout(function(){

        var nickname_new_value = $("#nickname").val();

        if(nickname_new_value == "" && nickname_old_value != ""){

            NicknameValidation();
        }
    }, 30);

});

$("#confirmation_password").keyup(function(){

    PassConfirmValidation();
});

$("#email").keyup(function(){

    email_old_value = $("#email").val();

    EmailValidation();
});

$("#email").mouseup(function(){

    setTimeout(function(){

        var email_new_value = $("#email").val();

        if(email_new_value == "" && email_old_value != ""){

            EmailValidation();
        }
    }, 30);

});

$("#send").click(function(){

    if(Validation()){
        $("form").submit();
    }
});

});
