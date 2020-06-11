<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Logging Off</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
</head>

<body>
	<p>Please Wait...</p>

	<?php
		$redirect = "index.php";
		session_start();

		session_destroy();
	?>
	

	<script>
		window.location.replace("<?= $redirect ?>");
	</script>
</body>
</html>