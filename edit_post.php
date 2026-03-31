<?php
include "database.php";

$id = $_POST['id'];
$content = $_POST['content'];

$conn->query("UPDATE posts SET content='$content' WHERE id=$id");
?>