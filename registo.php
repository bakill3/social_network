<?php 

include 'header.php'; 

if (isset($_SESSION['user'])) {
	echo "<script>window.location.href='home.php';</script>";
	//header('Location: home.php');
	//exit(0);
}
?>

<div class="login-dark postbi">
	<form method="POST" style="background-color:#1e2833; max-width: 900px !important;">
		<h2 class="sr-only">Login Form</h2>
		<div class="illustration"><input class="form-control-plaintext bounce animated text-center display-3" type="text" value="Sivex" readonly="" style="color:rgb(255,255,255);font-size:30%;"><i class="fal fa-lock-alt"></i></div>
		<div class="form-group">
			<label for="exampleInputEmail1"><i class="far fa-envelope"></i> Email</label>
			<input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><i class="far fa-user"></i> First Name</label>
			<input type="text" class="form-control" name="f_nome" placeholder="First name">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><i class="fas fa-user"></i> Surname</label>
			<input type="text" class="form-control" name="l_nome" placeholder="Surname">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><i class="fas fa-sort-numeric-up"></i> Age</label>
			<input type="number" min="13" class="form-control" name="idade" placeholder="Age">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><i class="far fa-user"></i> Username</label>
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
			<label for="exampleInputPassword1"><i class="fas fa-key"></i> Repeat Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name="pass_2" placeholder="Repetir Password">
		</div>
		<div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="registo">Register</button></div><a href="index.php" class="forgot" style="color:rgb(255,255,255);font-size:14px;">Sign In</a></form>
	</div>

	<?php include 'footer.php'; ?>