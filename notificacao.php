<?php
include 'codigo.php';
$query = "SELECT * FROM notificacoes INNER JOIN users ON notificacoes.sender = users.id WHERE receiver = '".$_SESSION['user'][5]."' AND vista = '0' ";
$result = mysqli_query($link, $query);
$output = '';
if (mysqli_num_rows($result) > 0) {
	$x = 0;
	while($row = mysqli_fetch_array($result))
	{
	 $x++;
	}
	echo $x;
}


?>