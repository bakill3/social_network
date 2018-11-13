<?php
include 'ligar_db.php';
if (isset($_POST['getData'])) {


        $start = mysqli_real_escape_string($link, $_POST['start']);
        $limit = mysqli_real_escape_string($link, $_POST['limit']);

        $query = mysqli_query($link, "SELECT posts.id AS id_post, users.foto AS foto, users.f_nome as f_nome, users.l_nome as l_nome, users.id as id_user, id_perfil, id_user_postou, post, data FROM posts INNER JOIN users ON posts.id_user_postou = users.id ORDER BY RAND()");

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

                                $likezinho = '<button type="button" class="gostar btn btn-primary" id="'.$id_post.'" aria-label="Gostar"><i class="far fa-heart"></i></button>';
                                
                        } else { 

                                $likezinho = '<button type="button" class="gostar btn btn-primary" id="'.$id_post.'" aria-label="Gostar"><i class="fas fa-heart"></i></button>';
                                
                        }


                        $response .= "
                        <div class='comment-wrap'>
                        <a href='profile.php?id=$id_user'>

                        <div class='comment-block' style='box-shadow: 0 0 10px 3px rgba(0, 0, 0, 0.8); position: relative;'>
                        $apagar

                        <div class='photo' style='display: inline-block;'>
                        <img class='avatar zoom' src='$foto_post' alt='$f_nome $l_nome'>
                        </div>

                        <div style='display: inline-block;'>
                        <h5 class='h5_sp'> $f_nome $l_nome </h5>
                        </div>
                        </a>
                        <p class='comment-text'> 
                        $post
                        $foto_p
                        </p>
                        <div class='bottom-comment'>
                        <div class='comment-date'>$data</div>
                        <ul class='comment-actions'>
                        
                        

                        
                        <br>
                        <li class='reply'>
                        $contagem_p
                        $likezinho
                        




                        </li>
                        </ul>
                        </div>
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