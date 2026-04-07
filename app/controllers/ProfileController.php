<?php

class ProfileController {

    function index(){
    if(!isset($_SESSION['user_id'])){
        header("Location: ?page=login");
        exit;
    }

    global $conn;

    $id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $user = $stmt->get_result()->fetch_assoc();

    require "../app/views/profile/profile.php";
}

    function edit(){
        if(!isset($_SESSION['user_id'])){
            header("Location: ?page=login");
            exit;
        }

        global $conn;

        $id = $_SESSION['user_id'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();

        require "../app/views/profile/edit.php";
    }

    function update(){
        if(!isset($_SESSION['user_id'])){
            header("Location: ?page=login");
            exit;
        }

        global $conn;

        $id = $_SESSION['user_id'];
        $fullname = $_POST['fullname'];
        $bio = $_POST['bio'];

        if(!empty($_FILES['image']['name'])){
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];

            move_uploaded_file($tmp, "../public/assets/uploads/".$image);

            $stmt = $conn->prepare("UPDATE users SET fullname=?, bio=?, profile_image=? WHERE id=?");
            $stmt->bind_param("sssi",$fullname,$bio,$image,$id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET fullname=?, bio=? WHERE id=?");
            $stmt->bind_param("ssi",$fullname,$bio,$id);
        }

        $stmt->execute();

        header("Location: ?page=profile");
        exit;
    }
}