<?php 
include 'header.php'; 
$username = $_SESSION['user'][4];
$idade = $_SESSION['user'][3];
$id = $_SESSION['user'][5];

$busca_info = mysqli_query($link, "SELECT sobre, foto FROM users WHERE id='$id' LIMIT 1");
$inf = mysqli_fetch_assoc($busca_info);

$sobre = $inf['sobre'];
$foto = $inf['foto'];

if (isset($_POST['mudar_info'])) {
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$f_nome = mysqli_real_escape_string($link, $_POST['f_nome']);
	$l_nome = mysqli_real_escape_string($link, $_POST['l_nome']);
	$sobre = mysqli_real_escape_string($link, $_POST['sobre']);

	if (!empty($email) && !empty($f_nome) && !empty($l_nome) && !empty($sobre)) {		
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

			mysqli_query($link, "UPDATE users SET email='$email', f_nome='$f_nome', l_nome='$l_nome', sobre='$sobre' WHERE id='$id'") or die (mysqli_error($link));

			if (!empty($file_name)) {
				mysqli_query($link, "UPDATE users SET foto='$file_store' WHERE id='$id'") or die(mysqli_error($link));
			}

			$_SESSION['user'] = array($email, $f_nome, $l_nome, $idade, $username, $id);

		}
	} else {
		$_SESSION['erro'] = "Preencha tudo!";
	}

	/*
	 if (!empty($_POST['chaves'])) {
          foreach($_POST['chaves'] as $chaves){
            mysqli_query($link, "INSERT INTO keywords(keyword_id, id_propriedade) VALUES ('$chaves', (SELECT id_propriedade FROM propriedades WHERE referencia='$referencia'))");
          }
        }
	*/

        header('Location: settings.php');
        exit(0);
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
    	<h2 class="text-center">Definições</h2>
    	<hr>
    	<div class="form-group">
    		<label>Email</label>
    		<input type="email" name="email" class="form-control" value="<?php echo $_SESSION['user'][0]; ?>">
    	</div>
    	<div class="form-group">
    		<label>Nome</label>
    		<input type="text" name="f_nome" class="form-control" value="<?php echo $_SESSION['user'][1]; ?>">
    	</div>
    	<div class="form-group">
    		<label>Apelido</label>
    		<input type="text" name="l_nome" class="form-control" value="<?php echo $_SESSION['user'][2]; ?>">
    	</div>
    	<div class="form-group">
    		<label>Sobre</label>
    		<textarea class="form-contol" name="sobre" style="width: 100%; background-color: #212529b0; color: #fff;"><?php echo $sobre; ?></textarea>
    	</div>
    	<table class="table table-striped table-dark">
    		<thead>
    			<tr>
    				<td>Hobbie</td>
    				<td>Ativo</td>
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
    	<div class="text-center">
    		<img src="<?php echo $foto; ?>" alt="..." class="img-thumbnail text-center" style="width: 250px;">
    		<br>
    		<input type="file" name="file">
    	</div>
    	<br>
    	<input type="submit" name="mudar_info" class="btn btn-primary btn-lg" style="width: 100%;" value="Alterar Dados">
    </form>
    <?php include 'footer.php'; ?>