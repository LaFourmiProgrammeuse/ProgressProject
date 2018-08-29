
        /* AJAX */

var xhr = null;

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

        $("form").submit();
    }
    else{
        $("#message_error_bad_credentials").show();
        $("#message_error_bad_filled").hide();
    }
}

function requestLoginCredentials(){

    var username = $("#nickname").val();
    var password = $("#pass").val();

    console.log("requestValidationNickname : "+nickname+pass);

    if(xhr && xhr.readyState != 0){
        return;
    }

    var xhr = getXmlHttpRequest();

    xhr.onreadystatechange = function(){

    if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){

        readData(xhr.responseText);
    }

    }

    xhr.open("POST", "../../php_without_view/verif_login_credentials.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("username="+username+"&password="+password);

}

        /* VALIDATION */

function NicknameValidation(valid_credentials){

    var nickname_value = $("#nickname").val();

    if(nickname_value == ""){
        return false;
    }
    else{
        return true;
    }
}

function PassValidation(){

    var pass_value = $("#pass").val();

    if(pass_value == ""){
        return false;
    }
    else{
        return true;
    }
}

function Validation(){

    if(PassValidation() && NicknameValidation()){
        return true;
    }
}

$(document).ready(function(){

    $("#message_error_bad_filled").hide();
    $("#message_error_bad_credentials").hide();

        /* EVENT */

    $("#send").click(function(){

        if(Validation()){
            requestLoginCredentials();
        }else{
            $("#message_error_bad_filled").show();
        }

    });

});
