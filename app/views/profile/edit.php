<div class="card">

<h2>Edit Profile</h2>

<form method="POST" action="index.php?page=profile/update" enctype="multipart/form-data">

<label>Full Name</label>
<input type="text" name="fullname" value="<?= $user['fullname'] ?? '' ?>">

<label>Bio</label>
<textarea name="bio"><?= $user['bio'] ?? '' ?></textarea>

<label>Profile Picture</label>
<input type="file" name="profile_pic">

<button type="submit">Update</button>

</form>

</div>