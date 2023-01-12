<?php

session_start();
include '../config/conn.php';
error_reporting(0);

$email = $_POST["email"];
$name = $_POST["name"];
$pass = $_POST["password"];
$options = array(
    'options' => array(
        'min_range' => 3,
        'max_range' => 8,
    )
);

if (empty($email) || empty($name) || empty($pass)) {
    exit(json_encode(["success" => false,"error"=>"поля не должны быть пустыми"]));
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit(json_encode(["success" => false,"error"=>"email невалидный"]));
}

if (strlen($pass) < 3) {
    exit(json_encode(["success" => false,"error"=>"пароль должен длинее 3 символов"]));
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

if (mysqli_num_rows($result) > 0) {
    exit(json_encode(["success" => false,"error"=>"пользователь с таким email уже существует"]));
}

$hash = password_hash($pass, PASSWORD_DEFAULT);

$query = mysqli_query($conn, "INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES ('$name','$email','$hash','user')");


if (mysqli_affected_rows($conn) > 0) {
    $id = mysqli_insert_id($conn);
    $_SESSION["user"] = $id;
    echo(json_encode(["success" => true]));
}
