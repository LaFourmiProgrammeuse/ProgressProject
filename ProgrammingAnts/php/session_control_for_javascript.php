<?php
    require "session_control.php";

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/xml");
    echo "<?xml version =\"1.0\" encoding=\"utf-8\"?>";
    echo "<session>";

    if(isset($_SESSION['connection_from_register'])){
        echo "<connection_from_register>" . $_SESSION["connection_from_register"] ."</connection_from_register>";
    }
    echo "<connected>" . $_SESSION["connected"] ."</connected>";

    if($_SESSION['connected'] == "true"){
        echo "<username>" . $_SESSION["username"] . "</username>";
    }
    echo "</session>";

 ?>
