<?php 
include 'header.php'; 
$meu = $_SESSION['user'][5];
$query = mysqli_query($link, "SELECT DISTINCT f_nome, l_nome, id, email, sobre, foto, username, idade FROM users INNER JOIN messages ON users.id = messages.user_from OR users.id = messages.user_to WHERE users.id != '$meu' AND messages.user_from='$meu' OR messages.user_to='$meu' ORDER BY messages.data ASC");
/*
$query = mysqli_query($link, "SELECT 
	*, 
	CONCAT(u.f_nome, ' ', u.l_nome) as nameFrom,
	CONCAT(u2.f_nome, ' ', u2.l_nome) as nameTo
	FROM messages
	INNER JOIN 
	users u ON messages.user_from = u.id
	INNER JOIN 
	users u2 ON messages.user_to = u2.id") or die(mysqli_error($link));
*/	

//$query = mysqli_query($link, "SELECT * FROM messages WHERE user_from='$meu' OR user_to='$meu'") or die(mysqli_error($link));
	echo "<div style='display: inline-block;
    overflow: auto;
    vertical-align: top; max-width: 15%;'>";
while ($info_user = mysqli_fetch_array($query)) {
	$id_user = $info_user['id'];
	$email = $info_user['email'];
  	$nome = $info_user['f_nome'];
  	$apelido = $info_user['l_nome'];
  	$idade = $info_user['idade'];
  	$username = $info_user['username'];
  	$sobre = $info_user['sobre'];
    $foto = $info_user['foto'];

	echo "<button class='btn btn-dark mudarp' value='$id_user'><div class='photo' style='display: inline-block;'>
		<img class='avatar zoom' src='$foto' alt='$nome $apelido'>
		</div>".$nome." ".$apelido."</button><br>";
	echo "<input type='hidden' id='mudarc' value='$id_user'>";
}
echo "</div>";
?>

<div style="height: 600px;
    display: inline-block;
    width: 83%;">
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