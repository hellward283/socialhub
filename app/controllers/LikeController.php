<?php
require_once __DIR__ . "/../models/LikeModel.php";

class LikeController {

    function add(){

        if(!isset($_SESSION['user_id'])){
            header("Location: ?page=login");
            exit;
        }

        global $conn;

        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];

        $model = new LikeModel($conn);

        // ✅ Prevent duplicate likes
        $check = $conn->prepare("SELECT * FROM likes WHERE post_id=? AND user_id=?");
        $check->bind_param("ii", $post_id, $user_id);
        $check->execute();

        if($check->get_result()->num_rows == 0){
            $model->like($post_id, $user_id);
        }

        header("Location: ?");
        exit;
    }
}