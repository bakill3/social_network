<?php 

include 'header.php'; 

if (isset($_SESSION['user'])) {
	header('Location: home.php');
	exit(0);
}
?>

	<div class="bem_vindo">
		<h1 class="text-white text-center"><span class="texto_nice">Registo</span><br></h1>
		<p class="text-white text-center">Rede social em desenvolvimento. Testa á vontade!</p>
		<br>

		<div class="formulario_main">
			<form method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1"><i class="far fa-envelope"></i> Email</label>
					<input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1"><i class="far fa-user"></i> Nome</label>
					<input type="text" class="form-control" name="f_nome" placeholder="Primeiro Nome">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1"><i class="fas fa-user"></i> Apelido</label>
					<input type="text" class="form-control" name="l_nome" placeholder="Apelido">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1"><i class="fas fa-sort-numeric-up"></i> Idade</label>
					<input type="number" min="13" class="form-control" name="idade" placeholder="Idade">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1"><i class="far fa-user"></i> Nome de Utilizador</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					    	<span class="input-group-text" id="basic-addon1">@</span>
					  	</div>
						<input type="text" class="form-control" name="username" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1"><i class="fas fa-key"></i> Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="pass_1" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1"><i class="fas fa-key"></i> Repetir Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" name="pass_2" placeholder="Repetir Password">
				</div>
				<div class="text-center">
					<button type="submit" name="registo" class="btn btn-<?php echo $btns[array_rand($btns)]; ?> btn-lg" style="width: 80%;">Registar</button>
					<br>
					
				</div>
				<div class="text-center text-primary" style="padding-top: 3%;">
					<a href="index.php">Login</a>
				</div>
			</form>

		</div>

<?php include 'footer.php'; ?>