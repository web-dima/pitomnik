<?php
session_start();

if (isset($_SESSION["user"])) {
    require_once "config/conn.php";
    error_reporting(0);
    $id = $_SESSION["user"];
    $query = mysqli_query($conn, "SELECT `role` FROM users WHERE id = $id");
    $result = mysqli_fetch_assoc($query);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- <link rel="stylesheet" href="css/slick.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <title>последний питомник на планете</title>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a class="header__logo" href="index.php">
                    <img src="img/logo.png" alt="хомбо">
                </a>
                <div class="header__title">
                    <?php
                        if (isset($_SESSION["user"]) && !$result["role"] === "admin") {
                            echo "последний питомник на планете";
                        }
                    ?>
                </div>
                <ul class="header__nav">
                    <li class="header__nav-item"><a href="animals.php">животные</a></li>
                    <li class="header__nav-item"><a href="nursery.php">питомники</a></li>
                    <?php
                        if (isset($_SESSION["user"]) && $result["role"] === "user") {
                            echo "<li class='header__nav-item'><a href='orders.php'>заявки</a></li>";
                            echo "<li class='header__nav-item'><a href='actions/logout.php'>выйти</a></li>";
                        }
                        else if (isset($_SESSION["user"]) && $result["role"] === "admin") {
                            
                            echo "<li class='header__nav-item'><a href='admin-orders.php'>заявки</a></li>";
                            echo "<li class='header__nav-item'><a href='admin-animal.php'>добавить животное</a></li>";
                            echo "<li class='header__nav-item'><a href='actions/logout.php'>выйти</a></li>";
                        }
                        else {
                            echo "<li class='header__nav-item'><a href='login.php'>войти</a></li>";
                        }
                    ?>
                    
                </ul>
            </div>
        </div>

    </header>
