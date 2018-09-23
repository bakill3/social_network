<?php 

include 'header.php'; 
if (isset($_GET['id'])) {
	$id_user = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$query = mysqli_query($link, "SELECT * FROM users WHERE id='$id_user' LIMIT 1");
	$info_user = mysqli_fetch_assoc($query);

	$email = $info_user['email'];
	$nome = $info_user['f_nome'];
	$apelido = $info_user['l_nome'];
	$idade = $info_user['idade'];
	$username = $info_user['username'];
	$sobre = $info_user['sobre'];
  $foto = $info_user['foto'];

} else {
	header('Location: index.php');
	exit(0);
}

?>
<style class="cp-pen-styles">html, body {
  background-color: #f0f2fa;
  font-family: "PT Sans", "Helvetica Neue", "Helvetica", "Roboto", "Arial", sans-serif;
  color: #555f77;
  -webkit-font-smoothing: antialiased;
}
</style>


<div class="row m-y-2" style="box-shadow: 0px 0px 10px 3px rgba(158,158,158, 0.5); padding: 3%;">
 <div class="col-lg-4 pull-lg-8 text-xs-center">

  <img data-src="<?php echo $foto; ?>" class="lazy_img" style="width: 250px;" alt="avatar zoom">


</div>
<div class="col-lg-8 push-lg-4">

  <div class="tab-content p-b-3">
    <div class="tab-pane active" id="profile">
      <div style="display: inline-block;">
        <h4 class="m-y-2 nome" id="<?php echo $nome." ".$apelido; ?>"><?php echo $nome." ".$apelido; ?></h4>
      </div>
      <div style="display: inline-block; padding-left: 1%; color: #ff0000cf;">
        <h6><span style="font-size: 115%;">@<?php echo $username; ?></span></h6>
      </div>
      <div class="row">
        <div class="col-md-6">

          <p>
            <?php echo $sobre; ?>
          </p>
          <h6>Hobbies</h6>
          <p>
            <?php 
            $query = mysqli_query($link, "SELECT * FROM hobbies INNER JOIN hobbie_user ON hobbies.id = hobbie_user.id_hobbie WHERE id_user = '$id_user'");
            if (mysqli_num_rows($query) == 0) {
              echo "$nome não tem hobbies.";
            } else {
              echo "$nome gosta de ";
              while ($info_hob = mysqli_fetch_array($query)) {
                $hobbie = $info_hob['hobbie'];
                echo $hobbie. ", "; 
              }
            }
            ?>

          </p>
        </div>
        <div class="col-md-6">
          <?php
          if ($id_user == $_SESSION['user'][5]) {
            ?>
            <a href="settings.php" class="btn btn-lg btn-primary" style="width: 100%;">Editar Perfil <i class="fas fa-pencil-alt"></i></a>
            <?php
          } else {

            $query56 = mysqli_query($link, "SELECT * FROM seguidores WHERE id_user='$id_user' AND id_seguidor='".$_SESSION['user'][5]."'");
            if (mysqli_num_rows($query56) > 0) {
              ?>
              <button class="btn btn-lg btn-danger seguir" style="width: 100%;" id="<?php echo $id_user; ?>">Não Seguir <i class="fas fa-user-times"></i></button>
              <?php
            } else { 
              ?>
              <button class="btn btn-lg btn-primary seguir" style="width: 100%;" id="<?php echo $id_user; ?>">Seguir <i class="fas fa-user-plus"></i></button>
              <?php
            }
          }
          ?>
          <hr>
          <?php

          $query555 = mysqli_query($link, "SELECT * FROM seguidores WHERE id_user='$id_user'");

          ?>
          <span class="tag tag-primary seguidores" id="<?php echo mysqli_num_rows($query555); ?>"><i class="fa fa-user"></i> <?php echo mysqli_num_rows($query555); ?> Seguidores</span>
          <span class="tag tag-success"><i class="fa fa-cog"></i> 43 Forks</span>
          <span class="tag tag-danger"><i class="fa fa-eye"></i> 245 Views</span>
        </div>
        <div class="col-md-12">
                            <!--
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  ...
                                </div>
                              </div>
                            </div>
                          -->
                          <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span> Fotos</h4>

                          <?php 
                          echo "<div class='row'>";
                          $query_fotos = mysqli_query($link, "SELECT * FROM galeria WHERE id_user='$id_user' ORDER BY id LIMIT 3");
                          if (mysqli_num_rows($query_fotos) > 0) {
                            while ($info_fotos = mysqli_fetch_array($query_fotos)) {
                              $src = $info_fotos['foto'];
                              echo "<img data-src='$src' class='zoom img-thumbnail lazy_img' style='padding: 5px; width: 180px; height: 150px;'>";
                            }
                          } else {
                            echo "Este utilizador não tem fotografias";
                          }
                          echo "</div>";
                            /*
                            <table class="table table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            */ ?>
                          </div>
                        </div>
                        <!--/row-->
                      </div>



                    </div>
                  </div>
                  <hr>


                  <div class="comments">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="comment-wrap">
                        <!--
                        <div class="photo">
                          <div class="avatar" style="background-image: url('<?php echo $foto_header; ?>')"></div>
                        </div>
                      -->
                        <div class="comment-block">
                          <div class="form-group">
                          	<textarea class="form-control" name="post" cols="30" rows="3" placeholder="Publica..."></textarea>
                          </div>
                          <input type="file" name="file">
                          <div class="text-right"> <button type="submit" name="postar" class="btn btn-success btn-lg">Postar <i class="fas fa-check"></i></button> </div>

                        </div>

                      </div>
                      <input type="hidden" name="hash_perf_19230" value="<?php echo $id_user; ?>">
                    </form>
                    <?php 



                    $query = mysqli_query($link, "SELECT posts.id AS id_post, users.foto AS foto, users.l_nome, users.f_nome, id_perfil, id_user_postou, post, data FROM posts INNER JOIN users ON posts.id_user_postou = users.id WHERE id_perfil='$id_user' ORDER BY data DESC");
                    if (mysqli_num_rows($query) > 0) {
                     while ($info_post = mysqli_fetch_array($query)) {
                      $id_post = $info_post['id_post'];
                      $foto_post = $info_post['foto'];
                      $post = $info_post['post'];
                      $id_user_postou = $info_post['id_user_postou'];
                      $data = $info_post['data'];
                      $f_nome = $info_post['f_nome'];
                      $l_nome = $info_post['l_nome'];
                      ?>

                      <a href="profile.php?id=<?php echo $id_user_postou; ?>">
                        <div class="comment-wrap">
                          <div class="comment-block">


                          <div class='photo' style='display: inline-block;'>
                            <img class='avatar zoom' src='<?php echo $foto_post; ?>' alt='<?php echo $f_nome." ".$l_nome; ?>'>
                          </div>

                          <div style='display: inline-block;'>
                            <h5 class='h5_sp'> <?php echo $f_nome." ".$l_nome; ?> </h5>
                          </div>
                          </a>
                          <p class="comment-text">
                           <?php 
                           echo $post; 
                           $fotos = mysqli_query($link, "SELECT * FROM galeria WHERE id_post='$id_post'");
                           if (mysqli_num_rows($fotos) > 0) {
                            $info_fotos = mysqli_fetch_assoc($fotos);
                            $foto_gal = $info_fotos['foto'];
                            echo "<br><div class='text-center'><img data-src='$foto_gal' class='zoom img-thumbnail img-responsive lazy_img' style='width: 400px' alt='Foto'></div>";
                          }
                          ?>

                        </p>
                        <div class="bottom-comment">
                          <div class="comment-date"><?php echo $data; ?></div>
                          <ul class="comment-actions">
                           <?php 
                           $likes = mysqli_query($link, "SELECT * FROM likes WHERE id_post='$id_post'");
                           if (mysqli_num_rows($likes) > 0) {
                            $contagem = mysqli_num_rows($likes);
                          }
                          if ($id_user_postou == $_SESSION['user'][5]) {
                           echo '<li class="complain">
                           <form method="POST">
                           <button type="submit" name="apagar" class="btn btn-danger btn-sm">Apagar</button>
                           <input type="hidden" name="hash_perf_19232" value="'. $id_post. '">
                           <input type="hidden" name="hash_perf_19234" value="'.$id_user.'">
                           </form>
                           </li>';
                         }
                         ?>

                         <?php
                         if (isset($contagem)) {
                          echo "<span style='font-size: 120%; color: black;' class='font-weight-bold'>". $contagem."</span><i class='fas fa-heart' style='color: #ff5722ed;'></i>";
                        }
                        $query_likes = mysqli_query($link, "SELECT * FROM likes WHERE id_post='$id_post' AND id_user='".$_SESSION['user'][5]."'");
                        if (mysqli_num_rows($query_likes) == 0) {
                          ?>
                          <button type="button" class="gostar btn btn-primary" id="<?php echo $id_post; ?>"><i class="far fa-heart"></i></button>
                          <?php
                        } else { 
                          ?>
                          <button type="button" class="gostar btn btn-primary" id="<?php echo $id_post; ?>"><i class="fas fa-heart"></i></button>
                          <?php
                        }
                        ?>

                        <li class="reply">Reply</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
            ?>



          </div>
          <?php include 'footer.php'; ?>