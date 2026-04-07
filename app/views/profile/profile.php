<div class="card">

<h2>User Profile</h2>


<p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
<p><strong>Full Name:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
<p><strong>Bio:</strong> <?= htmlspecialchars($user['bio'] ?? 'No bio yet') ?></p>

<br>
<h3>Your Posts</h3>

<?php while($p = $posts->fetch_assoc()){ ?>
<div class="card">
<?= htmlspecialchars($p['content']) ?>
</div>
<?php } ?>

<a href="?">Back to Feed</a> |
<a href="?page=profile/edit">Edit Profile</a> |
<a href="?page=logout">Logout</a>

</div>