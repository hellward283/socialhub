<div class="navbar">

<div><strong>SocialHub</strong></div>

<div>
<a href="?page=profile">Profile</a> |
<a href="?page=logout">Logout</a>
</div>

</div>


<div class="card">

<h3>Create Post</h3>

<form method="POST" action="?page=post/create">
<textarea name="content" placeholder="Start a post..." required></textarea>
<button>Post</button>
</form>

</div>


<?php while($row = $posts->fetch_assoc()){ ?>

<div class="card">

<div class="post">
<?= htmlspecialchars($row['content']) ?>
</div>

<?php
require_once __DIR__ . "/../../models/LikeModel.php";
$likeModel = new LikeModel($conn);
$likes = $likeModel->count($row['id']);
?>

<form method="POST" action="?page=like/add">
<input type="hidden" name="post_id" value="<?= $row['id'] ?>">
<button class="like-btn">👍 Like (<?= $likes ?>)</button>
</form>

<hr>

<form method="POST" action="?page=comment/add">
<input type="hidden" name="post_id" value="<?= $row['id'] ?>">
<input name="content" placeholder="Write a comment...">
<button>Comment</button>
</form>

<?php if($c['user_id'] == $_SESSION['user_id']){ ?>

<a href="?page=comment/edit&id=<?= $c['id'] ?>">Edit</a>

<a href="?page=comment/delete&id=<?= $c['id'] ?>" 
   onclick="return confirm('Delete comment?')">Delete</a>

<?php } ?>

<?php
// ✅ FIX: properly create comment model
require_once __DIR__ . "/../../models/CommentModel.php";

$commentModel = new CommentModel($conn);
$comments = $commentModel->getByPost($row['id']);

while($c = $comments->fetch_assoc()){
?>

<div class="comment">
<strong><?= htmlspecialchars($c['username']) ?>:</strong>
<?= htmlspecialchars($c['content']) ?>
</div>

<?php } ?>

</div>

<?php } ?>