<?php 
include 'header.php'; 
$meu = $_SESSION['user'][5];
//$query = mysqli_query($link, "SELECT DISTINCT f_nome, l_nome, id, email, sobre, foto, username, idade FROM users INNER JOIN messages ON users.id = messages.user_from OR users.id = messages.user_to WHERE users.id != '$meu' AND messages.user_from='$meu' OR messages.user_to='$meu' ORDER BY messages.data ASC");

//$query = mysqli_query($link, "SELECT * FROM users INNER JOIN seguidores ON users.id = seguidores.id_user WHERE id_seguidor='$meu'");

$query = mysqli_query($link, "SELECT * FROM users");

?>
<h3 class=" text-center display-4 text-white" style="background-color: black;
    opacity: 0.8;">Messages</h3>
<div class="messaging">
  <div class="inbox_msg">
    <div class="inbox_people postbi">
      <div class="headind_srch">
        <div class="recent_heading">
          <h4>Recentes</h4>
        </div>
        <div class="srch_bar">
          <div class="stylish-input-group">
            <input id="mensagens_text" type="text" class="search-bar" placeholder="Pesquisar.." >
            <span class="input-group-addon">
              <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
            </span> </div>
          </div>
        </div>

        <div class="inbox_chat" id="resultado_mensagens">
          
          <?php
          while ($info_user = mysqli_fetch_array($query)) {
            $id_user = $info_user['id'];
            $email = $info_user['email'];
            $nome = $info_user['f_nome'];
            $apelido = $info_user['l_nome'];
            $idade = $info_user['idade'];
            $username = $info_user['username'];
            $sobre = $info_user['sobre'];
            $foto = $info_user['foto'];


            echo "<a class='mudarp' id='$id_user'><div class='chat_list' id='chat_list_$id_user'>
            <div class='chat_people'>
            <div class='chat_img'> <img src='$foto' alt='$nome $apelido' id='foto_user_$id_user'> </div>
            <div class='chat_ib'>
            <h5><span id='nome_$id_user' style='float: none; font-size: 15px;'>$nome</span> <span id='apelido_$id_user' style='float: none; font-size: 15px;'>$apelido</span> <span class='chat_date'>Dec 25</span></h5>
            <p>$sobre</p>
            </div>
            </div>
            </div></a>";
            echo "<input type='hidden' id='mudarc' value='$id_user'>";

          }
          ?>

        </div>
      </div>
      <div class="mesgs" style="position: relative;">
        <div style="
    width: 100%;
    background: rgba(30, 40, 51, 1);
    position: absolute;
    height: 100px;
    color: white !important;
    font-size: 20px;
    /* opacity: .77; */
">
<?php
$badges=array("primary", "warning", "info", "secondary", "danger", "success", "light", "dark");
//<?php echo $badges[array_rand($badges)];
?>
       <a id="a_putas" href="profile/<?php if (isset($_SESSION['mensagem'])) { echo $_SESSION['mensagem'][0]; } else { echo $id_user; } ?>"><img id="main_imagem" src="<?php if (isset($_SESSION['mensagem'])) { echo $_SESSION['mensagem'][1]; } else { echo $foto; } ?>" style="width: 15%; height: 100%;"> 

        <span id="badgezinho" class="badge badge-<?php echo $badges[array_rand($badges)]; ?>">
       <span id="main_nome"><?php if (isset($_SESSION['mensagem'])) { echo $_SESSION['mensagem'][2]; } else { echo $nome; } ?></span> <span id="main_apelido"><?php if (isset($_SESSION['mensagem'])) { echo $_SESSION['mensagem'][3]; } else { echo $apelido; } ?></span></span></a>
    </div>

        <div class="msg_history mensagens" style="margin-top: 100px; height: 430px !important;">

         
                  </div>
                  <div class="type_msg">
                    <div class="input_msg_write">
                      <textarea id="enviar" type="text" class="form-control" placeholder="Type a message [ENTER]" /></textarea>
                      <input type="hidden" id="other" value="<?php if (isset($_SESSION['mensagem'])) { echo $_SESSION['mensagem'][0]; unset($_SESSION['mensagem']); } else { echo $id_user; } ?>">
                    </div>
                  </div>
                </div>
              </div>


            </div>
            <?php include 'footer.php'; ?>