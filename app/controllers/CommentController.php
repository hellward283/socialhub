<?php
require "../app/models/CommentModel.php";

class CommentController {
    function add(){
        global $conn;
        (new CommentModel($conn))->add(
            $_POST['post_id'],
            $_SESSION['user_id'],
            $_POST['content']
        );
        header("Location: ?");
    }
}