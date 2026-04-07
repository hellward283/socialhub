<?php
class LikeModel {
    private $conn;
    function __construct($conn){ $this->conn=$conn; }

    function like($post_id,$user_id){
        $stmt=$this->conn->prepare("INSERT INTO likes(post_id,user_id) VALUES(?,?)");
        $stmt->bind_param("ii",$post_id,$user_id);
        return $stmt->execute();
    }

function count($post_id){
    $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM likes WHERE post_id=?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()['total'];
}
}