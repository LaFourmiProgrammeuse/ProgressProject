<?php

    $path_log_file = '../log_server.txt';

    if(!isset($_POST['log_message']){
        exit;
    }

    $log_message = $_POST['log_message'];

    if(!$file_log_server = fopen($path_log_file, 'a')){
        exit;
    }

    $date = date("d/m/Y");
    $heure = date("H:i");

    $date_log = "[" . $date . "-" . $heure . "] ";
    $log_message_with_date = $date_log . $log_message;

    fwrite($file_log_server, "\n" . $log_message_with_date . "\n");

?>
