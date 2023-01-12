<?php
require_once "../config/conn.php";
error_reporting(0);
$order_id = intval($_POST["order_id"]);
$user_id = intval($_POST["user_id"]);
$animal_id = intval($_POST["animal_id"]);
$nursery_id = intval($_POST["nursery_id"]);
$status = $_POST["status"];
// $statuses = [
//     ["status" => "в обработке"],
//     ["status" => "одобрено"],
//     ["status" => "отказано"],
//     ["status" => "завершен"],
// ];

switch ($status) {
    case 'в обработке':
        exit(json_encode(["success" => false,"error"=>"нельзя изменить статус на 'в обработке'"]));
        break;
    case 'одобрено': {
        $query = mysqli_query($conn, "UPDATE `orders` SET `status` = '$status' WHERE `orders`.`id` = $order_id");

        if (mysqli_affected_rows($conn) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось обновить статус"]));
        }

        $nursery_query = mysqli_query($conn, "SELECT * FROM `nursery` WHERE `id` = $nursery_id");

        if (mysqli_affected_rows($conn) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось удалить заказ"]));
        }
        $nursery = mysqli_fetch_assoc($nursery_query);

        $query = mysqli_query($conn, "SELECT `name`,`email`FROM `users` WHERE `id` = $user_id");

        if (mysqli_num_rows($query) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось найти пользователя"]));
        }

        $user = mysqli_fetch_assoc($query);
        $message = "здравствуйте {$user['name']}, ваша заявка была одобрена, приходите по адресу {$nursery['address']}, часы работы - {$nursery['time_work']}";
        mail($user["email"], "ваша заявка была одобрена", $message);

        echo(json_encode(["success" => true, "message" => "статус заявки был изменен", "delete" => false]));
        break;
    }
    case 'отказано': {
        $query = mysqli_query($conn, "UPDATE `animals` SET `status` = 'в питомнике' WHERE `animals`.`id` = $animal_id");

        if (mysqli_affected_rows($conn) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось обновить статус"]));
        }

        $query = mysqli_query($conn, "DELETE FROM `orders` WHERE `id` = $order_id");

        if (mysqli_affected_rows($conn) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось удалить заказ"]));
        }

        $query = mysqli_query($conn, "SELECT `name`,`email`FROM `users` WHERE `id` = $user_id");

        if (mysqli_num_rows($query) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось найти пользователя"]));
        }

        $user = mysqli_fetch_assoc($query);
        $message = "здравствуйте {$user['name']}, ваша заявка была отменена";
        mail($user["email"], "отмена вашей заявки", $message);

        echo(json_encode(["success" => true, "message" => "статус заявки был изменен", "delete" => true]));
        break;
    }
    case 'завершен': {
        $date = date("Y.m.d");
        // echo $date;
        $query = mysqli_query($conn, "UPDATE `animals` SET `status` = 'отдан', `date` = '$date' WHERE `animals`.`id` = $animal_id");

        if (mysqli_affected_rows($conn) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось обновить статус"]));
        }

        $query = mysqli_query($conn, "DELETE FROM `orders` WHERE `id` = $order_id");

        if (mysqli_affected_rows($conn) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось удалить заказ"]));
        }


        $query = mysqli_query($conn, "SELECT `name`,`email`FROM `users` WHERE `id` = $user_id");

        if (mysqli_num_rows($query) <= 0) {
            exit(json_encode(["success" => false,"error"=>"не получилось найти пользователя"]));
        }

        $user = mysqli_fetch_assoc($query);
        $message = "здравствуйте {$user['name']}, ваша заявка была завершена, если у вас будет желание и возможность, то заходите еще";
        mail($user["email"], "Большое вам спасибо", $message);

        echo(json_encode(["success" => true, "message" => "статус заявки был изменен", "delete" => true]));
        break;
    }
}


?>