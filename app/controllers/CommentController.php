<?php
require_once __DIR__ . "/../models/CommentModel.php";

class CommentController {

    function add(){

        if(!isset($_SESSION['user_id'])){
            header("Location: ?page=login");
            exit;
        }

        global $conn;

        $content = trim($_POST['content']);

        if(empty($content)){
            header("Location: ?");
            exit;
        }

        // ✅ FIXED ORDER
        (new CommentModel($conn))->add(
            $_POST['post_id'],     // post_id FIRST
            $_SESSION['user_id'],  // user_id SECOND
            $content
        );

        header("Location: ?");
        exit;
    }
}