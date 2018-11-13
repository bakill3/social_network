<?php 
include 'ligar_db.php'; 
if (isset($_GET['token'])) {
	$token = mysqli_real_escape_string($link, $_GET['token']);
	$query = mysqli_query($link, "SELECT * FROM users WHERE token='$token'");
	if (mysqli_num_rows($query) == 1) {
		mysqli_query($link, "UPDATE users SET ativado='1' WHERE token='$token'");
		$_SESSION['erro'] = "Já pode iniciar sessão com a sua conta";
		header('Location: index.php');
		exit(0);
	}
}
?>