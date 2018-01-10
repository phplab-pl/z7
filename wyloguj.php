<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="pl">
  <head><!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109235595-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-109235595-1');
	</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Błaszczyk/z7</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://static.az.pl/css/bootstrap.css">

  </head>
  <body style="margin:10px">
  
		<?php

		session_destroy();
		echo 'Wylogowano poprawnie, wróć do <span style="font-weight: bold;"><a href="index.php">Strony Głównej</a></span>';
		?>

  </body>
</html>