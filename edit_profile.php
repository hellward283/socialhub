<?php
session_start();
include "database.php";

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
?>

<h2>Edit Profile</h2>

<form action="update_profile.php" method="POST" enctype="multipart/form-data">

Full Name<br>
<input type="text" name="fullname" value="<?php echo $user['fullname']; ?>"><br><br>

Bio<br>
<textarea name="bio"><?php echo $user['bio']; ?></textarea><br><br>

Profile Image<br>
<input type="file" name="image"><br><br>

<button type="submit">Update</button>

</form>