<?php 
include 'header.php'; 
echo "<div class='text-center' style='background-color: #f0f2fa; box-shadow: 0px 0px 10px 3px rgba(72, 72, 72, 0.6);'>";
if (isset($_GET['s'])) {
	$pesquisa = htmlspecialchars(mysqli_real_escape_string($link, $_GET['s']));
	$query = mysqli_query($link, "SELECT * FROM users WHERE f_nome LIKE '%$pesquisa%' OR l_nome LIKE '%$pesquisa%' OR username LIKE '%$pesquisa%'") or die(mysqli_error($link));
	$conta = mysqli_num_rows($query);
	if ($conta > 0) { 
		echo "<p class='text-center postbi display-4 text-primary'><span class='text-danger'>$conta</span> Results Found</p>";
		while ($info_user = mysqli_fetch_array($query)) {
			$id_user = $info_user['id'];
			$foto = $info_user['foto'];
			$nome = $info_user['f_nome'];
			$apelido = $info_user['l_nome'];
			$sobre = $info_user['sobre'];
			?>
			<div style="display: inline-block; padding: 2%;" class="postbi">
				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="<?php echo $foto; ?>" alt="Card image cap" style="height: 280px;">
					<div class="card-body">
						<h5 class="card-title"><?php echo $nome." ".$apelido; ?></h5>
						<p class="card-text"><?php echo $sobre; ?></p>
						<a href="profile/<?php echo $id_user; ?>" class="btn btn-lg btn-primary" style="display: inline-block;"><i class="fa fa-user"></i></a>
						<form method="POST" style="display: inline-block;">
							<!-- <a target="_blank" href="message.php?id=<?php echo $id_user; ?>" class="btn btn-lg btn-warning"><i class="fas fa-comments"></i></a> -->
							<button type="submit" class="btn btn-lg btn-warning" name="mensagem"><i class="fas fa-comments"></i></button>
							<input type="hidden" name="user_id" value="<?php echo $id_user; ?>">
							<input type="hidden" name="user_photo" value="<?php echo $foto; ?>">
							<input type="hidden" name="user_nome" value="<?php echo $nome; ?>">
							<input type="hidden" name="user_apelido" value="<?php echo $apelido; ?>">
						</form>
					</div>
				</div>
			</div>
			<?php
		}
	} else {
		$_SESSION['alerta'] = "Não foram encontrados utilizadores."; 
	}
}
echo "</div>";
?>

<?php include 'footer.php'; ?>