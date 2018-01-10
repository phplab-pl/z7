<?php include("config.php"); ?>
<meta http-equiv="refresh" content="0; URL=chmura.php">
<?php
$nick = $_SESSION['nick'];
$sciezka = $_POST['sciezka'];
 if (is_uploaded_file($_FILES['plik']['tmp_name']))
 {
 echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
 move_uploaded_file($_FILES['plik']['tmp_name'],
 './katalogi/'.$nick.''.$sciezka.'/'.$_FILES['plik']['name']);
 }
 else {echo 'B³¹d przy przesy³aniu danych!';}
?>
