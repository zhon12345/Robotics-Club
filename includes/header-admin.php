<?php require_once('includes/helper.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://www.tarc.edu.my/images/tarIco.ico" />
    <title><?php echo $title ?></title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="<?php echo $css ?>" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="sidenav">
        <div class="container">
            <div class="logo">
                <a href="admin.php"><i class="fa-solid fa-user"></i><?php echo ADMIN_USER ?></a>
            </div>
            <div class="links">
                <a href="">Projects</a>
                <a href="add-news.php">News</a>
                <a href="users.php">Users</a>
                <a href="">Notification</a>
            </div>
            <div class="logout">
                <a href="index.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
            </div>
        </div>
    </div>