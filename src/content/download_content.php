<?php
  $content_name = $_GET['content_name'];
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
    <img src="/content/<?php echo $content_name; ?>"/>

    <div class="img_attributes_choices">

    <h3 class="extension_container_title">Extensions availables</h3>
    <div class="extension_container">
        <div class="extension">
            <p>jpg</p>
        </div>
    </div>

    <h3 class="resolution_container_title">Resolutions availables</h3>
    <div class="resolution_container">
        <div class="resolution">
            <p>1680*1050</p>
        </div>
    </div>
    </div>

    <a class="download_link" href="/content/<?php echo $content_name; ?>" download="/content/<?php echo $content_name; ?>">Click here to download it</a>
  </section>
</body>

</html>
