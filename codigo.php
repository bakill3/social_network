<?php
include 'ligar_db.php'; 

include_once 'phpmailer/PHPMailerAutoload.php'; //LIVRARIA PHPMAILER

$ip_do_user = $_SERVER['REMOTE_ADDR'];

//echo $ip_do_user;

$data_atual = date("Y-m-d H:i:s");
//PESQUISA
if (isset($_POST['search'])) {
	$pesquisa = htmlspecialchars(mysqli_real_escape_string($link, $_POST['search']));

	header("Location: pesquisa.php?s=".$pesquisa."");
	exit(0);
}
//REGISTO
if (isset($_POST['registo'])) {
	$email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
	$f_nome = htmlspecialchars(mysqli_real_escape_string($link, $_POST['f_nome']));
	$l_nome = htmlspecialchars(mysqli_real_escape_string($link, $_POST['l_nome']));
	$idade = htmlspecialchars(mysqli_real_escape_string($link, $_POST['idade'])); //NUMERIC
	$username = htmlspecialchars(mysqli_real_escape_string($link, $_POST['username']));
	$pass1 = htmlspecialchars(mysqli_real_escape_string($link, $_POST['pass_1']));
	$pass2 =htmlspecialchars( mysqli_real_escape_string($link, $_POST['pass_2']));




	if (!empty($email) && !empty($f_nome) && !empty($l_nome) && is_numeric($idade) && !empty($username) && !empty($pass1) && !empty($pass2)) {

		$query_vef = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) && mysqli_num_rows($query_vef) == 0) {

			$_SESSION['erro'] = "Invalid Email";
			header('Location: registo.php');
			exit(0);

		} elseif($idade < 13) {
			$_SESSION['erro'] = "You must be at least 13 years old.";
			header('Location: registo.php');
			exit(0);
		} elseif($pass1 != $pass2) {
			$_SESSION['erro'] = "Password don't match!";
			header('Location: registo.php');
			exit(0);
		} else {
			$query = mysqli_query($link, "SELECT * FROM users WHERE username = '$username' || email='$email'");
			if (mysqli_num_rows($query) == 1) {
				$_SESSION['erro'] = "Username/Email in use!";
				header('Location: registo.php');
				exit(0);
			} else {
				$password = password_hash($pass1 , PASSWORD_DEFAULT);

				$digitos = 8;
				$token = rand(pow(10, $digitos-1), pow(10, $digitos)-1);

				mysqli_query($link, "INSERT INTO users (email, f_nome, l_nome, idade, username, password, token, ip, id_estado) VALUES ('$email', '$f_nome', '$l_nome', '$idade', '$username', '$password', '$token', '$ip_do_user', '1')") or die(mysqli_error($link));

				$_SESSION['erro'] = "Confirm your account via email.";

				
				$mail = new PHPMailer;
				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'socialsivex.com';              // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'admin@socialsivex.com'; // your email id
				$mail->Password = 'Gabriel124'; // your password
				$mail->SMTPSecure = 'ssl';                  
				$mail->Port = 465;     //587 is used for Outgoing Mail (SMTP) Server.
				$mail->setFrom('admin@socialsivex.com', 'Sivex Social Network');
				$mail->addAddress($email);   // Add a recipient
				$mail->isHTML(true);  // Set email format to HTML

				$bodyContent = '<h1>Registo com Sucesso</h1>';
				$bodyContent .= '<p>O seu registo foi completo. Ative agora a sua <a href="https://socialsivex.com/ativar.php?token='.$token.'">Conta</a>';
				$mail->Subject = 'Sivex - Registo Concluido';
				$mail->Body    = $bodyContent;
				if(!$mail->send()) {

				} else {
					
				}

				header('Location: registo.php');
				exit(0);

			}
			
		}

	} else {
		$_SESSION['erro'] = "Fill all the inputs!";
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
				$_SESSION['erro'] = "Activate your account by email.";
				header('Location: index.php');
				exit(0);
			}
			

		} else {
			$_SESSION['erro'] = "Email/Password incorrect.";
			header('Location: index.php');
			exit(0);
		}

	} else {
		$_SESSION['erro'] = "Fill all inputs.";
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
			//$id_link = preg_replace("#youtube\.com/watch?v=#" , "", $link);
			if (strpos($post, 'youtube.com') !== false) {
				$id_link = preg_replace("#youtube\.com/watch?v=#" , "", $post);
				$post = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class=\"text-center embed-responsive embed-responsive-21by9\" width=\"425\" height=\"344\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>", $post);

				//$post = preg_replace('"\b(https?://\S+)"', '<div class="text-center embed-responsive embed-responsive-21by9"><iframe class="embed-responsive-item" width="425" height="344" src="https://www.youtube.com/embed/'.$id_link.'" frameborder="0" title="Video" allowfullscreen></iframe></div></a>', $post);
			}
			//$post = preg_replace('"\b(https?://\S+)"', '<div class="text-center embed-responsive embed-responsive-21by9"><iframe class="embed-responsive-item" width="425" height="344" src="$1" frameborder="0" title="Video" allowfullscreen></iframe></div></a>', $post);
			





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
		$_SESSION['sucesso'] = "Post Published!";
	} else {
		$_SESSION['erro'] = "Fill the Postbox!";
	}

	
	header("Location: profile/".$id_perfil."");
	exit(0);
}

if (isset($_POST['apagar'])) {
	$id_post = mysqli_real_escape_string($link, $_POST['hash_perf_19232']);
	$id_user_postado = mysqli_real_escape_string($link, $_POST['hash_perf_19234']);

	$query = mysqli_query($link, "SELECT * FROM posts WHERE id_user_postou = '". $_SESSION['user'][5]. "' AND id = '$id_post'");
	if (mysqli_num_rows($query) > 0) {
		mysqli_query($link, "DELETE FROM posts WHERE id = '$id_post'");
	} else {	
		$_SESSION['erro'] = "Keep trying script kiddie!";
	}
	if (!empty($id_user_postado)) {
		header("Location: profile/".$id_user_postado."");
	} else {
		header("Location: /verao/en/home.php");
	}
	$_SESSION['info'] = "Comentário apagado!";
	
	exit(0);

}

if (isset($_POST['mensagem'])) {
	$id_user_mensage = mysqli_real_escape_string($link, $_POST['user_id']);
	$user_photo = mysqli_real_escape_string($link, $_POST['user_photo']);
	$user_nome = mysqli_real_escape_string($link, $_POST['user_nome']);
	$user_apelido = mysqli_real_escape_string($link, $_POST['user_apelido']);
	$_SESSION['mensagem'] = array($id_user_mensage, $user_photo, $user_nome, $user_apelido);
	header('Location: /verao/en/mensagens.php');
	exit(0);
}

?>