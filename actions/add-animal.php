<?php
error_reporting(0);
$type = $_POST["type"];
$name = $_POST["name"];
$sex = $_POST["sex"];
$age = $_POST["age"];
$breed = $_POST["breed"];
$nursery = $_POST["nursery"];
$img = $_FILES["img"]["name"];

if (empty($type) || empty($name) || empty($sex) || empty($age) || empty($breed) || empty($nursery) || empty($age)  || empty($_FILES["img"]["name"]) ) {
    exit(json_encode(["success" => false,"error"=>"поля не должны быть пустыми"]));
}

$target_directory = "../img/";
$path = $target_directory.$_FILES["img"]["name"];
if (move_uploaded_file($_FILES["img"]["tmp_name"],$path)) {
    
    require_once "../config/conn.php";

    $query = mysqli_query($conn, "INSERT INTO `animals`(`name`, `breed`, `type`, `nursery_id`, `sex`, `age`, `img`, `status`) VALUES ('$name','$breed','$type','$nursery','$sex','$age','$img','в питомнике')");
    
    if (mysqli_affected_rows($conn) <= 0) {
        exit(json_encode(["success" => false,"error"=>"SQL ошибка попробуйте еще раз"]));
    }

    echo(json_encode(["success" => true, "message" => "успешно добавлено"]));

}
else {
    exit(json_encode(["success" => false,"error"=>"ошибка загрузки файла"]));
}


 ?>