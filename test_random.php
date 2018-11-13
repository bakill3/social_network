<?php
include 'ligar_db.php'; 
//$nomes_rapariga = array("Lara Fontes", "Mara Carvalho", "Luana Silva", "Bianca Soares");
$nome_rapaz = array("Diogo", "Márcio", "Jorge", "Paulo");
$apelido_rapaz = array("Azevedo", "Ponte", "Lima", "Henriques");
$conta = count($nome_rapaz);
$idade = rand(16, 30);

for ($i=1; $i <= $conta; $i++) { 
	mysqli_query($link, "INSERT INTO users (email, f_nome, l_nome, idade, username, password, id_estado, foto) VALUES ('0', '$nome_rapaz[$i]', '$apelido_rapaz[$i]', '$idade', '$nome_rapaz[$i] $apelido_rapaz[$i]', '0', '1', 'random/male/".$i.".jpg')") or die(mysqli_error($link));
}
?>

