<?php

class PostModel{

private $conn;

public function __construct($conn){
$this->conn = $conn;
}

public function getPosts(){

$sql = "SELECT posts.*, users.username 
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY created_at DESC";

$result = $this->conn->query($sql);

return $result;

}

public function create($user_id,$content){

$sql = "INSERT INTO posts (user_id,content) VALUES (?,?)";

$stmt = $this->conn->prepare($sql);
$stmt->bind_param("is",$user_id,$content);
$stmt->execute();

}

}