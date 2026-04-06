<?php
session_start();
include "database.php";

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <div class="card">
        <h2>Profile</h2>

        <img src="uploads/<?php echo $user['profile_image']; ?>" width="120" class="profile-img">

        <p><b>Username:</b> <?php echo $user['username']; ?></p>
        <p><b>Full Name:</b> <?php echo $user['fullname']; ?></p>
        <p><b>Bio:</b> <?php echo $user['bio']; ?></p>

        <a href="edit_profile.php">Edit Profile</a>
    </div>
</div>