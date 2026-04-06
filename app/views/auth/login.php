<?php
session_start();
require "database.php";

$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if(empty($username) || empty($password)){
        $errors[] = "All fields are required";
    }

    if(empty($errors)){
        $result = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user = $result->fetch_assoc();

        if($user && password_verify($password, $user["password"])){
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                title: 'Welcome!',
                text: 'Login successful!',
                icon: 'success'
            }).then(() => {
                window.location.href='dashboard.php';
            });
            </script>
            ";
            exit;
        } else {
            $errors[] = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Login</h2>

        <?php
        if(!empty($errors)){
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            foreach($errors as $error){
                echo "
                <script>
                Swal.fire({
                    title: 'Error',
                    text: '$error',
                    icon: 'error'
                });
                </script>
                ";
            }
        }
        ?>

        <form method="POST">
            Username
            <input type="text" name="username" required>

            Password
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p style="margin-top:10px;">
            Don't have an account? <a href="registrationform.php">Register</a>
        </p>
    </div>
</div>

</body>
</html>