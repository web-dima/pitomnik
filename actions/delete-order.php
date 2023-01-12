<?php
    error_reporting(0);
    require_once "../config/conn.php";

    $orderId = intval($_POST["order_id"]);

    $query = mysqli_query($conn, "SELECT animal_id FROM `orders` WHERE `id` = $orderId");

    if (mysqli_num_rows($query) <= 0) {
        exit(json_encode(["success" => false,"error"=>"такой заявки не существует"]));
    }

    $animalId = mysqli_fetch_assoc($query)["animal_id"];
    
    $query = mysqli_query($conn, "UPDATE `animals` SET `status` = 'в питомнике' WHERE `animals`.`id` = $animalId");

    if (mysqli_affected_rows($conn) <= 0) {
        exit(json_encode(["success" => false,"error"=>"не получилось обновить статус"]));
    }

    $query = mysqli_query($conn, "DELETE FROM `orders` WHERE `id` = $orderId");

    if (mysqli_affected_rows($conn) <= 0) {
        exit(json_encode(["success" => false,"error"=>"не получилось удалить заказ"]));
    }
    
    echo(json_encode(["success" => true]));


    
?>