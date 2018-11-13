$(document).ready(function(){

	var tocado = 0;

	setInterval(function(){
		load_last_notification();
	}, 500);

	setInterval(function(){
		$.ajax({
			url:"notificacao.php",
			method:"POST",
			success:function(data)
			{

				var lenght = Object.keys(data).length;

				$('.menino').html(data);
				if (data) {
					
					if (tocado == 0) {
						var audio = new Audio('notification.ogg');
						audio.play();
						tocado = 1;
						console.log(tocado);
						
					}
				} else {
					tocado = 0;
				}	
			}
		})
	}, 500);


	$("#publicar").click(function () {
		var post = $("#message").val();
		$.ajax({
			type: "POST",
			url: "postar.php",
			data: {post: post},
			success: function(response){
				alert(response);
			}
		});
	});



	function load_last_notification()
	{
		$.ajax({
			url:"teste2.php",
			method:"POST",
			success:function(data)
			{
      //if (data) { 
      //  $(".content").hide().html(data).fadeIn();
      //}
      $('.content').html(data);
  }
})
	}

	$(document).on('click','.gostar',function(){
  //$(".gostar").click(function () {
  	if ($(this).hasClass('gostou')){
  		alert("Já gostaste");
  	} else {
  		id_botao = "#" + this.id;
  		buttonClick(this.id);
      //$(id_botao).removeClass( "gostar" ).addClass("gostou");
      if ($(id_botao).html() == '<i class="fas fa-heart"></i>') {

      	$(id_botao).html('<i class="far fa-heart"></i>');
      } else {

      	$(id_botao).html('<i class="fas fa-heart"></i>');
      }
  }

});

	$(".seguir").click(function () {
		botao = "#" + this.id;
		buttonClick2(this.id);

		nome = $('.nome').attr('id');

		var numero = Number($('.seguidores').attr('id'));
		var numero_id = "#" + numero;

		if ($(botao).html() == 'Seguir <i class="fas fa-user-plus"></i>') {

			$(botao).removeClass("btn-primary");
			$(botao).addClass("btn-danger");

			$(botao).html('Não Seguir <i class="fas fa-user-times"></i>');




			incremento = numero + 1;



			$(numero_id).html('<i class="fa fa-user"></i> ' + incremento + ' Seguidores');

			$('.seguidores').attr('id', incremento);

			swal("Sucesso!", "Seguiste " + nome, "success");
		} else {

			$(botao).removeClass("btn-danger");
			$(botao).addClass("btn-primary");

			$(botao).html('Seguir <i class="fas fa-user-plus"></i>');

			decremento = numero - 1;

			$(numero_id).html('<i class="fa fa-user"></i> ' + decremento + ' Seguidores');

			$('.seguidores').attr('id', decremento);

			swal("Feito", "Deixaste de seguir " + nome, "info");

		}

	});

	function buttonClick2(x) {
		var id_perfil_seg = x;
		$.ajax({
			type: "POST",
			url: "",
			data: {id_perfil_seg: id_perfil_seg},
			success: function(response){
				console.log('skr69');
			}
		});
	}

	function buttonClick(x) {
		var id_post_gostado = x;
		$.ajax({
			type: "POST",
			url: "",
			data: {id_post_gostado: id_post_gostado},
			success: function(response){

			}
		});
	}




	var pagina = document.location.href.match(/[^\/]+$/)[0];

	if (pagina == 'home.php' || pagina == 'home2.php') {
		var start = 0;
		var limit = 5;
		var pagina = 1;
		var reachedMax = false;

		$(window).scroll(function () {
			if ($(window).scrollTop() == $(document).height() - $(window).height())
				getData();
		});

		$(document).ready(function () {
			getData();
		});

		function getData() {
			if (reachedMax)
				return;

			$.ajax({
				url: 'homepage2.php',
				method: 'POST',
				dataType: 'text',
				data: {
					getData: 1,
					start: start,
					limit: limit
				},
				success: function(response) {
					if (response == "reachedMax")
						reachedMax = true;
					else {
						start += limit;
						$(".publicacoes").append(response);
					}
				}
			});
		}
	}

	function pesquisar() {
		document.onkeydown=function(evt){
			var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
			if(keyCode == 13)
			{
				document.pesquisa.submit();
			}
		}
	}

	$(document).ready(function(){
		load_data();
		function load_data(query)
		{
			$.ajax({
				url:"fetch2.php",
				method:"post",
				data:{query:query},
				success:function(data)
				{
					$('#result').html(data);
				}
			});
		}

		$('#search_text').keyup(function(){
			var search = $(this).val();
			if(search != '')
			{
				load_data(search);
			}
			else
			{
				load_data();            
			}
		});

		function load_data_mensagens(search)
		{
			$.ajax({
				url:"mens_pesquisa.php",
				method:"post",
				data:{search:search},
				success:function(data)
				{
					$('#resultado_mensagens').html(data);
				}
			});
		}

		$('#mensagens_text').keyup(function(){
			var search = $(this).val();
			if(search != '')
			{
				load_data_mensagens(search);
			}
			else
			{
				load_data_mensagens();            
			}
		});

	});
});