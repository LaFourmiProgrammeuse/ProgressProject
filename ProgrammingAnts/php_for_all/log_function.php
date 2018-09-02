<?php

    function log($log_message){
        $file_log_server = fopen("../log_server.txt", a);

        $date = date("d/m/Y");
        $heure = date("H:i");

        $date_log = "[" . $date . "-" . $heure . "] ";
        $log_message_with_date = $date_log . $log_message;

        fwrite($file_log_server, "/n" . $log_message_with_date)
    }
 ?>
