<?php 

include 'header.php'; 

?>

<div class="bem_vindo">
	<h1 class="text-white text-center"><span class="texto_nice"><span class="text-white">Publicações</span> Recentes </span></h1>
	<br>

	<?php 
	$query = mysqli_query($link, "SELECT posts.id AS id_post, users.foto AS foto, users.f_nome as f_nome, users.l_nome as l_nome, users.id as id_user, id_perfil, id_user_postou, post, data FROM posts INNER JOIN users ON posts.id_user_postou = users.id ORDER BY RAND()");
	while ($info_post = mysqli_fetch_array($query)) {
		$id_post = $info_post['id_post'];
		$foto_post = $info_post['foto'];
		$post = $info_post['post'];
		$id_user_postou = $info_post['id_user_postou'];
		$data = $info_post['data'];
		$f_nome = $info_post['f_nome'];
		$l_nome = $info_post['l_nome'];
		$id_user = $info_post['id_user'];
		$id_perfil = $info_post['id_perfil'];


		if (isset($_POST['btn_'.$id_post.''])) {
			mysqli_query($link, "INSERT INTO likes (id_user, id_post) VALUES ('".$_SESSION['user'][5]."', '$id_post')") or die(mysqli_error($link));
			header('Location: home.php');
			exit(0);
		}

		$query_likes = mysqli_query($link, "SELECT * FROM likes WHERE id_post='$id_post' AND id_user='".$_SESSION['user'][5]."'");
		


		?>
		<div class="comment-wrap">
			<a href="profile.php?id=<?php echo $id_user; ?>">
				<div class="photo">
					<div class="avatar zoom" style="background-image: url('<?php echo $foto_post; ?>')"></div>
				</div>
				<div class="comment-block">
					<h5><?php echo $f_nome." ".$l_nome; ?> </h5>
				</a>
				<p class="comment-text"><?php 
				echo $post; 
				$fotos = mysqli_query($link, "SELECT * FROM galeria WHERE id_post='$id_post'");
				if (mysqli_num_rows($fotos) > 0) {
					$info_fotos = mysqli_fetch_assoc($fotos);
					$foto_gal = $info_fotos['foto'];
					echo "<br><div class='text-center'><img src='$foto_gal' class='zoom img-thumbnail img-responsive' style='width: 400px'></div>";
				}
				?></p>
				<div class="bottom-comment">
					<div class="comment-date"><?php echo $data; ?></div>
					<ul class="comment-actions">
						<?php 
						if ($id_user_postou == $_SESSION['user'][5]) {
							echo '<li class="complain">
							<form method="POST">
							<button type="submit" name="apagar" class="btn btn-danger btn-sm">Apagar</button>
							<input type="hidden" name="hash_perf_19232" value="'. $id_post. '">
							</form>
							</li>';
						}
						?>
						<form method="POST">

							<button type="submit" name="btn_<?php echo $id_post; ?>" class="btn btn-info"><?php if (mysqli_num_rows($query_likes) == 1) { echo "Gostou <i class='fas fa-heart'>"; } else { echo "Gosto <i class='far fa-heart'>"; } ?></i>

							</button>
						</form>


						<li class="reply">Reply</li>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
	?>



	<?php include 'footer.php'; ?>