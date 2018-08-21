<?php
include 'codigo.php';
$id_post_gostado = mysqli_real_escape_string($link, $_POST['id_post_gostado']);
$query = mysqli_query($link, "SELECT * FROM likes WHERE id_user='".$_SESSION['user'][5]."' AND id_post='$id_post_gostado'");

if (mysqli_num_rows($query) == 1) {
	echo "Gostou <i class='fas fa-heart'>";
} else {
	echo "Gosto <i class='far fa-heart'>";
}

?>