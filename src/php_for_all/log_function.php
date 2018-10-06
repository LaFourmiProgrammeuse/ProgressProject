<?php

    function log_server($log_message, $file){
        $file_log_server = fopen($file, 'a');

        $date = date("d/m/Y");
        $heure = date("H:i");

        $date_log = "[" . $date . "-" . $heure . "] ";
        $log_message_with_date = $date_log . $log_message;

        fwrite($file_log_server, "\n" . $log_message_with_date);
    }
 ?>
