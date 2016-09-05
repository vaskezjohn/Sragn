    <div id="content" class="container" style="padding-top: 50px; padding-bottom: 20px;">
		<article  class="post clearfix">

      <!-- <header  >
				<h1 class="post-title"><a>Administrador</a></h1>
        <hr>
			</header>-->
			<?php if(isset($_SESSION["user_id"])): ?>

			<h1>Bienvenido <?php echo $_SESSION["user_id"]["apeynom"]; ?></h1>

		    <?php endif ?>



			<div id="principal">

			</div>		
		</article>
	</div>
