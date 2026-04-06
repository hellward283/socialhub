<?php
require "../app/models/PostModel.php";
require "../app/models/CommentModel.php";

class PostController {

    function index(){
        global $conn;
        $postModel = new PostModel($conn);
        $commentModel = new CommentModel($conn);

        $posts = $postModel->getAll();
        require "../app/views/posts/index.php";
    }

    function create(){
        global $conn;
        (new PostModel($conn))->create($_SESSION['user_id'],$_POST['content']);
        header("Location: ?");
    }
}