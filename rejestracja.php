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
  <body style="margin:10px";>
		
		<?php

			//$ip = $_SERVER['REMOTE_ADDR'];

			$akcja = $_GET['akcja'];
			if ($akcja == wykonaj) {
				
				$nick = substr(addslashes(htmlspecialchars($_POST['nick'])),0,32);
				$haslo = substr(addslashes($_POST['haslo']),0,32);
				
				$nick = trim($nick);
				
				$spr1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE nick='$nick' LIMIT 1")); //czy user o takim nicku istnieje
				$komunikaty = '';
				$spr4 = strlen($nick);
				$spr5 = strlen($haslo);
				//sprawdzenie co uzytkownik zle zrobil
				if (!$nick || !$haslo) {
				$komunikaty .= "Musisz wypełnić wszystkie pola!<br>"; }
				if ($spr4 < 4) {
				$komunikaty .= "Login musi mieć przynajmniej 4 znaki!<br>"; }
				if ($spr5 < 4) {
				$komunikaty .= "Hasło musi mieć przynajmniej 4 znaki!<br>"; }
				if ($spr1[0] >= 1) {
				$komunikaty .= "Ten login jest zajęty!<br>"; }
				

				//jesli cos jest nie tak to blokuje rejestracje i wyswietla bledy
				if ($komunikaty) {
				echo '
				<b>Rejestracja nie powiodła się, popraw następujące błędy:</b><br>
				'.$komunikaty.'<br>';
				} else {
				//jesli wszystko jest ok dodaje uzytkownika i wyswietla informacje
				$nick = str_replace ( ' ','', $nick );
				$haslo = md5($haslo); //szyfrowanie hasla

				mysql_query("INSERT INTO `users` (nick, haslo) VALUES('$nick','$haslo')") or die("Nie mogłem Cie zarejestrować!");
				
				// tworzenie katalogu o nazwie nowego usera
				mkdir('./katalogi/'.$nick, 0700);

				echo 'Zostałeś zarejestrowany <span style="color: green; font-weight: bold;">'.$nick.'</span><br>Teraz możesz się <span style="font-weight: bold;"><a href="/z7/logowanie.php">ZALOGOWAĆ</a></span><br><br>';
				
				exit;
				}
			}
			?>
			
			<h4>REJESTRACJA</h4>
			<form method="post" action="rejestracja.php?akcja=wykonaj">
				<table>
				<tr><td width="50">Nick:</td>
				<td><input maxlength="18" type="text" name="nick" value="<?=$nick?>"></td></tr>
				<tr><td width="50">Hasło:</td>
				<td><input maxlength="32" type="password" name="haslo"></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" value="Zarejestruj"></td></tr>
				</table>
			</form>



  </body>
</html>
