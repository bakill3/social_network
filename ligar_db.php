<?php
header('Content-Type: text/html; charset=utf-8');
$link = mysqli_connect("localhost", "bakill3", "12345", "socialsi_verao_en");
if ($link ==FALSE) {
	die("Nao foi possivel estabelecer uma conexao" . mysqli_error());
	exit;
}
mysqli_set_charset($link, "utf8mb4");
$escolheBD = mysqli_select_db($link, "socialsi_verao_en");
if ($escolheBD==FALSE) {
	echo ("Não foi possível ligar à base de dados");
	mysqli_error();
	exit;
}
session_start();
?>