</div>

<script src="jquery.min.js"></script>
<script src="header.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>
<script>
	$(".emoji").emojioneArea({
		pickerPosition:"right"
	});
</script>
<?php
if (isset($_POST['message'])) {
	$message = htmlspecialchars(mysqli_real_escape_string($link, $_POST['message']));
	$user_to = htmlspecialchars(mysqli_real_escape_string($link, $_POST['other_id']));

	$data = date("Y-m-d H:i:s");

	if (!empty($message)) {

		mysqli_query($link, "INSERT INTO messages(user_from, user_to, message, data) VALUES('".$_SESSION['user'][5]."', '$user_to', '$message', '$data')");
		mysqli_query($link, "INSERT INTO notificacoes (sender, receiver, tipo) VALUES('".$_SESSION['user'][5]."', '$user_to', 'mensagem')");

	}
}
?>
<script>
	$( ".mudarp" ).click(function() {
		//var id = $(this).val();
		var id = $(this).attr('id');

		$(".chat_list").removeClass("active_chat");
		$('#chat_list_' + id).addClass("active_chat");
		$("#other").val(id);
		//alert(id);
	});
	$('#enviar').keydown(function() {
		var message = $("#enviar").val();
		var other_id = $("#other").val();
		if (event.keyCode == 13) {
			$.ajax({
				type: "POST",
				url: "",
				data: {message: message, other_id: other_id},
				success: function(response){
					//console.log('skr69');
					$("#enviar").val('');
				}
			});
		}
	});
	setInterval(function(){
		var other = $("#other").val();
		$.ajax({
			type: "POST",
			url: "mess.php",
			data: {other: other},
			success:function(data)
			{
				$('.mensagens').html(data);
			}
		});

	}, 250);
</script>
<script src="js/sweetalert.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="lazyload/lazyload.min.js"></script>
<script>
	new LazyLoad();
</script>

</body>
</html>