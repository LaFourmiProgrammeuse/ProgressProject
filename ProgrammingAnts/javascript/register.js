console.log("eedsq");

function PassValidation(){
alert("Test");

    console.log($("#pass").val());

    if($("#pass").val().length == 0){

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
