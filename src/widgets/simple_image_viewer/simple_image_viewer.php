<?php

      header("Content-Type: text/html");

    $images = $_POST['images'];
    $index = intval($_POST['index']);
    $download_content_name = $_POST["download_content_name"];
    $n_images_to_show = intval($_POST['n_images_to_show']);

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

        $link_for_download_img_1 = "/content/download_content.php?content_name=" . $download_content_name[$img_1_index];
        $link_for_download_img_2 = "/content/download_content.php?content_name=" . $download_content_name[$img_2_index];
        $link_for_download_img_3 = "/content/download_content.php?content_name=" . $download_content_name[$img_3_index];

      //Réponse HTML
      echo "<div class='widget_body'>";
        echo "<div class='left_arrow'><img src='/images/arrows/a_left.png' /></div>";

        if($n_images_to_show == 3){
          echo "<div class='left_image'><a href='" . $link_for_download_img_1 . "'><img src='" . $images[$img_1_index] . "' /></a></div>";
        }

        echo "<div class='central_image'><a href='" . $link_for_download_img_2 . "'><img src='" . $images[$img_2_index] . "' /></a></div>";

        if($n_images_to_show == 3){
          echo "<div class='right_image'><a href='" . $link_for_download_img_3 . "'><img src='" . $images[$img_3_index] . "' /></a></div>";
        }

        echo "<div class='right_arrow'><img src='/images/arrows/a_right.png' /></div>";
      echo "</div>";

?>
