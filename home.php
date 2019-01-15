<?php 

include 'header.php'; 
$query = mysqli_query($link, "SELECT * FROM users WHERE id='".$_SESSION['user'][5]."' LIMIT 1");
$info = mysqli_fetch_assoc($query);
$id_user = $info['id'];
$username = $info['username'];
$f_nome = $info['f_nome'];
$l_nome = $info['l_nome'];
$sobre = $info['sobre'];
?>
</div>

<div class="container-fluid gedf-wrapper">
	<div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-body">
					<div class="h5"><?php echo $f_nome." ".$l_nome ?></div>
					<div class="h7 text-muted postbi">@<?php echo $username ?></div>
					<div class="h7 postbi"><?php echo $sobre; ?>
				</div>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="h6 text-muted postbi">Followers</div>
					<?php
					$query_1 = mysqli_query($link, "SELECT * FROM seguidores WHERE id_user='$id_user'");
					$query_2 = mysqli_query($link, "SELECT * FROM seguidores WHERE id_seguidor='$id_user'");
					?>
					<div class="h5"><?php echo mysqli_num_rows($query_1); ?></div>
				</li>
				<li class="list-group-item">
					<div class="h6 text-muted postbi">Following</div>
					<div class="h5"><?php echo mysqli_num_rows($query_2); ?></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-6 gedf-main">

		<!--- \\\\\\\Post-->
		<div class="card gedf-card">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Post</a>
					</li>
                            <!--
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Imagens</a>
                            </li>
                        -->
                    </ul>
                </div>
                <div class="card-body">
                	<div class="tab-content" id="myTabContent">
                		<div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                			<div class="form-group">
                				<label class="sr-only" for="message">post</label>
                				<textarea class="form-control emoji" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                			</div>

                		</div>
                		<div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                			<div class="form-group">
                				<div class="custom-file">
                					<input type="file" class="custom-file-input" id="customFile">
                					<label class="custom-file-label" for="customFile">Upload de Imagem</label>
                				</div>
                			</div>
                			<div class="py-4"></div>
                		</div>
                	</div>
                	<div class="btn-toolbar justify-content-between">
                		<div class="btn-group">
                			<button type="submit" class="btn btn-primary" id="publicar">Post</button>
                		</div>
                            <!--
                            <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-globe"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                </div>
                            </div>
                        -->
                    </div>
                </div>
            </div>
            <div class="publicacoes">

            </div>
        </div>
        <div class="col-md-3">
        	<div class="card gedf-card" style="margin: 1%;">
        		<div class="card-body postbi">
        			<h5 class="card-title">Go to <a href="mensagens.php">Messages <i class="fal fa-comments"></i></a></h5>
        			<p class="card-text">Here you can talk to all users on the platform.</p>
        		</div>
        	</div>
        	<div class="card gedf-card" style="margin: 1%;">
        		<div class="card-body postbi">
        			<h5 class="card-title">Edit your <a href="settings.php">Profile <i class="far fa-cog"></i></a></h5>
        			<p class="card-text">Here you can edit your personal information (Email, Name, Relationship Status, Profile Picture...).</p>
        		</div>
        	</div>
        	<div class="card gedf-card" style="margin: 1%;">
        		<div class="card-body postbi">
        			<h5 class="card-title">Play <a href="gameball.php">GameBall <i class="far fa-gamepad"></i></a></h5>
        			<p class="card-text">Here you can play a game made in C# Unity (2016).</p>
        		</div>
        	</div>
        </div>
    </div>






    <?php include 'footer.php'; ?>