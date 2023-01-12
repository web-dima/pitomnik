<?php
session_start();
error_reporting(0);
if (empty($_SESSION["user"])) {
    exit(json_encode(["success" => false,"type"=> "auth_error"]));
}
$user_id = $_SESSION["user"];
$animal_id = $_POST["animal_id"];

if (empty($animal_id)) {
    exit(json_encode(["success" => false,"error"=>"что то пошло не так, попробуйте еще раз"]));
}


require_once "../config/conn.php";
$date = date("Y.m.d");

$query = mysqli_query($conn, "INSERT INTO `orders`(`user_id`, `animal_id`, `date`, `status`) VALUES ($user_id,$animal_id,'$date','в обработке')");

if (mysqli_affected_rows($conn) <= 0) {
    exit(json_encode(["success" => false,"error"=>"не получилось зарегистрировать заявку"]));
}


$query = mysqli_query($conn, "UPDATE `animals` SET `status` = 'зарезервировано' WHERE `id` = $animal_id");

if (mysqli_affected_rows($conn) <= 0) {
    exit(json_encode(["success" => false,"error"=>"SQL ошибка попробуйте еще раз"]));
}

echo(json_encode(["success" => true]));


?>