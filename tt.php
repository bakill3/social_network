<?php
include 'ligar_db.php';
//$query = mysqli_query($link, "SELECT * FROM posts ORDER BY data DESC");
$query = mysqli_query($link, "SELECT posts.id AS id_post, posts.data AS data, users.foto AS foto, users.f_nome as f_nome, users.l_nome as l_nome, users.id as id_user, id_perfil, id_user_postou, post FROM posts INNER JOIN users ON posts.id_user_postou = users.id ORDER BY data DESC");

while ($info = mysqli_fetch_array($query)) {
	$post = $info['post'];
	echo $post. "<br>";
}
?>