<?php

      header("Content-Type: text/html");

    $images = $_POST['images'];
    $index = intval($_POST['index']);

    //echo "1" . $index . $images;

    if($index-1 >= 0){
      $img_1_index = ($index-1);
    }else{
      $img_1_index = count($images)-1;
    }

    $img_2_index = $index;

    if($index+1 <= count($images)-1){
      $img_3_index = ($index+1);
    }else{
      $img_3_index = 0;
    }

      echo "<div class='widget_body'>";
        echo "<div class='left_arrow'><img src='/images/arrows/a_left.png' /></div>";
        echo "<div class='left_image'><img src='" . $images[$img_1_index] . "' /></div>";
        echo "<div class='central_image'><img src='" . $images[$img_2_index] . "' /></div>";
        echo "<div class='right_image'><img src='" . $images[$img_3_index] . "' /></div>";
        echo "<div class='right_arrow'><img src='/images/arrows/a_right.png' /></div>";
      echo "</div>";

?>
