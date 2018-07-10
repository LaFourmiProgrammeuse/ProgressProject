var special_character = new Array('&', '@', '#', '*', '$');
var number = new Array('1', '2', '3', '4', '5', '6', '7', '8', '9');

var pass_special_character_needed = 2;
var pass_number_needed = 2;

var pass_character_needed = 8;
var nickname_character_needed = 6;

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

function isValidMail(string){

}

function PassValidation(){

    var pass_value = $("#pass").val();

    if(pass_value.length == 0){

        console.log("1");
        $("#validation_pass").css("visibility", "hidden");

    }
    else if(pass_value.length < pass_character_needed || !hasSpecialCharacter(pass_value, pass_special_character_needed) || !hasNumber(pass_value, pass_number_needed)){

        console.log("2");
        $("#validation_pass").attr("src", "../images/wrong.png");
        $("#validation_pass").css("visibility", "visible");

    }
    else{

        console.log("3");
        $("#validation_pass").attr("src", "../images/check.png");
        $("#validation_pass").css("visibility", "visible");

    }
}

function NicknameValidation(){

    var nickname_value = $("#nickname").val();

    if(nickname_value.length == 0){

        console.log("1");
        $("#validation_nickname").css("visibility", "hidden");

    }
    else if(nickname_value.length < nickname_character_needed || hasSpecialCharacter(nickname_value, 0)){

        console.log("2");
        $("#validation_nickname").attr("src", "../images/wrong.png");
        $("#validation_nickname").css("visibility", "visible");

    }
    else{

        console.log("3");
        $("#validation_nickname").attr("src", "../images/check.png");
        $("#validation_nickname").css("visibility", "visible");

    }
}

function PassConfirmValidation(){

    var pass_confirm_value = $("#confirmation_password").val();
    var pass_value = $("#pass").val();

    if(pass_confirm_value.length == 0){

        console.log("1");
        $("#validation_confirmation_password").css("visibility", "hidden");

    }
    else if(pass_confirm_value != pass_value){

        console.log("2");
        $("#validation_confirmation_password").attr("src", "../images/wrong.png");
        $("#validation_confirmation_password").css("visibility", "visible");

    }
    else{

        console.log("3");
        $("#validation_confirmation_password").attr("src", "../images/check.png");
        $("#validation_confirmation_password").css("visibility", "visible");

    }
}

function EmailValidation(){

}

//On initialise les evênements lorque la page est chargée
$(document).ready(function(){

$("#pass").keyup(function(){

    PassValidation();
});

$("#nickname").keyup(function(){

    NicknameValidation();
});

$("#confirmation_password").keyup(function(){

    PassConfirmValidation();
});

$("#email").keyup(function(){

    EmailValidation();
});

});
