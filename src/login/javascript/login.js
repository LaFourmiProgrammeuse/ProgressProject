var form_already_sent = false;


function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace(
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
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

        if(form_already_sent == true){
            return;
        }

        form_already_sent = true;

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

    xhr.open("POST", "/src/login/php/verif_login_credentials.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    data = "username="+username+"&password="+password;

    xhr.send(data);

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

function Send(){

    if(Validation()){
        requestLoginCredentials();
    }else{
        $("#message_error_bad_filled").show();
    }
}

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

$(document).ready(function(){

    $("#message_error_bad_filled").hide();
    $("#message_error_bad_credentials").hide();

        /* EVENT */

    $("#nickname").keypress(function(e){

        NicknameFieldKeyPressed(e);

    });

    $("#pass").keypress(function(e){

        PassFieldKeyPressed(e);

    });

    $("#send").click(function(){
        Send();
    });

});
