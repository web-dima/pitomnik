<?php require "utils/header.php"?>
<?php

require_once "config/conn.php";
    error_reporting(0);
    $query = mysqli_query($conn, "SELECT *,orders.id AS order_id, orders.status as order_status, animals.name as animal_name , animals.img as animal_img FROM `orders` INNER JOIN `animals` ON `animals`.`id` = `orders`.`animal_id` JOIN `nursery` ON `animals`.`nursery_id` = `nursery`.`id`");
    
?>
<main>
    <section class="admOrders-section">
        <div class="container">
            <h1 class="section__title admOrders__title">активные заявки</h1>
            <div class="admOrders">
                <div class="message error"></div>
                <?php
                    require "utils/functions.php";
                    while ($row = mysqli_fetch_assoc($query)) : ?>
                        <div class="admOrder">
                            <div class="admOrder__info">
                                <div class="order__img ustal">
                                    <img src='img/<?=$row['animal_img']?>'>
                                </div>
                                <div class="info__desc">
                                    <div class="animal__about-field">кличка - <?=$row["animal_name"]?></div>
                                    <div class="animal__about-field">возраст - <?=$row["age"]?> <?=num2word($row["age"])?></div>
                                    <div class="animal__about-field">порода - <?=$row["breed"]?></div>
                                    <div class="animal__about-field">приют - <?=$row["name"]?></div>
                                </div>
                            </div>
                            
                            <form class="admOrder__control">
                                <input id='order_id-input' type="hidden" value='<?=$row["order_id"]?>'>
                                <input id='user_id-input' type="hidden" value='<?=$row["user_id"]?>'>
                                <input id='animal_id-input' type="hidden" value='<?=$row["animal_id"]?>'>
                                <input id='nursery_id-input' type="hidden" value='<?=$row["nursery_id"]?>'>
                                <div class="admOrder__control-title">статус заяввки:</div>
                                <select class="admOrder__control__select" name="status-control">
                                    <?php
                                        $statuses = [
                                            ["status" => "в обработке"],
                                            ["status" => "одобрено"],
                                            ["status" => "отказано"],
                                            ["status" => "завершен"],
                                        ];
                                        for ($i=0; $i <count($statuses); $i++) {
                                            $obj = $statuses[$i];

                                            if ($obj["status"] === $row["order_status"]) {
                                                $order_status = $row["order_status"];
                                                $obj_status = $obj["status"];

                                                echo ("<option value='$order_status' selected>$order_status</option>");
                                                continue;
                                            }
                                            $obj_status = $obj["status"];
                                            echo ("<option value='$obj_status'>$obj_status</option>");
                                        }
                                    ?>
                                </select>
                                <button class="admOrder__control-btn btn">сохранить</button>
                            </form>
                        </div>
                    <?php endwhile;?>
            </div>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>