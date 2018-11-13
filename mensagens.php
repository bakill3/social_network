<?php 
include 'header.php'; 
$meu = $_SESSION['user'][5];
//$query = mysqli_query($link, "SELECT DISTINCT f_nome, l_nome, id, email, sobre, foto, username, idade FROM users INNER JOIN messages ON users.id = messages.user_from OR users.id = messages.user_to WHERE users.id != '$meu' AND messages.user_from='$meu' OR messages.user_to='$meu' ORDER BY messages.data ASC");

//$query = mysqli_query($link, "SELECT * FROM users INNER JOIN seguidores ON users.id = seguidores.id_user WHERE id_seguidor='$meu'");

$query = mysqli_query($link, "SELECT * FROM users");

?>
<h3 class=" text-center display-4 text-white" style="background-color: black;
    opacity: 0.8;">Mensagens</h3>
<div class="messaging">
  <div class="inbox_msg">
    <div class="inbox_people">
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
          
          <!--
          <div class="chat_list active_chat">
            <div class="chat_people">
              <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
              <div class="chat_ib">
                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                <p>Test, which is a new approach to have all solutions 
                astrology under one roof.</p>
              </div>
            </div>

          </div>
          -->
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
          ?>
          <!--
          <div class='chat_list'>
            <div class='chat_people'>
              <div class='chat_img'> <img src='https://ptetutorials.com/images/user-profile.png' alt='sunil'> </div>
              <div class='chat_ib'>
                <h5>Sunil Rajput <span class='chat_date'>Dec 25</span></h5>
                <p>Test, which is a new approach to have all solutions 
                astrology under one roof.</p>
              </div>
            </div>
          </div>
        -->


        </div>
      </div>
      <div class="mesgs">
        <div class="msg_history mensagens">
         
                  </div>
                  <div class="type_msg">
                    <div class="input_msg_write">
                      <textarea id="enviar" type="text" class="form-control" placeholder="Type a message" /></textarea>
                      <input type="hidden" id="other" value="<?php if (isset($_SESSION['mensagem'])) { echo $_SESSION['mensagem'][0]; unset($_SESSION['mensagem']); } else { echo $id_user; } ?>">
                    </div>
                  </div>
                </div>
              </div>


            </div>
            <?php include 'footer.php'; ?>