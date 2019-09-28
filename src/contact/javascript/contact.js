function answerShowMail(data){

    //Si le captcha a été reussie on affiche le mail
    if(data == "BadCaptcha")
        return;

    $(".btn_show_mail").hide();
    $(".show_mail .mail").text(data);

}

function requestShowMail(token){

    $.ajax({
        url: "/src/contact/php/show_mail.php",
        data: {token: token},
        cache: false,
        method: "POST",
        success: function(data){
            answerShowMail(data);
        },
        error: function(){
            console.log("Error");
        }
    });
}

$(document).ready(function(){

    particlesJS.load('particles-frame', '/src/framework_javascript/particles-config.json', function() {
        console.log('callback - particles.js config loaded');
    });


        /* EVENTS */

    $(".btn_show_mail").click(function(){
        grecaptcha.execute('6LdPWrQUAAAAABdiTBF5vWQ7OlFWXdqC6-87C9ns', {action: 'login'}).then(function(token) {
              requestShowMail(token);
        });
    });

});
