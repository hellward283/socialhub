<?php
session_start();
require "../config/database.php";
?>

<!DOCTYPE html>
<html>
<head>

<title>SocialHub</title>

<link rel="stylesheet" href="assets/styles.css">

</head>

<body>

<?php

$page = $_GET['page'] ?? 'home';

/* LOGIN + REGISTER CENTERED */
if($page == "login" || $page == "register"){
    echo '<div class="container">';
}

/* FEED LAYOUT */
else{
    echo '<div class="feed-container">';
}

switch ($page) {

    case 'login':
        require "../app/controllers/AuthController.php";
        (new AuthController())->login();
        break;

    case 'register':
        require "../app/controllers/AuthController.php";
        (new AuthController())->register();
        break;

    case 'logout':
        require "../app/controllers/AuthController.php";
        (new AuthController())->logout();
        break;

    case 'post/create':
        require "../app/controllers/PostController.php";
        (new PostController())->create();
        break;

    case 'comment/add':
        require "../app/controllers/CommentController.php";
        (new CommentController())->add();
        break;

    case 'profile':
        require "../app/controllers/ProfileController.php";
        (new ProfileController())->index();
        break;

    case 'profile/edit':
        require "../app/controllers/ProfileController.php";
        (new ProfileController())->edit();
        break;

    case 'profile/update':
        require "../app/controllers/ProfileController.php";
        (new ProfileController())->update();
        break;

    case 'post/delete':
    require "../app/controllers/PostController.php";
    (new PostController())->delete();
    break;

    case 'like/add':
    require "../app/controllers/LikeController.php";
    (new LikeController())->add();
    break;

    default:
        require "../app/controllers/PostController.php";
        (new PostController())->index();
        break;
    
    
}

echo "</div>";

?>

</body>
</html>