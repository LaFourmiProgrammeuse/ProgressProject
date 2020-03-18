<?php

    header("Content-Type: text/html");

    $index = intval(strip_tags($_POST['index']));
    $n_images_to_show = intval(strip_tags($_POST['n_images_to_show']));

    $download_content_name = strip_tags($_POST["download_content_name"]);
    $download_content_extension = strip_tags($_POST["download_content_extension"]);
    $download_content_resolution = strip_tags($_POST["download_content_resolution"]); //Résolution stocké sous la forme 1920-1080

    $image_folder_path = array();

    $download_content_w_resolution = array();
    $download_content_h_resolution = array();

    for($i = 0; $i < sizeof($download_content_resolution); $i++){
        $resolution_exploded = explode("-", $download_content_resolution[$i]);

        array_push($download_content_w_resolution, $resolution_exploded[0]);
        array_push($download_content_h_resolution, $resolution_exploded[1]);
    }

    /*var_dump($download_content_name);
    var_dump($download_content_extension);
    var_dump($download_content_resolution);
    var_dump($download_content_w_resolution);
    var_dump($download_content_h_resolution);*/

    //echo "Index: " . $index;

    if($index-1 >= 0){
      $img_1_index = ($index-1);
    }else{
      $img_1_index = count($download_content_name)-1;
    }

    $img_2_index = $index;

    if($index+1 <= count($download_content_name)-1){
      $img_3_index = ($index+1);
    }else{
      $img_3_index = 0;
    }

    $link_for_download_img_1 = "/src/content/download_content.php?content_name=" . $download_content_name[$img_1_index] . "&content_extension=" . $download_content_extension[$img_1_index] . "&content_resolution=" . $download_content_resolution[$img_1_index];
    $link_for_download_img_2 = "/src/content/download_content.php?content_name=" . $download_content_name[$img_2_index] . "&content_extension=" . $download_content_extension[$img_2_index] . "&content_resolution=" . $download_content_resolution[$img_2_index];
    $link_for_download_img_3 = "/src/content/download_content.php?content_name=" . $download_content_name[$img_3_index] . "&content_extension=" . $download_content_extension[$img_3_index] . "&content_resolution=" . $download_content_resolution[$img_3_index];

    try{
        $db = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
    }
    catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }

    for($i = 0; $i < sizeof($download_content_name); $i++){

        //A partir des caractéristique de l'image on recupere le chemin du dossier ou elle est stoché
        $qprepare = $db->prepare("SELECT folder_path FROM contents WHERE name=? && extension=? && w_resolution=? && h_resolution=?");
        $qprepare->execute(array($download_content_name[$i], $download_content_extension[$i], $download_content_w_resolution[$i], $download_content_h_resolution[$i]));

        $folder_path = $qprepare->fetch(PDO::FETCH_NUM)[0];
        array_push($image_folder_path, $folder_path);
    }



      //Réponse HTML
      echo "<div class='widget_body'>";
        echo "<div class='left_arrow'><img src='/images/icons/articles/slider/sldr_arw_left.svg' /></div>";

        if($n_images_to_show == 3){
          echo "<div class='left_image'><a href='" . $link_for_download_img_1 . "'><img src='" . $image_folder_path[$img_1_index] . $download_content_name[$img_1_index] . "." . $download_content_extension[$img_1_index] . "' /></a></div>";
        }

        echo "<div class='central_image'><a href='" . $link_for_download_img_2 . "'><img src='" . $image_folder_path[$img_2_index] . $download_content_name[$img_2_index] . "." . $download_content_extension[$img_2_index] . "' /></a></div>";

        if($n_images_to_show == 3){
          echo "<div class='right_image'><a href='" . $link_for_download_img_3 . "'><img src='" . $image_folder_path[$img_3_index] . $download_content_name[$img_3_index] . "." . $download_content_extension[$img_3_index] . "' /></a></div>";
        }

        echo "<div class='right_arrow'><img src='/images/icons/articles/slider/sldr_arw_right.svg' /></div>";
      echo "</div>";

?>
