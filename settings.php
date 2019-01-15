<?php 
include 'header.php'; 
$username = $_SESSION['user'][4];
$idade = $_SESSION['user'][3];
$id = $_SESSION['user'][5];

$busca_info = mysqli_query($link, "SELECT sobre, foto, instagram, facebook, twitter, id_estado FROM users WHERE id='$id' LIMIT 1");
$inf = mysqli_fetch_assoc($busca_info);

$sobre = $inf['sobre'];
$foto = $inf['foto'];

$facebook = $inf['facebook'];
$instagram = $inf['instagram'];
$twitter = $inf['twitter'];
$id_estado_user = $inf['id_estado'];

if (isset($_POST['mudar_info'])) {
	$email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
	$f_nome = htmlspecialchars(mysqli_real_escape_string($link, $_POST['f_nome']));
	$l_nome = htmlspecialchars(mysqli_real_escape_string($link, $_POST['l_nome']));
	$sobre = htmlspecialchars(mysqli_real_escape_string($link, $_POST['sobre']));

    $f_nome_conta = strlen($f_nome);
    $l_nome_conta = strlen($l_nome);

	$facebook = htmlspecialchars(mysqli_real_escape_string($link, $_POST['facebook']));
	$instagram = htmlspecialchars(mysqli_real_escape_string($link, $_POST['instagram']));
	$twitter = htmlspecialchars(mysqli_real_escape_string($link, $_POST['twitter']));

    $estado_civil = htmlspecialchars(mysqli_real_escape_string($link, $_POST['estado_civil']));


	if (!empty($email) && !empty($f_nome) && !empty($l_nome) && !empty($sobre) && !empty($estado_civil) && $estado_civil > 0 && $estado_civil < 4 && $f_nome_conta < 15 && $l_nome_conta < 15) {		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION['erro'] = "Email inválido";
		} else {

			/* HOBBIES */
			mysqli_query($link, "DELETE FROM hobbie_user WHERE id_user = '". $_SESSION['user'][5] ."'");
			foreach($_POST['hobbie'] as $hobbie){
				mysqli_query($link, "INSERT INTO hobbie_user(id_hobbie, id_user) VALUES ('$hobbie', '". $_SESSION['user'][5] ."')");
			}
			/* --------------------------- */
			

			$existe = "imagens/utilizadores/".$id."";
			if (!is_dir($existe)) {
				mkdir($existe);
			}
			$file_name = $_FILES['file']['name'];
			$file_type = $_FILES['file']['type'];
			$file_size = $_FILES['file']['size'];
			$file_tem_loc = $_FILES['file']['tmp_name'];
			$file_store = "imagens/utilizadores/".$id."/".$file_name;

			move_uploaded_file($file_tem_loc, $file_store);

			mysqli_query($link, "UPDATE users SET email='$email', f_nome='$f_nome', l_nome='$l_nome', sobre='$sobre', id_estado='$estado_civil' WHERE id='$id'") or die (mysqli_error($link));

			if (strpos($facebook, 'https://www.facebook.com/') !== false) {
				mysqli_query($link, "UPDATE users SET facebook='$facebook' WHERE id='$id'");
			}

			if (strpos($instagram, 'https://www.instagram.com/') !== false) {
				mysqli_query($link, "UPDATE users SET instagram='$instagram' WHERE id='$id'");
			}

			if (strpos($twitter, 'https://www.twitter.com/') !== false) {
				mysqli_query($link, "UPDATE users SET twitter='$twitter' WHERE id='$id'");
			}

			if (!empty($file_name)) {
				mysqli_query($link, "UPDATE users SET foto='$file_store' WHERE id='$id'") or die(mysqli_error($link));
			}

			$_SESSION['user'] = array($email, $f_nome, $l_nome, $idade, $username, $id);

		}
	} else {
		$_SESSION['erro'] = "Preencha tudo corretamente!";
	}
        
        echo "<script>window.location.href='settings.php';</script>";
        
    }
    ?>
    <div style="background-color: #f0f2fa; padding: 3%; border-radius: 2%;" class="postbi">
    	<form method="POST" enctype="multipart/form-data"> 
    		<h2 class="text-center">Settings</h2>
    		<hr>
    		<div class="form-group">
    			<label>Email</label>
    			<input type="email" name="email" class="form-control" value="<?php echo $_SESSION['user'][0]; ?>">
    		</div>
    		<div class="form-group">
    			<label>First Name</label>
    			<input type="text" name="f_nome" class="form-control emoji" value="<?php echo $_SESSION['user'][1]; ?>">
    		</div>
    		<div class="form-group">
    			<label>Surname</label>
    			<input type="text" name="l_nome" class="form-control emoji" value="<?php echo $_SESSION['user'][2]; ?>">
    		</div>
    		<div class="form-group">
    			<label>About</label>
    			<textarea class="form-contol emoji" name="sobre" style="width: 100%;"><?php echo $sobre; ?></textarea>
    		</div>
    		<table class="table table-striped table-dark">
    			<thead>
    				<tr>
    					<td>Hobbie</td>
    					<td>Active</td>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
    				$query = mysqli_query($link, "SELECT * FROM hobbies");
    				if (mysqli_num_rows($query) > 0) {
    					while ($info = mysqli_fetch_array($query)) {
    						$hobbie = $info['hobbie'];
    						$id_hobbie = $info['id'];
    						$query2 = mysqli_query($link, "SELECT * FROM hobbie_user WHERE id_user = '". $_SESSION['user'][5] ."' AND id_hobbie = '$id_hobbie'");
    						?>
    						<tr>
    							<td><?php echo $hobbie; ?></td>
    							<td><input type='checkbox' name='hobbie[]' value="<?php echo $id_hobbie; ?>" <?php if (mysqli_num_rows($query2) == 1) { echo "checked"; } ?> ></td>
    						</tr>
    						<?php
    					}

    				}
    				?>
    			</tbody>
    		</table>

    		<div class="form-group">
    			<label>Facebook Link...</label>
    			<input type="text" name="facebook" class="form-control" value="<?php echo $facebook; ?>">
    		</div>
    		<div class="form-group">
    			<label>Instagram Link...</label>
    			<input type="text" name="instagram" class="form-control" value="<?php echo $instagram; ?>">
    		</div>
    		<div class="form-group">
    			<label>Twitter Link...</label>
    			<input type="text" name="twitter" class="form-control" value="<?php echo $twitter; ?>">
    		</div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Relationship Status</label>
                <select class="form-control" id="exampleFormControlSelect1" name="estado_civil">
                  <?php
                  $estado_query = mysqli_query($link, "SELECT * FROM estado_civil");
                  while ($info_estado = mysqli_fetch_array($estado_query)) {
                      $id_estado = $info_estado['id_estado'];
                      $estado = $info_estado['estado'];
                      if ($id_estado == $id_estado_user) {
                        echo "<option value='$id_estado' selected='selected'>$estado</option>";
                      } else {
                        echo "<option value='$id_estado'>$estado</option>";
                      }
                  }
                  ?>
                </select>
            </div>

    		<div class="text-center">
    			<img src="<?php echo $foto; ?>" alt="..." class="img-thumbnail text-center" style="width: 250px;">
    			<br>
    			<input type="file" name="file">
    		</div>
    		<br>
    		<input type="submit" name="mudar_info" class="btn btn-primary btn-lg" style="width: 100%;" value="Update Info">
    	</form>
    </div>
    <?php include 'footer.php'; ?>