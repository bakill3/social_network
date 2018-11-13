<?php 

include 'header.php'; 
if (isset($_GET['id'])) {
	$id_user = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$query = mysqli_query($link, "SELECT * FROM users INNER JOIN seguidores ON users.id = seguidores.id_user WHERE seguidores.id_seguidor='".$_SESSION['user'][5]."' AND users.id='$id_user' LIMIT 1");


  	$info_user = mysqli_fetch_assoc($query);

  	$email = $info_user['email'];
  	$nome = $info_user['f_nome'];
  	$apelido = $info_user['l_nome'];
  	$idade = $info_user['idade'];
  	$username = $info_user['username'];
  	$sobre = $info_user['sobre'];
    $foto = $info_user['foto'];


} else {
	header('Location: index.php');
	exit(0);
}

?>
<div style="height: 600px;">
  <div class="mensagens" style="height: 100%;
  border-right: 0.1em solid black;
  border-left: 0.1em solid black;
  border-top: 0.1em solid black;
  border-bottom: 0.5px solid black; overflow: auto;">

</div>
<div class="form-group" style="padding-bottom: 0%;">
  <textarea id="enviar" class="form-control" name="post" cols="30" rows="3" placeholder="Publica..."></textarea>
  <input type="hidden" id="other" value="<?php echo $id_user; ?>">
</div>
</div>

<?php include 'footer.php'; ?>