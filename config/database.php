<?php
$conn = new mysqli("localhost", "root", "", "socialhub");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>