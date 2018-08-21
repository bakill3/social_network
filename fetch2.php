<?php
include 'ligar_db.php';
$output = '<ul class="list-group">';
if(isset($_POST["query"]))
{
  $search = mysqli_real_escape_string($link, $_POST["query"]);
  $query = "
  SELECT * FROM users 
  WHERE f_nome LIKE '%".$search."%' OR l_nome LIKE '%".$search."%' OR username LIKE '%".$search."%' LIMIT 5;";
 

$result = mysqli_query($link, $query);
if (!mysqli_query($link, $query))
{
  echo("Erro: " . mysqli_error($link));
}
if(mysqli_num_rows($result) > 0)
{
  //$output .= '<ul class="suggestions" style="max-height: 30%; max-width: 250%;"><li style="background-color: salmon;">Pressione ENTER para pesquisar</li>';
  while($row = mysqli_fetch_array($result))
  {
    $id_user = $row['id'];
    $img = $row['foto'];
    $output .= '<a href="profile.php?id='.$row["id"].'"><li class="list-group-item"><img class="rounded-circle" src="'.$img.'" style="width: 50px;">'.$row["f_nome"]." ".$row['l_nome'].'</li></a>';
    //$output .= '<a href="produto/'.$row["id"].'"><li><img src="'.$img.'" style="width: 13%;">'.$row["f_nome"]." ".$row['l_nome'].'</li></a>';
  }
  $output .= "</ul>";
  echo $output;
}
else
{
  $output .= 'ua';
}
}
?>