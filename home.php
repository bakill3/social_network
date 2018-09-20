<?php 

include 'header.php'; 

?>


<div class="bem_vindo">
	<h1 class="text-white text-center"><span class="texto_nice"><span class="text-white">Publicações</span> Recentes </span></h1>
	<br>
	<div class="publicacoes">


	</div>
	<script>
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
				url: 'homepage.php',
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
	</script>

	



	<?php include 'footer.php'; ?>