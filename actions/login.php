<?php

session_start();
include '../config/conn.php';
error_reporting(0);

$email = $_POST["email"];
$pass = $_POST["password"];
$options = array(
    'options' => array(
        'min_range' => 3,
        'max_range' => 8,
    )
);

if (empty($email) || empty($pass)) {
    exit(json_encode(["success" => false,"error"=>"поля не должны быть пустыми"]));
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit(json_encode(["success" => false,"error"=>"email невалидный"]));
}

if (strlen($pass) < 3) {
    exit(json_encode(["success" => false,"error"=>"пароль должен длинее 3 символов"]));
}


$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

if (mysqli_num_rows($query) <= 0) {
    exit(json_encode(["success" => false,"error"=>"пользователя с таким email не существует"]));
}

$res = mysqli_fetch_assoc($query);

if (password_verify($pass, $res["password"])) {
    $_SESSION["user"] = $res["id"];
    echo(json_encode(["success" => true]));
} else {
    exit(json_encode(["success" => false,"error"=>"пароль неверный"]));
}