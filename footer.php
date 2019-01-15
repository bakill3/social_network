</div>
<div style="position: fixed; bottom: 0; left: 0;
width: 100%;" id="mensagens_dinamicas">

</div>
<?php
//swal("Successo!", "Seguiste " + nome, "success");
if ($pagina != 'index.php') {
	?>

	<script src="header.min.js?t=1539395191051"></script>

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script> -->
	<script>
		$(".emoji").emojioneArea({
			pickerPosition:"right"
		});
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();   
			var d = $('.mensagens');
			d.scrollTop(d.prop("scrollHeight"));
		});
	</script>
	<?php
	if (isset($_POST['message'])) {
		$message = htmlspecialchars(mysqli_real_escape_string($link, $_POST['message']));
		$user_to = htmlspecialchars(mysqli_real_escape_string($link, $_POST['other_id']));

		$data = date("Y-m-d H:i:s");

		if (!empty($message) && strlen($message) < 40) {

			mysqli_query($link, "INSERT INTO messages(user_from, user_to, message, data) VALUES('".$_SESSION['user'][5]."', '$user_to', '$message', '$data')");
			mysqli_query($link, "INSERT INTO notificacoes (sender, receiver, tipo) VALUES('".$_SESSION['user'][5]."', '$user_to', 'mensagem')");

		}
	}
	?>
	<script>
		$( ".mudarp" ).click(function() {
		//var id = $(this).val();
		var id = $(this).attr('id');
		$("#other").val(id);

		$(".chat_list").removeClass("active_chat");
		$('#chat_list_' + id).addClass("active_chat");
		var foto_user = $('#foto_user_' + id).attr('src');
		var apelido = $("#apelido_" + id).html();
		var nome = $("#nome_" + id).html();
		var badge = Array("primary", "warning", "info", "secondary", "danger", "success", "light", "dark");
		var item = badge[Math.floor(Math.random()*badge.length)];
		$("#badgezinho").removeClass();
		$("#badgezinho").addClass("badge");
		$("#badgezinho").addClass("badge-" + item);


		$('#main_imagem').attr('src', foto_user);
		$("#a_putas").attr("href", "profile/" + id);

		$("#main_nome").html(nome);
		$("#main_apelido").html(apelido);

		setTimeout(
			function() 
			{
				var d = $('.mensagens');
				d.scrollTop(d.prop("scrollHeight"));
			}, 400);
		
	});
		$('#enviar').keydown(function(event) {
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
					
					setTimeout(
						function() 
						{
							var d = $('.mensagens');
							d.scrollTop(d.prop("scrollHeight"));
						}, 400);
					
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

		$(".make_out").click(function () {
			id_userino = this.id;
			id_botao = "#" + this.id;

			$.ajax({
				type: "POST",
				url: "make_out.php",
				data: {id_userino: id_userino},
				success: function(response){

					swal("Success", response, "success");
					if ($(".make_out").html() == 'Make Out') {
						$(".make_out").html("Stop Making Out");

						var make_numbe = Number($('.makei').attr('id'));
						var make_number = make_numbe + 1;
						$(".makei").html('<i class="fas fa-bookmark" style="color: #007bff;"></i> ' + make_number + " Make Outs");
						$('.makei').attr('id', make_number);
					} else {
						$(".make_out").html("Make Out");

						var make_numbe = Number($('.makei').attr('id'));
						var make_number = make_numbe - 1;
						$(".makei").html('<i class="fas fa-bookmark" style="color: #007bff;"></i> ' + make_number + " Make Outs");
						$('.makei').attr('id', make_number);
					}
				}
			});


		});

		$(".date").click(function () {
			id_userino = this.id;
			id_botao = "#" + this.id;

			$.ajax({
				type: "POST",
				url: "date.php",
				data: {id_userino: id_userino},
				success: function(response){
					swal("Success", response, "success");
					if ($(".date").html() == 'Date') {
						$(".date").html("Stop Dating");
						var date_numbe = Number($('.datei').attr('id'));
						var date_number = date_numbe + 1;
						$(".datei").html('<i class="fas fa-heart" style="color: #007bff;"></i> ' + date_number + " Dates");
						$('.datei').attr('id', date_number);

					} else {
						$(".date").html("Date");
						var date_numbe = Number($('.datei').attr('id'));
						var date_number = date_numbe - 1;
						$(".datei").html('<i class="fas fa-heart" style="color: #007bff;"></i> ' + date_number + " Dates");

						$('.datei').attr('id', date_number);
					}
				}
			});


		});

	</script>

	<script type="text/javascript">
		function edit() {
			$("#edit").remove();
			//$(".chat_list").removeClass("active_chat");
			var about = $("#sobre").text();
			var estado = $("#estado").text();
			var f_name = $("#f_name").text();
			var l_name = $("#l_name").text();
			var id_estado = $("#id_estado").val();

			//FIRST NAME - - - - - - - - - - - -- - - - - - - - - - - -- - - - - - - - - - - -
			$("#f_name").text("");
			$('<div>').attr({
				id: 'f_name_div'
			}).appendTo('#f_name');
			$("#f_name_div").css("display", "inline-block");


			$('<input>').attr({
				type: 'text',
				id: 'f_name_changed',
				value: f_name,
				name: 'f_name_changed'
			}).appendTo('#f_name_div');

			$("#f_name_changed").css("width", "95%");
			$('#f_name_changed').addClass("form-control");

			//- - - - - - - - - - - -- - - - - - - - - - - -- - - - - - - - - - - -- - - - - - - - - - - -

			//LAST NAME - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			$("#l_name").text("");

			$('<div>').attr({
				id: 'l_name_div'
			}).appendTo('#l_name');
			$("#l_name_div").css("display", "inline-block");

			

			$('<input>').attr({
				type: 'text',
				id: 'l_name_changed',
				value: l_name,
				name: 'l_name_changed'
			}).appendTo('#l_name_div');

			$("#l_name_changed").css("width", "95%");
			$('#l_name_changed').addClass("form-control");

			//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			//ABOUT - - - - - - - - - - - -- - - - - - - - - - - -- - - - - - - - - - - -- - - - - - - - - - - -
			$("#sobre").text("");

			$('<textarea>').attr({
				id: 'sobre_changed',
				name: 'sobre_changed'
			}).appendTo('#sobre');
			$("#sobre_changed").text(about);
			$('#sobre_changed').addClass("form-control");



			$('<button>').attr({
				type: 'button',
				id: 'finish',
				class: 'btn btn-success btn-lg'
			}).appendTo('#btns');
			$("#finish").html('<i class="fas fa-check"></i>');
			$("#finish").css("width", "45%");
			$("#finish").css("margin-left", "5%");

			$('<button>').attr({
				type: 'button',
				id: 'cancel',
				class: 'btn btn-danger btn-lg'
			}).appendTo('#btns');
			$("#cancel").html('<i class="fas fa-ban"></i>');
			$("#cancel").css("width", "45%");
			$("#cancel").css("margin-left", "5%");

			$('#cancel').attr('onclick','window.location.reload()');
			$('#finish').attr('onclick','finito()');

			$('<button>').attr({
				type: 'button',
				id: 'more',
				class: 'btn btn-white btn-lg'
			}).appendTo('#btns');
			$('#more').attr('onclick','window.location = "settings.php";');
			$('#more').html('More Settings <i class="fas fa-pencil-alt"></i>');
			$("#more").css("margin-left", "5%");
			$("#more").css("margin-right", "5%");
			$("#more").css("margin-top", "2%");
			$("#more").css("width", "95%");
			//<i class="fas fa-pencil-alt"></i>
			// window.location = url;


		}

		function finito() {
			console.log("Finito");

			var about = $('textarea#sobre_changed').val();
			var f_name_changed = $("#f_name_changed").val();
			var l_name_changed = $("#l_name_changed").val();
			console.log(about);
			console.log(f_name_changed);
			console.log(l_name);

			$.ajax({
				type: "POST",
				url: "change.php",
				data: {
					about: about, 
					f_name_changed: f_name_changed, 
					l_name_changed: l_name_changed
				},
				success:function(data)
				{
					console.log('done');
					//alert(data);
					//$('.mensagens').html(data);
					location.reload();
				}
			});
		}

		
	</script>
	<?php
}
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126697369-1"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-126697369-1');
</script>

<script src="js/sweetalert.min.js"></script>

<script src="lazyload/lazyload.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
	new LazyLoad();
</script>

</body>
</html>