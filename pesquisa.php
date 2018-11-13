<?php 
include 'header.php'; 
echo "<div class='text-center' style='background-color: #f0f2fa; box-shadow: 0px 0px 10px 3px rgba(72, 72, 72, 0.6);'>";
if (isset($_GET['s'])) {
	$pesquisa = htmlspecialchars(mysqli_real_escape_string($link, $_GET['s']));
	$query = mysqli_query($link, "SELECT * FROM users WHERE f_nome LIKE '%$pesquisa%' OR l_nome LIKE '%$pesquisa%' OR username LIKE '%$pesquisa%'") or die(mysqli_error($link));
	if (mysqli_num_rows($query) > 0) { 
		while ($info_user = mysqli_fetch_array($query)) {
			$id_user = $info_user['id'];
			$foto = $info_user['foto'];
			$nome = $info_user['f_nome'];
			$apelido = $info_user['l_nome'];
			$sobre = $info_user['sobre'];
			?>
			<div style="display: inline-block; padding: 2%;">
			<div class="card" style="width: 18rem;">
				<img class="card-img-top" src="<?php echo $foto; ?>" alt="Card image cap" style="height: 280px;">
				<div class="card-body">
					<h5 class="card-title"><?php echo $nome." ".$apelido; ?></h5>
					<p class="card-text"><?php echo $sobre; ?></p>
					<a href="profile.php?id=<?php echo $id_user; ?>" class="btn btn-primary">Perfil</a>
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