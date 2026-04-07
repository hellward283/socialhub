<?php

class CommentModel {

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    // ✅ FIXED parameter order
    public function add($post_id, $user_id, $content){

        $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (?,?,?)";

        $stmt = $this->conn->prepare($sql);

        if(!$stmt){
            die("SQL Error: " . $this->conn->error);
        }

        $stmt->bind_param("iis", $post_id, $user_id, $content);
        $stmt->execute();
    }

    // ✅ ADDED missing function
    public function getByPost($post_id){

        $stmt = $this->conn->prepare("
            SELECT comments.*, users.username 
            FROM comments
            JOIN users ON comments.user_id = users.id
            WHERE post_id = ?
            ORDER BY comments.id DESC
        ");

        $stmt->bind_param("i", $post_id);
        $stmt->execute();

        return $stmt->get_result();
    }
}