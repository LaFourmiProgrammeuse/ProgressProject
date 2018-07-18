<?php
    require "session_control.php";

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/xml");
    echo "<?xml version =\"1.0\" encoding=\"utf-8\"?>";
    echo "<session>";

    echo "<connected>" . $_SESSION["connected"] ."</connected>";

    if($_SESSION['connected'] == "true"){
        echo "<username>" . $_SESSION["username"] . "</username>";
    }
    echo "</session>";

 ?>
