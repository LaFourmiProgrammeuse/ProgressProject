
    alert("Test");

    var pos = 30;
    var box = document.getElementById("message_connection");

    setInterval(move, 100);

    function move(){

        console.log("Loop");

        pos++;
        box.style.left = pos+"px";

    }
