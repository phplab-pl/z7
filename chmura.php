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
			$nick = $_SESSION['nick'];
			$haslo = $_SESSION['haslo'];
			
			if ((empty($nick)) AND (empty($haslo))) {
				echo 'Brak dostępu! Nie jesteś zalogowany!<br><span style="font-weight: bold;"><a href="logowanie.php">Zaloguj się</a></span>';
				exit;
			}
			
			$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `nick`='$nick' AND `haslo`='$haslo' LIMIT 1"));
			if (empty($user[idu]) OR !isset($user[idu])) {
				echo 'Nieprawidłowe logowanie!';
				exit;
			}
			
			// tresc dla zalogowanego uzytkownika
			echo 'Witaj w <span style="font-weight: bold;">Swojej Prywatnej Chmurze</span>!';
			echo '<br>Jesteś zalogowany jako <span style="color: green; font-weight: bold;">'.$user[nick].'</span>';
			echo '<br><span style="font-weight: bold;"><a href="wyloguj.php">Wyloguj się</a></span><br>';
		?>
		<br>
		<form method="POST" action="chmura.php"> 
			Wpisz ścieżkę do katalogu: /główny 
			<input type="text" name="sciezka" size="60"><br> 
		<input type="submit" value="Wybierz"/>
		</form> 
		<br>
		
		<?php
		if ($_POST['sciezka']) {
			$sciezka = $_POST['sciezka'];
		}
		else {
			$sciezka = "";
		}
		?>
		
		<h4>Zawartość katalogu: <span style="color: blue;">/główny<?php echo $sciezka; ?></span></h4>
		<?php
		try
		{
			$katalog = './katalogi/'.$nick.''.$sciezka.'';
			foreach(new DirectoryIterator($katalog) as $file)
			  if(!$file->isDot())
				echo $file->getFilename() . '<br />';
		}
		catch (Exception $e)
		{
			echo 'Nie ma takiego katalogu!';
			exit;
		}

		?>
		<br>
		<h4>Wyślij plik do katalogu: </h4>
		<form method="POST" action="dodaj.php" ENCTYPE="multipart/form-data"> 
			Wybierz plik: 
			<input type="file" name="plik"/>
			<input type="hidden" name="sciezka" value="<?php echo $sciezka; ?>" />
			<input type="submit" value="Wyślij"/>
		</form> 
		<br>
		
  </body>
</html>
