<?php
include 'ligar_db.php';
if (isset($_POST['getData'])) {


        $start = mysqli_real_escape_string($link, $_POST['start']);
        $limit = mysqli_real_escape_string($link, $_POST['limit']);

        $query = mysqli_query($link, "SELECT posts.id AS id_post, users.foto AS foto, users.f_nome as f_nome, users.l_nome as l_nome, users.id as id_user, id_perfil, id_user_postou, post, data, username FROM posts INNER JOIN users ON posts.id_user_postou = users.id ORDER BY RAND()");

        if (mysqli_num_rows($query) > 0) {
                $response = "";

                while($info_post = mysqli_fetch_array($query)) {
                        $id_post = $info_post['id_post'];
                        $foto_post = $info_post['foto'];
                        $post = $info_post['post'];
                        $id_user_postou = $info_post['id_user_postou'];
                        $data = $info_post['data'];
                        $f_nome = $info_post['f_nome'];
                        $l_nome = $info_post['l_nome'];
                        $id_user = $info_post['id_user'];
                        $id_perfil = $info_post['id_perfil'];
                        $username = $info_post['username'];

                        $fotos = mysqli_query($link, "SELECT * FROM galeria WHERE id_post='$id_post'");
                        if (mysqli_num_rows($fotos) > 0) {
                                $info_fotos = mysqli_fetch_assoc($fotos);
                                $foto_gal = $info_fotos['foto'];
                                $foto_p = "<br><div class='text-center'><img src='$foto_gal' class='zoom img-thumbnail img-responsive lazy_img' alt='Publicação' style='width: 400px'></div>";
                        } else {
                                $foto_p = "";
                        }

                        $likes = mysqli_query($link, "SELECT * FROM likes WHERE id_post='$id_post'");
                        $contagem = mysqli_num_rows($likes);
                        if ($contagem > 0) {
                                $contagem_p = "<a href='#' style='font-size: 120%; color: black;' class='font-weight-bold' data-toggle='tooltip' data-placement='top' title='Hooray!'>".$contagem."</a><i class='fas fa-heart' style='color: #ff5722ed;'></i>";

                        } else {
                                $contagem_p = "";
                        }

                        if ($id_user_postou == $_SESSION['user'][5]) {
                                $apagar = '
                                <form method="POST" style="display: inline-block;position: absolute;right: 1%;">
                                <button type="submit" name="apagar" class="btn btn-danger btn-sm"><i class="fal fa-trash-alt"></i></button>
                                <input type="hidden" name="hash_perf_19232" value="'. $id_post. '">
                                </form>
                                ';
                        } else {
                                $apagar = "";
                        }


                        $query_likes = mysqli_query($link, "SELECT * FROM likes WHERE id_post='$id_post' AND id_user='".$_SESSION['user'][5]."'");
                        if (mysqli_num_rows($query_likes) == 0) {

                                $likezinho = "<a class='card-link gostar' id='$id_post'><i class='fa fa-gittip'></i> <i class='far fa-heart'></i></a>";

                                //$likezinho = '<button type="button" class="gostar btn btn-primary" id="'.$id_post.'" aria-label="Gostar"><i class="far fa-heart"></i></button>';
                                
                        } else { 

                                $likezinho = '<a class="card-link gostar" id="'.$id_post.'" aria-label="Gostar"><i class="fas fa-heart"></i></a>';
                                
                        }

                        $response .= "
                        <div class='card gedf-card' style='padding-top: 1%; padding-bottom: 1%;'>
                        <div class='card-header'>
                        <div class='d-flex justify-content-between align-items-center'>
                        <a href='profile.php?id=$id_user'>
                                <div class='d-flex justify-content-between align-items-center'>
                                <div class='mr-2'>
                                <img class='rounded-circle zoom' width='45' src='$foto_post' alt=''>
                                </div>
                                <div class='ml-2'>
                                <div class='h5 m-0'>@".$username."</div>
                                <div class='h7 text-muted'>$f_nome $l_nome</div>
                                </div>
                                </div>
                        </a>
                        <div>

                        $apagar


                        </div>
                        </div>

                        </div>
                        <div class='card-body'>
                        <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>$data</div>
                        <p class='card-text'>
                        $post
                        $foto_p
                        </p>
                        </div>
                        <div class='card-footer'>
                        $likezinho
                        $contagem_p
                        </div>
                        </div>
                        ";
                }



                exit($response);
        } else {
                exit('reachedMax');
        }
}
?>