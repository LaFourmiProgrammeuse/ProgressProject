<?php
  $content_name = $_GET['content_name'];
    $extension = $_GET['content_extension'];

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    $l_extention_available = array();
    $l_resolution_available = array();

    $qprepare = $bdd->prepare("SELECT extension, w_resolution, h_resolution FROM contents WHERE name=?");
    $qprepare->execute(array($content_name));

    while($qanswer = $qprepare->fetch()){

        $extension = $qanswer["extension"];

        if(!array_search($extension, $l_extention_available)){
            array_push($l_extention_available, $extension);
        }

        $w_resolution = $qanswer["w_resolution"];
        $h_resolution = $qanswer["h_resolution"];
        $resolution = $w_resolution . "*" . $h_resolution;

        if(!array_search($h_resolution, $l_resolution_available)){
            array_push($l_resolution_available, $resolution);
        }
    }

    $resolution_exploded = explode("-", $_GET["content_resolution"]);
    $w_resolution = $resolution_exploded[0];
    $h_resolution = $resolution_exploded[1];

    $qprepare_2 = $bdd->prepare("SELECT folder_path FROM contents WHERE name=? && extension=? && w_resolution=? && h_resolution=?");
    $qprepare_2->execute(array($content_name, $extension, $w_resolution, $h_resolution));

    $central_image_folder = $qprepare_2->fetch()[0];

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/src/content/download_content.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <script type="text/javascript" src="/src/framework_javascript/jquery.js"></script>
    <script type="text/javascript" src="/src/content/download_content.js"></script>

	<meta charset="utf-8"/>
	<title>Download File</title>
</head>

<body>
  <header>
    <p>You are about to download the file below</p>
  </header>

  <section>
    <img src="<?php echo $central_image_folder . $content_name . "." . $extension; ?>"/>

    <div class="img_attributes_choices">

    <h3 class="extension_container_title">Extensions availables</h3>
    <div class="extension_container">

        <?php
           for($i = 0; $i < sizeof($l_extention_available); $i++){
        ?>
        <div class="extension">
            <p><?php echo $l_extention_available[$i]; ?></p>
        </div>
        <?php } ?>
    </div>

    <h3 class="resolution_container_title">Resolutions availables</h3>
    <div class="resolution_container">
        <?php
           for($i = 0; $i < sizeof($l_resolution_available); $i++){
        ?>
        <div class="resolution">
            <p><?php echo $l_resolution_available[$i]; ?></p>
        </div>
        <?php } ?>
    </div>
    </div>

    <a class="download_link" href="/content/<?php echo $content_name; ?>" download="/content/<?php echo $content_name; ?>">Click here to download it</a>
  </section>
</body>

</html>
