<?php
include 'ligar_db.php';
$ip_do_user = $_SERVER['REMOTE_ADDR'];
if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
    $latitude = trim($_POST['latitude']);
    $longitude = trim($_POST['longitude']);
    //return address to ajax 

    $query = mysqli_query($link, "SELECT * FROM locations WHERE ip='$ip_do_user'");

    if (mysqli_num_rows($query) == 0) {
        mysqli_query($link, "INSERT INTO locations(latitude, longitude, ip) VALUES ('$latitude', '$longitude', '$ip_do_user')") or die(mysqli_error($link));
    }
}
?>