<?php
include 'ligar_db.php';
$data_atual = date("Y-m-d H:i:s");
if (isset($_POST['post'])) {
	$id_perfil = $_SESSION['user'][5];
	$id_user = $_SESSION['user'][5];
	$post = htmlspecialchars(mysqli_real_escape_string($link, $_POST['post']));

	$len_post = strlen($post);

	if (!empty($post)) {
		if ($len_post > 0) {

			$post = preg_replace('"\b(https?://\S+)"', '<div class="text-center embed-responsive embed-responsive-21by9"><iframe class="embed-responsive-item" width="425" height="344" src="$1" frameborder="0" title="Video" allowfullscreen></iframe></div></a>', $post);
			





			mysqli_query($link, "INSERT INTO posts (id_user_postou, id_perfil, post, data) VALUES ('$id_user', '$id_perfil', '$post', '$data_atual')") or die(mysqli_error($link));

			mysqli_query($link, "INSERT INTO notificacoes (sender, receiver, tipo) VALUES ('$id_user', '$id_perfil', 'post')") or die (mysqli_error($link));

			/*
			$existe = "imagens/utilizadores/".$id."/galeria";
			if (!is_dir($existe)) {
				mkdir($existe);
			}
			$file_name = $_FILES['file']['name'];
			$file_type = $_FILES['file']['type'];
			$file_size = $_FILES['file']['size'];
			$file_tem_loc = $_FILES['file']['tmp_name'];
			$file_store = "imagens/utilizadores/".$id."/galeria/".$file_name;

			if (!empty($file_name)) {

				$busca_post_id = mysqli_query($link, "SELECT id FROM posts WHERE post='$post' AND id_user_postou='$id_user' AND id_perfil='$id_perfil' LIMIT 1");
				$info_post = mysqli_fetch_assoc($busca_post_id);
				$id_post = $info_post['id'];
				move_uploaded_file($file_tem_loc, $file_store);

				mysqli_query($link, "INSERT INTO galeria (id_user, foto, id_post) VALUES ('$id_user', '$file_store', '$id_post')");

			}
			*/
		}
		echo "Comentário publicado!";
	} else {
		echo "Preencha o comentário!";
	}

}
?>