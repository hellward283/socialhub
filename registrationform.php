<?php
require "database.php";

$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $fullname = trim($_POST["fullname"]);

    if(empty($username)){
        $errors[] = "Username is required";
    }

    if(strlen($password) < 6){
        $errors[] = "Password must be at least 6 characters";
    }

    if(empty($fullname)){
        $errors[] = "Full name is required";
    }

    if(empty($errors)){
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $conn->query("INSERT INTO users (username,password,fullname) VALUES ('$username','$hashed','$fullname')");

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            title: 'Congratulations!',
            text: 'Registration successful!',
            icon: 'success'
        }).then(() => {
            window.location.href='loginpage.php';
        });
        </script>
        ";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Register</h2>

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
            Full Name
            <input type="text" name="fullname" required>

            Username
            <input type="text" name="username" required>

            Password
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>

        <p style="margin-top:10px;">
            Already have an account? <a href="loginpage.php">Login</a>
        </p>
    </div>
</div>

</body>
</html>