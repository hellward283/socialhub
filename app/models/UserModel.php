<?php
class UserModel {
    private $conn;
    function __construct($conn){ $this->conn = $conn; }

    function findByUsername($username){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    function create($username,$password,$fullname){
        $stmt = $this->conn->prepare("INSERT INTO users(username,password,full_name) VALUES(?,?,?)");
        $stmt->bind_param("sss",$username,$password,$fullname);
        return $stmt->execute();
    }
}