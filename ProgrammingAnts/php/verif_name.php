<?php

    header("Conntent-Type: text/plain");

    if(isset($_POST['nickname'])){

        $nickname = $_POST['nickname'];

        echo "true";
    }
    else{
        echo "Error";
    }

 ?>
