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
			$akcja = $_GET['akcja'];
			if ($akcja == wykonaj) {
				
				$login = substr(addslashes(htmlspecialchars($_POST['login'])),0,18);
				$haslo = substr(addslashes($_POST['haslo']),0,32);
				
				//$login = trim($login);
				
				$komunikaty = '';
				//sprawdzenie co uzytkownik zle zrobil
				if (!$login OR empty($login)) {
				$komunikaty .= "Wypełnij pole z loginem!<br>";}
				if (!$haslo OR empty($haslo)) {
				$komunikaty .= "Wypełnij pole z hasłem!<br>"; }
				if ($login AND $haslo) {
					$haslo = md5($haslo); //szyfrowanie hasla
					$istnick = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `users` WHERE `nick` = '$login' AND `haslo` = '$haslo'")); // sprawdzenie czy istnieje uzytkownik o takim nicku i hasle
					if ($istnick[0] == 0) {
					$komunikaty .= "Nieprawidłowy login lub hasło!<br>"; }

				}
				
				$data = date("Y-m-d H:i:s");
				$ip = $_SERVER['REMOTE_ADDR'];

				//jesli cos jest nie tak to blokuje logowanie i wyswietla bledy
				if ($komunikaty) {
				echo '
				<b>Logowanie nie powiodło się, popraw następujące błędy:</b><br>
				'.$komunikaty.'<br>';
				
				$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `nick`='$login' LIMIT 1"));
				if ($user[idu]) {
					$idu = $user[idu];
				}
				
				$query = "INSERT INTO logi (idu, data, ip, proby) VALUES ('$idu', '$data', '$ip', '1') ON DUPLICATE KEY UPDATE data = '" . $data . "', ip = '" . $ip . "', proby = proby + 1 ";
				mysqli_query($polaczenie, $query);
				
				} else {
				//jesli wszystko jest ok loguje uzytkownika i wyswietla informacje
				
				$_SESSION['nick'] = $login;
				$_SESSION['haslo'] = $haslo;

				
				$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `nick`='$login' AND `haslo`='$haslo' LIMIT 1"));
				if ($user[idu]) {
					$idu = $user[idu];
				}
				
				if($idu and $data and $ip) { 
					$query = "INSERT INTO logi (idu, data, ip, proby) VALUES ('$idu', '$data', '$ip', '0') ON DUPLICATE KEY UPDATE data = '" . $data . "', ip = '" . $ip . "', proby = '0' ";
					mysqli_query($polaczenie, $query);
				}
				mysqli_close($polaczenie);

				echo 'Zostałeś zalogowany jako <span style="color: green; font-weight: bold;">'.$_SESSION['nick'].'</span><br>Teraz możesz przejść do <span style="font-weight: bold;"><a href="/z7/chmura.php">Swojej Prywatnej Chmury</a></span><br><br>';
				
				exit;
				}
			}
		?>
		
		<h4>LOGOWANIE</h4>
		<form method="POST" action="logowanie.php?akcja=wykonaj">
			<table>
			<tr><td width="50">Login:</td><td><input type="text" name="login" maxlength="18"></td></tr>
			<tr><td width="50">Hasło:</td><td><input type="password" name="haslo" maxlength="32"></td></tr>
			<tr><td align="center" colspan="2"><input type="submit" value="Zaloguj"><br></td></tr>

			</table>
		</form>

  </body>
</html>
