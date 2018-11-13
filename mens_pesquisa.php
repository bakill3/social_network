<?php
include 'ligar_db.php';

if(isset($_POST["search"]))
{
  $search = mysqli_real_escape_string($link, $_POST["search"]);
  $query = "
  SELECT * FROM users 
  WHERE f_nome LIKE '%".$search."%' OR l_nome LIKE '%".$search."%' OR username LIKE '%".$search."%'";


  $result = mysqli_query($link, $query);
  if (!mysqli_query($link, $query))
  {
    echo("Erro: " . mysqli_error($link));
  }
  if(mysqli_num_rows($result) > 0)
  {

    while($row = mysqli_fetch_array($result))
    {
      $id_user = $row['id'];
      $email = $row['email'];
      $nome = $row['f_nome'];
      $apelido = $row['l_nome'];
      $idade = $row['idade'];
      $username = $row['username'];
      $sobre = $row['sobre'];
      $foto = $row['foto'];
      echo "<a class='mudarp' id='$id_user'><div class='chat_list' id='chat_list_$id_user'>
      <div class='chat_people'>
      <div class='chat_img'> <img src='$foto' alt='$nome $apelido'> </div>
      <div class='chat_ib'>
      <h5>$nome $apelido <span class='chat_date'>Dec 25</span></h5>
      <p>$sobre</p>
      </div>
      </div>
      </div></a>";
      echo "<input type='hidden' id='mudarc' value='$id_user'>";
    }
  }
  else
  {
    $query_seguidores = mysqli_query($link, "SELECT * FROM users INNER JOIN seguidores ON users.id = seguidores.id_seguidor WHERE id_user='".$_SESSION['user'][5]."'");
    while ($info_user = mysqli_fetch_array($query_seguidores)) {
      $id_user = $info_user['id'];
      $email = $info_user['email'];
      $nome = $info_user['f_nome'];
      $apelido = $info_user['l_nome'];
      $idade = $info_user['idade'];
      $username = $info_user['username'];
      $sobre = $info_user['sobre'];
      $foto = $info_user['foto'];

            /*
            echo "<button class='btn btn-dark mudarp' value='$id_user'><div class='photo' style='display: inline-block;'>
            <img class='avatar zoom' src='$foto' alt='$nome $apelido'>
            </div>".$nome." ".$apelido."</button><br>";
            echo "<input type='hidden' id='mudarc' value='$id_user'>";
            */
            echo "<a class='mudarp' id='$id_user'><div class='chat_list' id='chat_list_$id_user'>
            <div class='chat_people'>
            <div class='chat_img'> <img src='$foto' alt='$nome $apelido'> </div>
            <div class='chat_ib'>
            <h5>$nome $apelido <span class='chat_date'>Dec 25</span></h5>
            <p>$sobre</p>
            </div>
            </div>
            </div></a>";
            echo "<input type='hidden' id='mudarc' value='$id_user'>";

          }
        }
      }
?>