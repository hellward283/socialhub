<?php

require "../app/models/PostModel.php";

class PostController {

    public function index(){

        global $conn;

        $model = new PostModel($conn);
        $posts = $model->getPosts();

        require "../app/views/posts/index.php";
    }

    public function create(){

        global $conn;

        if(!isset($_SESSION['user_id'])){
            header("Location: ?page=login");
            exit;
        }

        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];

        $model = new PostModel($conn);
        $model->create($user_id, $content);

        header("Location: index.php");
        exit;
    }

    // ✅ ONLY ONE DELETE FUNCTION
    public function delete(){

        global $conn;

        if(!isset($_SESSION['user_id'])){
            header("Location: ?page=login");
            exit;
        }

        $post_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];

        $sql = "DELETE FROM posts WHERE id=? AND user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $post_id, $user_id);
        $stmt->execute();

        header("Location: index.php");
        exit;
    }
}