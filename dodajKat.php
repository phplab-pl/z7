<?php include("config.php"); ?>
<meta http-equiv="refresh" content="0; URL=chmura.php">
<?php
$nick = $_SESSION['nick'];
$sciezka = $_POST['sciezka'];
$nazwa = $_POST['nazwa'];
// tworzenie katalogu o nazwie nowego usera
mkdir('./katalogi/'.$nick.''.$sciezka.'/'.$nazwa, 0700);
?>
