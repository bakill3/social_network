<?php
include 'codigo.php';
$query = "SELECT * FROM notificacoes INNER JOIN users ON notificacoes.sender = users.id WHERE receiver = '".$_SESSION['user'][5]."' AND vista = '0' ";
$result = mysqli_query($link, $query);
$output = '';
if (mysqli_num_rows($result) > 0) {
	$l = 0;
	while($row = mysqli_fetch_array($result))
	{
		$l++;
		$id_notificacao = $row['id_notificacao'];
		$foto = $row['foto'];
		$tipo = $row['tipo'];
		$id_user_notificacao = $row['id'];

		$href = "profile.php?id=".$_SESSION['user'][5]."";
		if ($tipo == "post") {
			$modo = "postou no seu perfil";
		} elseif ($tipo == "like") {
			$modo = "gostou da sua publicação";
		} else {
			$modo = "começou a seguir-te";
		}
		$output .= '
		<script>
		$( "#fechar_'.$id_notificacao.'" ).click(function() {
			var id_notificacao = $("#notificacao_'.$id_notificacao.'").val();
			$.ajax({
                url:"apaga_notificacao.php",
                method:"post",
                data: {id_notificacao: id_notificacao},
                success:function(data)
                {
                	
                }
              });
		})
		</script>
		<div class="alert alert_default">
		<a href="#" id="fechar_'.$id_notificacao.'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<input type="hidden" id="notificacao_'.$id_notificacao.'" value="'.$id_notificacao.'" />
		<img class="rounded-circle" style="width: 50px; display: inline-block;" src="'.$foto.'">
		<p style="display: inline-block; text-align: right;"><a href="profile.php?id='.$id_user_notificacao.'"><strong>'.$row["f_nome"]. " ". $row["l_nome"].'</strong></a>
		<small><em>'.$modo.'</em></small>
		</p>
		</div>
		';
	}
	$update_query = "UPDATE posts SET notificado = '1' WHERE notificado = '0'";
	//mysqli_query($link, $update_query);
	echo $output;
}

//if (isset($l)) {
//	echo "<script>$('.menino').html('".$l."');</script>";
	//echo $l;
//}



?>