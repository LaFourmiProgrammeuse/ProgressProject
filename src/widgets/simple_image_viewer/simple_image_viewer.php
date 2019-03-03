<?php
class SimpleImageViewer
{
  private $index = 0;
  private $images = [];
  private $image_viewer_id = 0;
  private $mandatory_part_of_url = "";

  public function setImageViewerId($image_viewer_id){
    $this->image_viewer_id = $image_viewer_id;

    if($_GET[("siv_index_" . strval($image_viewer_id))]){
      $index = $_GET[("siv_index_" . strval($image_viewer_id))];
    }
  }

  public function setMandatoryPartOfUrl($mandatory_part_of_url){
    $this->mandatory_part_of_url = $mandatory_part_of_url;
  }

  public function addImage($image){
    array_push($this->images, $image);
  }

  public function addImageFolder(){

  }

  public function getIndex(){
    return $this->index;
  }

  public function setIndex($index){
    $this->index = $index;
  }

  public function nextImage(){

    if($this->index+1 <= count($this->images)-1){
      $this->index = $this->index+1;
    }else{
      $this->index = 0;
    }
  }

  public function previousImage(){

    if($this->index-1 >= 0){
      $img_1_index = $this->index-1;
    }else{
      $img_1_index = count($this->images)-1;
    }
  }

  public function reloadPage(){
    header(("Location: " . $this->mandatory_part_of_url . "siv_index_" . strval($this->image_viewer_id) . "=" . $this->index));
  }

  public function createHtmlCode(){

    if($this->index-1 >= 0){
      $img_1_index = $this->index-1;
    }else{
      $img_1_index = count($this->images)-1;
    }

    $img_2_index = $this->index;

    if($this->index+1 <= count($this->images)-1){
      $img_3_index = $this->index+1;
    }else{
      $img_3_index = 0;
    }

    echo "<div class='widget_simple_image_viewer'>";
      echo "<div class='widget_body'>";
        echo "<div class='left_arrow'><a href='" . ($this->mandatory_part_of_url . "siv_index_" . strval($this->image_viewer_id) . "=" . $img_1_index) . "'><img src='/images/arrows/a_left.png' /></a></div>";
        echo "<div class='left_image'><img src='" . $this->images[$img_1_index] . "' /></div>";
        echo "<div class='central_image'><img src='" . $this->images[$img_2_index] . "' /></div>";
        echo "<div class='right_image'><img src='" . $this->images[$img_3_index] . "' /></div>";
        echo "<div class='right_arrow'><a href='" . ($this->mandatory_part_of_url . "siv_index_" . strval($this->image_viewer_id) . "=" . $img_3_index) . "'><img src='/images/arrows/a_right.png' /></a></div>";
      echo "</div>";
    echo "</div>";
  }
}

?>
