<?php session_start();
mysql_connect("az-serwer1755037.online.pro","00087616_database_7","mo1MJPxD") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysql_select_db("00087616_database_7") or die(mysql_error()."Nie mozna wybrac bazy danych.");

$dbhost="az-serwer1755037.online.pro"; $dbuser="00087616_database_7"; $dbpassword="mo1MJPxD"; $dbname="00087616_database_7";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
?>
