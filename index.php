<?php 
include 'header.php'; 
if (isset($_SESSION['user'])) {
	header('Location: home.php');
	exit(0);
}
?>

	<div class="bem_vindo">
		<h1 class="text-white text-center"><span class="texto_nice">Bem-Vindo </span><br></h1>
		<p class="text-white text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras aliquet nunc quis massa tempus blandit at eget diam.</p>
		<br>

		<div class="formulario_main">
			<form method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1"><i class="far fa-envelope"></i> Email</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1"><i class="fas fa-key"></i> Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-<?php echo $btns[array_rand($btns)]; ?> btn-lg" style="width: 80%;" name="login">Login</button>
					<br>
					
				</div>
				<div class="text-center text-primary" style="padding-top: 3%;">
					<a href="registo.php">Registo</a>
				</div>
			</form>

		</div>

<?php include 'footer.php'; ?>