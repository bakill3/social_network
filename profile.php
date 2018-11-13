<?php 

include 'header.php'; 
if (isset($_GET['id'])) {
	$id_user = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$query = mysqli_query($link, "SELECT * FROM users WHERE id='$id_user' LIMIT 1");
	$info_user = mysqli_fetch_assoc($query);

	if (mysqli_num_rows($query) == 0) {
		echo "<script>window.location.href='home.php';</script>";
	}
	$email = $info_user['email'];
	$nome = $info_user['f_nome'];
	$apelido = $info_user['l_nome'];
	$idade = $info_user['idade'];
	$username = $info_user['username'];
	$sobre = $info_user['sobre'];
	$foto = $info_user['foto'];
	$instagram = $info_user['instagram'];
	$facebook = $info_user['facebook'];
	$twitter = $info_user['twitter'];
	$id_estado = $info_user['id_estado'];
	$ativado = $info_user['ativado'];

	echo "<!-- ativado: $ativado -->";

} else {
	header('Location: index.php');
	exit(0);
}

?>

<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Fotos de <?php echo $nome." ".$apelido; ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php 

				echo "<div class='row'>";
				$query_fotos = mysqli_query($link, "SELECT * FROM galeria WHERE id_user='$id_user' ORDER BY id");
				if (mysqli_num_rows($query_fotos) > 0) {
					while ($info_fotos = mysqli_fetch_array($query_fotos)) {
						$src = $info_fotos['foto'];
						echo "<img data-src='$src' class='zoom img-thumbnail lazy_img' style='padding: 2%; width: 250px; height: 180px;'>";
					}
				} else {
					echo "Este utilizador não tem fotografias";
				}
				echo "</div>";

				?>

			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>

		</div>
	</div>
</div>




<style class="cp-pen-styles">html, body {
	background-color: #f0f2fa;
	font-family: "PT Sans", "Helvetica Neue", "Helvetica", "Roboto", "Arial", sans-serif;
	color: #555f77;
	-webkit-font-smoothing: antialiased;
}
</style>


<div class="row m-y-2" style="box-shadow: 0px 0px 10px 3px rgba(72, 72, 72, 0.6); padding: 3%; /* background-color: #f0f2fa;*/ background: rgba(30, 40, 51, 1);
color: white; border-radius: 13px;">
<div class="col-lg-4 pull-lg-8 text-center">

	<img data-src="<?php echo $foto; ?>" class="lazy_img" style="width: 250px; border-radius: 50%; height: 250px;" alt="avatar zoom">
	<br>
	<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success"><i class="far fa-images"></i> Fotos</a><br>
	<?php
	if (!empty($facebook)) {
		echo "
		<div style='display: inline-block;'>
		<a class='btn btn-primary' href='$facebook' target='_blank'><i class='fab fa-facebook'></i></a>
		</div>
		";
	}

	if (!empty($instagram)) {
		echo "
		<div style='display: inline-block;'>
		<a class='btn btn-warning' href='$instagram' target='_blank'><i class='fab fa-instagram'></i></a>
		</div>
		";
	}

	if (!empty($twitter)) {
		echo "
		<div style='display: inline-block;'>
		<a class='btn btn-info' href='$twitter' target='_blank'><i class='fab fa-twitter'></i></a>
		</div>
		";
	}

	?>



</div>
<div class="col-lg-8 push-lg-4">

	<div class="tab-content p-b-3">
		<div class="tab-pane active" id="profile">
			<div style="display: inline-block;">
				<h4 class="m-y-2 nome" id="<?php echo $nome." ".$apelido; ?>"><?php echo $nome." ".$apelido; ?></h4>
			</div>
			<div style="display: inline-block; padding-left: 1%; color: #ff0000cf;">
				<h6><span class="badge badge-danger" style="font-size: 100%;">@<?php echo $username; ?></span></h6>
			</div>
			<div class="row">
				<div class="col-md-6">
					<span class="text-muted">Sobre</span>
					<div style="margin-left: 5%;">
						<p>
							<?php echo $sobre; ?>
						</p>
					</div>
					<span class="text-muted">Estado Civil</span>
					<div style="margin-left: 5%;">
						<?php
						$estado_query = mysqli_query($link, "SELECT * FROM estado_civil WHERE id_estado='$id_estado'");
						$info_estado = mysqli_fetch_assoc($estado_query);
						echo "<span class='badge badge-success'>".$info_estado['estado']."</span>";
						?>
					</div>
					<span class="text-muted">Hobbies</span>
					<div style="margin-left: 5%;">
						<p>
							<?php 
							$query = mysqli_query($link, "SELECT * FROM hobbies INNER JOIN hobbie_user ON hobbies.id = hobbie_user.id_hobbie WHERE id_user = '$id_user'");
							$conta_hobbies = mysqli_num_rows($query);
							$i_hobbie = 1;
							if ($conta_hobbies == 0) {
								echo "$nome não tem hobbies.";
							} else {
								echo "$nome gosta de ";
								while ($info_hob = mysqli_fetch_array($query)) {
									$badges=array("primary", "warning", "info", "light", "secondary", "danger");
									$hobbie = $info_hob['hobbie'];
									if ($i_hobbie == $conta_hobbies) {
										echo "<span class='badge badge-".$badges[array_rand($badges)]."'>".$hobbie. "</span>."; 
									} else {
										echo "<span class='badge badge-".$badges[array_rand($badges)]."'>".$hobbie. "</span>, "; 
									}

									$i_hobbie++;
								}
							}
							?>

						</p>
					</div>
				</div>
				<div class="col-md-6">
					<?php
					if ($id_user == $_SESSION['user'][5]) {
						?>
						<a href="settings.php" class="btn btn-lg btn-primary" style="width: 100%;">Editar Perfil <i class="fas fa-pencil-alt"></i></a>
						<?php
					} else {

						$query56 = mysqli_query($link, "SELECT * FROM seguidores WHERE id_user='$id_user' AND id_seguidor='".$_SESSION['user'][5]."'");
						if (mysqli_num_rows($query56) > 0) {
							?>
							<div style="width: 80%;display: inline-block;">
								<button class="btn btn-lg btn-danger seguir" style="width: 100%;" id="<?php echo $id_user; ?>">Não Seguir <i class="fas fa-user-times"></i></button>
							</div>
							<?php
						} else { 
							?>
							<div style="width: 80%;display: inline-block;">
								<button class="btn btn-lg btn-primary seguir" style="width: 100%;" id="<?php echo $id_user; ?>">Seguir <i class="fas fa-user-plus"></i></button>
							</div>
							<?php
						}
						?>

						<div style="width: 18%; display: inline-block;">
							<form method="POST">
								<!-- <a target="_blank" href="message.php?id=<?php echo $id_user; ?>" class="btn btn-lg btn-warning"><i class="fas fa-comments"></i></a> -->
								<button type="submit" class="btn btn-lg btn-warning" name="mensagem"><i class="fas fa-comments"></i></button>
								<input type="hidden" name="user" value="<?php echo $id_user; ?>">
								<input type="hidden" name="user2" value="<?php echo $foto; ?>">
							</form>
						</div>
						<?php
					}
					?>
					<hr>
					<?php

					$query555 = mysqli_query($link, "SELECT * FROM seguidores WHERE id_user='$id_user'");

					?>
					<span class="tag tag-primary seguidores" id="<?php echo mysqli_num_rows($query555); ?>"><i class="fa fa-user" style="color: #007bff;"></i> <?php echo mysqli_num_rows($query555); ?> Seguidores</span>
					<span class="tag tag-success"><i class="fa fa-cog" style="color: #007bff;"></i> 43 Estrelas</span>
					<span class="tag tag-danger"><i class="fa fa-eye" style="color: #007bff;"></i> 245 Views</span>
				</div>
				<?php
				/*
				if (!empty($facebook)) {
					echo "
					<div style='display: inline-block;'>
					<a class='btn' href='$facebook' target='_blank'><i class='fab fa-facebook'></i></a>
					</div>
					";
				}

				if (!empty($instagram)) {
					echo "
					<div style='display: inline-block;'>
					<a class='btn' href='$instagram' target='_blank'><i class='fab fa-instagram'></i></a>
					</div>
					";
				}

				if (!empty($twitter)) {
					echo "
					<div style='display: inline-block;'>
					<a class='btn' href='$twitter' target='_blank'><i class='fab fa-twitter'></i></a>
					</div>
					";
				}
				*/

				?>
				<div class="col-md-12">
                            <!--
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  ...
                                </div>
                              </div>
                            </div>
                        -->
                        <!-- <a href="#" data-toggle="modal" data-target="#myModal"><h4 class="m-t-2"><i class="far fa-images"></i> Fotos</h4></a> -->

                        <?php 
                        echo "<div class='row'>";
                        $query_fotos = mysqli_query($link, "SELECT * FROM galeria WHERE id_user='$id_user' ORDER BY id LIMIT 3");
                        if (mysqli_num_rows($query_fotos) > 0) {
                        	while ($info_fotos = mysqli_fetch_array($query_fotos)) {
                        		$src = $info_fotos['foto'];
                        		echo "<div style='padding: 0 2% 0 2%;'><img data-src='$src' class='zoom img-thumbnail lazy_img' style='padding: 5px; width: 180px; height: 150px;border-radius: 20%;'></div>";
                        	}
                        } else {
                        	echo "Este utilizador não tem fotografias";
                        }
                        echo "</div>";
                            /*
                            <table class="table table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            */ ?>
                        </div>
                    </div>
                    <!--/row-->
                </div>



            </div>
        </div>
        <hr>


        <div class="comments">
        	<form method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        		<div class="comment-wrap">
                        <!--
                        <div class="photo">
                          <div class="avatar" style="background-image: url('<?php echo $foto_header; ?>')"></div>
                        </div>
                    -->
                    <div class="comment-block" style="box-shadow: 0 0 10px 3px rgba(0, 0, 0, 0.8);">
                    	<div class="form-group">
                    		<textarea class="form-control emoji" name="post" cols="30" rows="3" placeholder="Publica..."></textarea>
                    	</div>

                    	<div class="custom-file">
                    		<input type="file" class="custom-file-input" id="validatedCustomFile" name="file">
                    		<label class="custom-file-label" for="validatedCustomFile">Imagem ou GIF...</label>
                    	</div>
                    	<div class="text-right" style="padding-top: 1%;"> <button type="submit" name="postar" class="btn btn-success btn-lg">Postar <i class="fas fa-check"></i></button> </div>

                    </div>

                </div>
                <input type="hidden" name="hash_perf_19230" value="<?php echo $id_user; ?>">
            </form>
            <?php 



            $query = mysqli_query($link, "SELECT posts.id AS id_post, users.foto AS foto, users.l_nome, users.f_nome, id_perfil, id_user_postou, post, data FROM posts INNER JOIN users ON posts.id_user_postou = users.id WHERE id_perfil='$id_user' ORDER BY data DESC");
            if (mysqli_num_rows($query) > 0) {
            	while ($info_post = mysqli_fetch_array($query)) {
            		$id_post = $info_post['id_post'];
            		$foto_post = $info_post['foto'];
            		$post = $info_post['post'];
            		$id_user_postou = $info_post['id_user_postou'];
            		$data = $info_post['data'];
            		$f_nome = $info_post['f_nome'];
            		$l_nome = $info_post['l_nome'];


            		?>



            		<a href="profile.php?id=<?php echo $id_user_postou; ?>">
            			<div class="comment-wrap">
            				<div class="comment-block" style="box-shadow: 0 0 10px 3px rgba(0, 0, 0, 0.8); position: relative;">

            					<?php
            					if ($id_user_postou == $_SESSION['user'][5]) {
            						echo '<form method="POST" style="display: inline-block;position: absolute;right: 1%;">
            						<button type="submit" name="apagar" class="btn btn-danger btn-sm"><i class="fal fa-trash-alt"></i></button>
            						<input type="hidden" name="hash_perf_19232" value="'. $id_post. '">
            						</form>';
            					}
            					?>


            					<div class='photo' style='display: inline-block;'>
            						<img class='avatar zoom' src='<?php echo $foto_post; ?>' alt='<?php echo $f_nome." ".$l_nome; ?>'>
            					</div>

            					<div style='display: inline-block;'>
            						<h5 class='h5_sp'> <?php echo $f_nome." ".$l_nome; ?> </h5>
            					</div>
            				</a>
            				<p class="comment-text" style="color: black;">
            					<?php 
            					echo $post; 
            					$fotos = mysqli_query($link, "SELECT * FROM galeria WHERE id_post='$id_post'");
            					if (mysqli_num_rows($fotos) > 0) {
            						$info_fotos = mysqli_fetch_assoc($fotos);
            						$foto_gal = $info_fotos['foto'];
            						echo "<br><div class='text-center'><img data-src='$foto_gal' class='zoom img-thumbnail img-responsive lazy_img' style='width: 400px' alt='Foto'></div>";
            					}
            					?>

            				</p>
            				<div class="bottom-comment">
            					<div class="comment-date"><?php echo $data; ?></div>
            					<ul class="comment-actions">
            						<?php 
            						$likes = mysqli_query($link, "SELECT * FROM likes WHERE id_post='$id_post'");
            						$contagem = mysqli_num_rows($likes);
            						if ($contagem > 0) {
            							echo "<span style='font-size: 120%; color: black;' class='font-weight-bold'>". $contagem."</span><i class='fas fa-heart' style='color: #ff5722ed;'></i>";
            						}
            						$query_likes = mysqli_query($link, "SELECT * FROM likes WHERE id_post='$id_post' AND id_user='".$_SESSION['user'][5]."'");
            						if (mysqli_num_rows($query_likes) == 0) {
            							?>
            							<button type="button" class="gostar btn btn-primary" id="<?php echo $id_post; ?>"><i class="far fa-heart"></i></button>
            							<?php
            						} else { 
            							?>
            							<button type="button" class="gostar btn btn-primary" id="<?php echo $id_post; ?>"><i class="fas fa-heart"></i></button>
            							<?php
            						}
            						?>

            					</ul>
            				</div>
            			</div>
            		</div>
            		<?php
            	}
            }
            ?>



        </div>
        <?php include 'footer.php'; ?>