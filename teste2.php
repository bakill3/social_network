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
			$modo = "posted on your profile";
		} elseif ($tipo == "like") {
			$modo = "liked your post";
		} elseif($tipo == "mensagem") {
			echo "<script>
			if($('#msm_".$id_user_notificacao."').length) {
				
			} else {
				var btns = Array('primary', 'warning', 'info', 'default', 'success', 'dark');
				var rand_btn = btns[Math.floor(Math.random()*btns.length)];
				$('#mensagens_dinamicas').append('<div class=\"col-md-2\" style=\"display: inline-block;\" id=\"msm_".$id_user_notificacao."\"><div class=\"panel-collapse collapse\" id=\"collapse_".$id_user_notificacao."\" style=\"    border-left: 1px solid;border-right: 1px solid;border-top: 1px solid; background-color: white;\"><div class=\"panel-body\" style=\"padding: 5%;\"><ul class=\"chat mensagens_new\"></ul></div><div class=\"panel-footer\"><div class=\"input-group\"><textarea id=\"enviar\" type=\"text\" class=\"form-control input-sm \" placeholder=\"Fala com ".$row["f_nome"]." ".$row["l_nome"]."...\"></textarea><span class=\"input-group-btn\"><button class=\"btn btn-warning btn-sm\" id=\"btn-chat\" style=\"height: 100%;\"><i class=\"fas fa-comment\"></i></button></span></div></div></div><div class=\"panel panel-primary\"><div class=\"panel-heading\" id=\"accordion\"><div class=\"btn-group pull-right\" style=\"width: 100%;\"><a type=\"button\" style=\"width: 100%;\" class=\"btn btn-'+ rand_btn +' btn-xs\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse_".$id_user_notificacao."\">".$row["f_nome"]." ".$row["l_nome"]."</a><button type=\"button\" id=\"fechar_".$id_user_notificacao."\" style=\"padding-left: 90%;\">X</button></div></div></div></div>');
				
				$('#fechar_".$id_user_notificacao."').click(function(){
			        $('#msm_".$id_user_notificacao."').remove();
			    });
				//$('#body').html(box);
			}
			
			
			</script>";
			$modo = "<a href='mensagens.php'>sent you a message</a>";
		} else {
			$modo = "started following you";
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