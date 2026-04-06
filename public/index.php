<?php include "database.php"; ?>

<link rel="stylesheet" href="style.css">
<script src="script.js"></script>

<div class="container">
<h2>Posts</h2>

<?php
$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
while($row = $result->fetch_assoc()){
?>

<div class="card">
    <p><?php echo $row['content']; ?></p>

    <button onclick="likePost(<?php echo $row['id']; ?>)">Like</button>
    <span id="like-count-<?php echo $row['id']; ?>">0</span>

    <input type="text" id="comment-<?php echo $row['id']; ?>">
    <button onclick="addComment(<?php echo $row['id']; ?>)">Comment</button>

    <?php
    $comments = $conn->query("SELECT * FROM comments WHERE post_id=".$row['id']);
    while($c = $comments->fetch_assoc()){
    ?>
        <div class="comment">
            <span id="comment-text-<?php echo $c['id']; ?>">
                <?php echo $c['comment']; ?>
            </span>
            <button onclick="editComment(<?php echo $c['id']; ?>)">Edit</button>
            <button onclick="deleteComment(<?php echo $c['id']; ?>)">Delete</button>
        </div>
    <?php } ?>

</div>

<?php } ?>
</div>