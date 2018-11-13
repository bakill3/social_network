<?php 
include 'header.php'; 
if (isset($_SESSION['user'])) {
	echo "<script>window.location.href='home.php';</script>";
	//header('Location: home.php');
	//exit(0);
}
?>

	<div class="login-dark">
        <form method="post" style="background: rgba(30, 40, 51, 0.75);">
            <div class="illustration"><input class="form-control-plaintext bounce animated text-center display-3" type="text" value="Sivex" readonly="" style="color:rgb(255,255,255);font-size:30%;"><i class="fal fa-user"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="login">Iniciar Sessão</button></div><a href="registo.php" class="forgot" style="color:rgb(255,255,255);font-size:14px;">Registar-se</a></form>
    </div>
<script src="jquery.min.js"></script>
<script>
		$(document).ready(function(){
				if(navigator.geolocation){
					navigator.geolocation.getCurrentPosition(showLocation);
				}
		});

		function showLocation(position){

			var latitude = position.coords.latitude;
			var longitude = position.coords.longitude;

			$.ajax({
				type:'POST',
				url:'getlocation.php',
				data:'latitude='+latitude+'&longitude='+longitude,
				success:function(msg){
					
				}
			});
		}
</script>
<?php include 'footer.php'; ?>