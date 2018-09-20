<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include 'codigo.php';
$btns=array("primary", "warning", "info", "default", "success", "dark");
$pagina = basename($_SERVER['PHP_SELF']);
if ($pagina != "index.php" && $pagina != "sobre.php" && $pagina != "registo.php" && $pagina != "sobre.php") {
	include 'validacao.php';
}

$url = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html>
<head>
	<script src="jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/main.min.css">
	<link href="fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Cache-control" content="no-cache">
	<title>Social Network</title>

	<?php
	if (isset($_POST['id_perfil_seg'])) {
		$id_perfil = mysqli_real_escape_string($link, $_POST['id_perfil_seg']);

  //SEGURANÇA

		$query55 = mysqli_query($link, "SELECT * FROM seguidores WHERE id_user='$id_perfil' AND id_seguidor='".$_SESSION['user'][5]."'");
		if (mysqli_num_rows($query55) > 0) {
			mysqli_query($link, "DELETE FROM seguidores WHERE id_user='$id_perfil' AND id_seguidor='".$_SESSION['user'][5]."'");
			mysqli_query($link, "DELETE FROM notificacoes WHERE sender='".$_SESSION['user'][5]."' AND receiver='$id_perfil'");

			echo "<div class='alert alert-primary' role='alert' id='alerta'>
			Começou a seguir.</div><script>myvar = setInterval(slidecima, 3000);
			function slidecima() {
				$('#alerta').fadeTo(2000, 500).slideUp(500, function(){
					$('#alerta').slideUp(500);
					});
					window.clearInterval(myvar);

				}
				</script>";

			} else {
				mysqli_query($link, "INSERT INTO seguidores (id_user, id_seguidor) VALUES ('$id_perfil', '".$_SESSION['user'][5]."')");
				mysqli_query($link, "INSERT INTO notificacoes (sender, receiver, tipo) VALUES ('".$_SESSION['user'][5]."', '$id_perfil', 'seguir')") or die (mysqli_error($link));


				echo "<div class='alert alert-primary' role='alert' id='alerta'>
				Deixou de seguir.</div><script>myvar = setInterval(slidecima, 3000);
				function slidecima() {
					$('#alerta').fadeTo(2000, 500).slideUp(500, function(){
						$('#alerta').slideUp(500);
						});
						window.clearInterval(myvar);

					}
					</script>";
				}

				header('Location: profile.php?id='.$id_perfil.'');
				exit(0);
			}



			if (isset($_POST['id_post_gostado'])) {
				$id_post_gosto = mysqli_real_escape_string($link, $_POST['id_post_gostado']);

  //SEGURANÇA

				$info_user_postou = mysqli_query($link, "SELECT id_user_postou FROM posts WHERE id='$id_post_gosto' LIMIT 1");
				$inf = mysqli_fetch_assoc($info_user_postou);
				$id_user_postou = $inf['id_user_postou'];


				$busca = mysqli_query($link, "SELECT * FROM likes WHERE id_user='".$_SESSION['user'][5]."' AND id_post='$id_post_gosto'");
				if (mysqli_num_rows($busca) == 1) {
					mysqli_query($link, "DELETE FROM likes WHERE id_user='".$_SESSION['user'][5]."' AND id_post='$id_post_gosto'");
					mysqli_query($link, "DELETE FROM notificacoes WHERE sender='".$_SESSION['user'][5]."' AND receiver='$id_user_postou'");
    //echo "<script>alert('Continua a tentar, script kiddie!');</script>";
				} else {
					mysqli_query($link, "INSERT INTO likes (id_user, id_post) VALUES ('".$_SESSION['user'][5]."', '$id_post_gosto')") or die(mysqli_error($link));
					mysqli_query($link, "INSERT INTO notificacoes (sender, receiver, tipo) VALUES ('".$_SESSION['user'][5]."', '$id_user_postou', 'like')") or die (mysqli_error($link));


				}
				header('Location: home.php');
				exit(0);
			}
			?>
		</head>
		<body <?php if ($pagina == 'index.php' || $pagina == 'registo.php' || $pagina == 'home.php') { ?> style="background: url('https://wallpapersite.com/images/wallpapers/blur-background-3840x2160-spectrum-electromagnetic-4k-901.jpg'); background-repeat: no-repeat;
		background-attachment: fixed;
		background-position: center;
		background-size: cover" <?php } ?> >
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="index.php">SiveX</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>


			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<?php if (isset($_SESSION['user'])) { ?>

							<a class="nav-link" href="home.php">Início <span class="sr-only">(current)</span></a>

						<?php } else { ?>

							<a class="nav-link" href="index.php">Início <span class="sr-only">(current)</span></a>

						<?php } ?>

					</li>
					<li class="nav-item">
						<a class="nav-link" href="sobre.php">Sobre</a>
					</li>
					<script>
						function pesquisar() {
							document.onkeydown=function(evt){
								var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
								if(keyCode == 13)
								{
									document.pesquisa.submit();
								}
							}
						}
					</script>
					<?php
					if (isset($_SESSION['user'])) {
						?>
						<li>
							<form name="pesquisa" method="POST" autocomplete="off">
								<input id="search_text" type="text" name="search" class="form-control" placeholder="Pesquisar.." onblur="pesquisar(this)">
							</form>
							<div style="position: absolute; z-index: 2;" id="result"></div>
							<script type="text/javascript">
								$(document).ready(function(){
									load_data();
									function load_data(query)
									{
										$.ajax({
											url:"fetch2.php",
											method:"post",
											data:{query:query},
											success:function(data)
											{
												$('#result').html(data);
											}
										});
									}

									$('#search_text').keyup(function(){
										var search = $(this).val();
										if(search != '')
										{
											load_data(search);
										}
										else
										{
											load_data();            
										}
									});
								});


							</script>

						</li>

						<?php
					}
					?>
					<div style="position: fixed; bottom: 0; left: 0;">
						<div id="google_translate_element"></div><script type="text/javascript">
							function googleTranslateElementInit() {
								new google.translate.TranslateElement({pageLanguage: 'pt', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
							}
						</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
					</div>

				</ul> 


    <?php /*
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    */ ?>


    <?php
    if (isset($_SESSION['user'])) {
    	?>
    	<div style="display: inline-block;">

    		<i class="far fa-bell"></i><span class="badge badge-light menino"><?php if (isset($_SESSION['notificacao'])) { echo $_SESSION['notificacao']; } ?></span>


    	</div>

    	<?php
    }
    ?>
    <div class="dropdown show">
    	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">
    			<?php
    			if (isset($_SESSION['user'])) {
    				$id = $username = $_SESSION['user'][5];
    				$sel = mysqli_query($link, "SELECT foto FROM users WHERE id='$id'");
    				$info_sel = mysqli_fetch_assoc($sel);

    				$foto_header = $info_sel['foto'];
    				if ($foto_header == "imagens/avatar.png") {
    					echo '<i class="fas fa-user"></i>';
    				} else {
    					echo "<img data-src='$foto_header' class='img-responsive rounded-circle lazy_img' alt='Avatar' style='width: 30px;'>";

    				}
    			} else {
    				echo '<i class="fas fa-user"></i>';
    			}
    			?>


    		</button>
    	</a>

    	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

    		<?php if (isset($_SESSION['user'])) { 


    			?>

    			<a class="dropdown-item" href="profile.php?id=<?php echo $id; ?>">Perfil</a>
    			<a class="dropdown-item" href="settings.php">Definições</a>
    		<?php } else { ?>
    			<a class="dropdown-item" href="index.php">Login</a>
    			<a class="dropdown-item" href="registo.php">Registo</a>
    		<?php } ?>
    		<div class="dropdown-divider"></div>
    		<?php if (isset($_SESSION['user'])) { ?>
    			<a class="dropdown-item" href="logout.php" style="background-color: #ff2d2dc2;">Sair</a>
    		<?php } else { ?>
    			<a class="dropdown-item" href="#">Sobre</a>
    		<?php } ?>
    	</div>
    </div>
</nav>
</div>

<div class="container" style="padding-top: 2%;">
	<?php
	if (isset($_SESSION['erro'])) {
		echo "<div class='alert alert-danger' role='alert'>
		".$_SESSION['erro']. "</div>";
		unset($_SESSION['erro']);
	}

	if (isset($_SESSION['info'])) {
		echo "<div class='alert alert-primary' role='alert' id='alerta'>
		".$_SESSION['info']. "</div><script>myvar = setInterval(slidecima, 3000);
		function slidecima() {
			$('#alerta').fadeTo(2000, 500).slideUp(500, function(){
				$('#alerta').slideUp(500);
				});
				window.clearInterval(myvar);

			}
			</script>";
			unset($_SESSION['info']);
		}

		if (isset($_SESSION['sucesso'])) {
			echo "<div class='alert alert-success' role='alert' id='alerta'>
			".$_SESSION['sucesso']. "</div><script>myvar = setInterval(slidecima, 3000);
			function slidecima() {
				$('#alerta').fadeTo(2000, 500).slideUp(500, function(){
					$('#alerta').slideUp(500);
					});
					window.clearInterval(myvar);

				}
				</script>";
				unset($_SESSION['sucesso']);
			}
			?>
			<?php
			if (isset($_SESSION['user'])) {
				?>
				<div id="alert_popover">
					<div class="wrapper">
						<div class="content">

						</div>
					</div>
				</div>
				<?php
			}
			?>