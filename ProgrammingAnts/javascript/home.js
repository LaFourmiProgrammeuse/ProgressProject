var session_nickname;

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

function readDataSession(data){

    console.log(data);

    console.log(data.getElementsByTagName("connected"));


}

function requestSessionData(){

    var nickname = $("#nickname").val();

    if(xhr && xhr.readyState != 0){
        return;
    }

    var xhr = getXmlHttpRequest();

    xhr.onreadystatechange = function(){

        if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)){

            readDataSession(xhr.responseXML);
        }
    }

    xhr.open("GET", "../php/session_control_for_javascript.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(null);

}

$(document).ready(function(){

    requestSessionData();

});
