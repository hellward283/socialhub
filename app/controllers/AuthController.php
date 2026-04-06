<?php
require "../app/models/UserModel.php";

class AuthController {

    function login(){
        global $conn;
        $model = new UserModel($conn);

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $user = $model->findByUsername($_POST['username']);

            if($user && password_verify($_POST['password'],$user['password'])){
                $_SESSION['user_id']=$user['id'];
                header("Location: ?");
                exit;
            }
        }

        require "../app/views/auth/login.php";
    }

    function register(){
        global $conn;
        $model = new UserModel($conn);

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $model->create(
                $_POST['username'],
                password_hash($_POST['password'],PASSWORD_DEFAULT),
                $_POST['fullname']
            );
            header("Location: ?page=login");
        }

        require "../app/views/auth/register.php";
    }
}