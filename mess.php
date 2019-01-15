<?php
include 'ligar_db.php';
$user_to = htmlspecialchars(mysqli_real_escape_string($link, $_POST['other']));
$meu = $_SESSION['user'][5];
$query = mysqli_query($link, "SELECT * FROM users INNER JOIN messages ON users.id = messages.user_from WHERE messages.user_from = '$meu' AND messages.user_to = '$user_to' OR messages.user_from = '$user_to' AND messages.user_to = '$meu' ORDER BY messages.data ASC");



if (mysqli_num_rows($query) > 0) {
	while ($info = mysqli_fetch_array($query)) {
		$id_user = $info['id'];
		$foto = $info['foto'];
		$nome = $info['f_nome'];
		$apelido = $info['l_nome'];
		$message = $info['message'];
		$data = $info['data'];

		if ($id_user != $meu) {
			echo "<div class='incoming_msg postbi'>
			<div class='incoming_msg_img'> <a href='profile/$id_user' target='_blank'><img src='$foto' alt='$nome $apelido'> </a></div>
			<div class='received_msg'>
			<div class='received_withd_msg'>
			<p>$message</p>
			<span class='time_date'> $data</span></div>
			</div>
			</div>";
		} else {
			echo "<div class='outgoing_msg postbi' style='display: inline-block;'>
			<div class='incoming_msg_img' style='float: right; display: inline-block;'> <img src='$foto' alt='$nome $apelido'> </div>
			<div class='sent_msg' style='margin-right: 1%;'>
			<p>$message</p>
			
			<span class='time_date'> $data</span> </div>

			</div>";
		}

	}
}


?>