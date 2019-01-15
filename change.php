<?php
include 'ligar_db.php';
$f_name = htmlspecialchars(mysqli_real_escape_string($link, $_POST['f_name_changed']));
$l_name = htmlspecialchars(mysqli_real_escape_string($link, $_POST['l_name_changed']));
$l_name = htmlspecialchars(mysqli_real_escape_string($link, $_POST['l_name_changed']));
$about = htmlspecialchars(mysqli_real_escape_string($link, $_POST['about']));
$id_user = $_SESSION['user'][5];

echo $f_name." ".$l_name." ".$about;
mysqli_query($link, "UPDATE users SET f_nome='$f_name', l_nome='$l_name', sobre='$about' WHERE id='$id_user'");
$_SESSION['sucesso'] = "Data changed successfully!";

?>