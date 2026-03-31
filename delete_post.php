<?php
include "database.php";

$id = $_POST['id'];

$conn->query("DELETE FROM posts WHERE id=$id");
?>