<?php 
include 'header.php'; 
  $busca = mysqli_query($link, "SELECT * FROM likes WHERE id_user='11' AND id_post='49'") or die(mysqli_error($link));
  if (mysqli_num_rows($busca) == 1) {
    echo "cagalhao";
  }
?>
