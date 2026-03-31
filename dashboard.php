<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: loginpage.php");
    exit;
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">

    <div class="header">
        <h2>Welcome <?php echo $_SESSION["username"]; ?></h2>
    </div>

    <div class="nav">
        <a href="index.php">Newsfeed</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="card">
        <form action="create_post.php" method="POST">
            <textarea name="content" placeholder="What's on your mind?"></textarea>
            <button type="submit">Post</button>
        </form>
    </div>

</div>