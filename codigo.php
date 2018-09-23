<?php
include 'ligar_db.php'; 

include_once 'phpmailer/PHPMailerAutoload.php'; //LIVRARIA PHPMAILER

$data_atual = date("Y-m-d H:i:s");
//PESQUISA
if (isset($_POST['search'])) {
	$pesquisa = htmlspecialchars(mysqli_real_escape_string($link, $_POST['search']));

	header("Location: pesquisa.php?s=".$pesquisa."");
	exit(0);
}
//REGISTO
if (isset($_POST['registo'])) {
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$f_nome = mysqli_real_escape_string($link, $_POST['f_nome']);
	$l_nome = mysqli_real_escape_string($link, $_POST['l_nome']);
	$idade = mysqli_real_escape_string($link, $_POST['idade']); //NUMERIC
	$username = mysqli_real_escape_string($link, $_POST['username']);
	$pass1 = mysqli_real_escape_string($link, $_POST['pass_1']);
	$pass2 = mysqli_real_escape_string($link, $_POST['pass_2']);




	if (!empty($email) && !empty($f_nome) && !empty($l_nome) && is_numeric($idade) && !empty($username) && !empty($pass1) && !empty($pass2)) {

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$_SESSION['erro'] = "Email Inválido";
			header('Location: registo.php');
			exit(0);

		} elseif($idade < 13) {
			$_SESSION['erro'] = "Tem de ter pelo menos 13 anos para se registar";
			header('Location: registo.php');
			exit(0);
		} elseif($pass1 != $pass2) {
			$_SESSION['erro'] = "As passwords não correspondem!";
			header('Location: registo.php');
			exit(0);
		} else {
			$query = mysqli_query($link, "SELECT * FROM users WHERE username = '$username'");
			if (mysqli_num_rows($query) == 1) {
				$_SESSION['erro'] = "Username já em uso!";
				header('Location: registo.php');
				exit(0);
			} else {
				$password = password_hash($pass1 , PASSWORD_DEFAULT);

				$digitos = 8;
				$token = rand(pow(10, $digitos-1), pow(10, $digitos)-1);

				mysqli_query($link, "INSERT INTO users (email, f_nome, l_nome, idade, username, password, token) VALUES ('$email', '$f_nome', '$l_nome', '$idade', '$username', '$password', '$token')") or die(mysqli_error($link));

				$_SESSION['erro'] = "Confirma a tua conta verificando o teu email";

				
				$mail = new PHPMailer;
				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'lifepageshop123@gmail.com'; // your email id
				$mail->Password = 'flash136'; // your password
				$mail->SMTPSecure = 'tls';                  
				$mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
				$mail->setFrom('lifepageshop123@gmail.com', 'Sivex Social Network');
				$mail->addAddress($email);   // Add a recipient
				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent = '<h1>Registo com Sucesso</h1>';
				$bodyContent .= '<p>O seu registo foi completo. Ative agora a sua <a href="http://sivex.zapto.org/verao/ativar.php?token='.$token.'">Conta</a>';
				$mail->Subject = 'Sivex - Registo Concluido';
				$mail->Body    = $bodyContent;
				if(!$mail->send()) {

				} else {
					
				}

				header('Location: index.php');
				exit(0);

			}
			
		}

	} else {
		$_SESSION['erro'] = "Preencha todos os dados!";
		header('Location: registo.php');
		exit(0);
	}

}

//LOGIN

if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$password = mysqli_real_escape_string($link, $_POST['password']);

	if (!empty($email) && !empty($password)) {



		$query = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
		$info_query = mysqli_fetch_assoc($query);
		$pass_db = $info_query['password'];
		$ativado = $info_query['ativado'];


		if (mysqli_num_rows($query) == 1 && password_verify($password, $pass_db)) {
			if ($ativado == 1) {
				$id_user = $info_query['id'];
				$f_nome = $info_query['f_nome'];
				$l_nome = $info_query['l_nome'];
				$idade = $info_query['idade'];
				$username = $info_query['username'];

				$_SESSION['user'] = array($email, $f_nome, $l_nome, $idade, $username, $id_user);

				header('Location: home.php');
				exit(0);
			} else {
				$_SESSION['erro'] = "Ative a sua conta pelo email.";
				header('Location: index.php');
				exit(0);
			}
			

		} else {
			$_SESSION['erro'] = "Email/Password incorreto(s)";
			header('Location: index.php');
			exit(0);
		}

	} else {
		$_SESSION['erro'] = "Preencha todos os dados";
		header('Location: index.php');
		exit(0);
	}
	$_SESSION['erro'] = $email;
}

if (isset($_POST['postar'])) {
	$id_perfil = mysqli_real_escape_string($link, $_POST['hash_perf_19230']);
	$id_user = $_SESSION['user'][5];
	$post = htmlspecialchars(mysqli_real_escape_string($link, $_POST['post']));

	$len_post = strlen($post);

	if (!empty($post)) {
		if ($len_post > 0) {

			$post = preg_replace('"\b(https?://\S+)"', '<div class="text-center embed-responsive embed-responsive-21by9"><iframe class="embed-responsive-item" width="425" height="344" src="$1" frameborder="0" title="Video" allowfullscreen></iframe></div></a>', $post);


			mysqli_query($link, "INSERT INTO posts (id_user_postou, id_perfil, post, data) VALUES ('$id_user', '$id_perfil', '$post', '$data_atual')") or die(mysqli_error($link));

			mysqli_query($link, "INSERT INTO notificacoes (sender, receiver, tipo) VALUES ('$id_user', '$id_perfil', 'post')") or die (mysqli_error($link));

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
		}
	}

	$_SESSION['sucesso'] = "Comentário publicado!";
	header("Location: profile.php?id=".$id_perfil."");
	exit(0);
}

if (isset($_POST['apagar'])) {
	$id_post = mysqli_real_escape_string($link, $_POST['hash_perf_19232']);
	$id_user_postado = mysqli_real_escape_string($link, $_POST['hash_perf_19234']);

	$query = mysqli_query($link, "SELECT * FROM posts WHERE id_user_postou = '". $_SESSION['user'][5]. "' AND id = '$id_post'");
	if (mysqli_num_rows($query) > 0) {
		mysqli_query($link, "DELETE FROM posts WHERE id = '$id_post'");
	} else {	
		$_SESSION['erro'] = "Continua a tentar script kiddie!";
	}
	if (!empty($id_user_postado)) {
		header("Location: profile.php?id=".$id_user_postado."");
	} else {
		header("Location: home.php");
	}
	$_SESSION['info'] = "Comentário apagado!";
	
	exit(0);

}

?>