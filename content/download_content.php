<?php
  $content_name = $_GET['content_name'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="download_content.css">
	<meta charset="utf-8"/>
	<title>Download File</title>
</head>

<body>
  <header>
    <p>You are about to download the file below</p>
  </header>

  <section>
    <img src="/content/<?php echo $content_name; ?>"/>
    <a href="/content/<?php echo $content_name; ?>" download="/content/<?php echo $content_name; ?>">Click here to download it</a>
  </section>
</body>

</html>
