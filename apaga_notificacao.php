<?php
include 'codigo.php';
$id_notificacao = mysqli_real_escape_string($link, $_POST['id_notificacao']);
mysqli_query($link, "UPDATE notificacoes SET vista = '1' WHERE id_notificacao = '$id_notificacao'");
?>