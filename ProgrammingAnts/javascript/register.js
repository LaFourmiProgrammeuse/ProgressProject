var special_character = new Array('&', '@', '#');
var special_character_needed = 2;

var character_needed = 8;

function hasSpecialCharacter(string){

    var special_character_found = 0;

    for(var i = 0; i < string.length; i++){

        for(var e = 0; e < special_character.length; e++){

            if(string[i] == special_character[e]){

                special_character_found++;

                if(special_character_found == special_character_needed){

                    console.log("True");

                     return true;
                }
            }
        }
    }

    return false;
}

function PassValidation(){

    var pass_value = $("#pass").val();

    if(pass_value.length == 0){
        console.log("1");
    }
    else if(pass_value.length < character_needed || !hasSpecialCharacter(pass_value)){
        console.log("2");
        $("#validation_pass").attr("src", "../images/wrong.png");
    }
    else{
        console.log("3");
        $("#validation_pass").attr("src", "../images/check.png");
    }
}

function NicknameValidation(){

}

function PassConfirmValidation(){

}

function EmailValidation(){

}

$(document).ready(function(){

$("#pass").keyup(function(){

    PassValidation();
});

$("#nickname").keyup(function(){

    NicknameValidation();
});

$("#pass_confirm").keyup(function(){

    PassConfirmValidation();
});

$("#email").keyup(function(){

    EmailValidation();
});

});
