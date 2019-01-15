<?php
include 'ligar_db.php';
if (isset($_POST['id_userino'])) {
	$id_userino = mysqli_real_escape_string($link, $_POST['id_userino']);
	$query = mysqli_query($link, "SELECT * FROM anonymous WHERE id_user='$id_userino' AND id_seguidor='".$_SESSION['user'][5]."' AND tipo='make_out'");
	if (mysqli_num_rows($query) == 0) {
		mysqli_query($link, "INSERT INTO anonymous(id_user, id_seguidor, tipo) VALUES ('$id_userino', '".$_SESSION['user'][5]."', 'make_out')");
		echo "You started to want to make out with the user.\n The user will NOT be notified but the numbers on his profile will change.";
	} else {
		mysqli_query($link, "DELETE FROM anonymous WHERE id_user='$id_userino' AND id_seguidor='".$_SESSION['user'][5]."' AND tipo='make_out'");
		print "You stoped to want to make out with the user. \n The user will NOT be notified but the numbers on his profile will change.";
	}
}
?>