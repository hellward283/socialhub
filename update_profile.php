<?php
session_start();
include "database.php";

$user_id = $_SESSION['user_id'];
$fullname = $_POST['fullname'];
$bio = $_POST['bio'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

if($image){
    move_uploaded_file($tmp,"uploads/".$image);
    $conn->query("UPDATE users SET fullname='$fullname', bio='$bio', profile_image='$image' WHERE id=$user_id");
}else{
    $conn->query("UPDATE users SET fullname='$fullname', bio='$bio' WHERE id=$user_id");
}

header("Location: profile.php");
?>