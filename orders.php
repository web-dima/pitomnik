<?php require "utils/header.php"?>
<?php

require_once "config/conn.php";
    error_reporting(0);
    $userid = $_SESSION["user"]; 
    $query = mysqli_query($conn, "SELECT *, orders.id as orders_id, orders.status as order_status, animals.name as animal_name , animals.img as animal_img FROM `orders` INNER JOIN `animals` ON `animals`.`id` = `orders`.`animal_id` RIGHT JOIN `nursery` ON `animals`.`nursery_id` = `nursery`.`id` WHERE `user_id` = $userid");
    
?>
<main>
    <section class="orders">
        <div class="container">
            <h1 class="section__title orders__title">заявки</h1>
            <?php
                require "utils/functions.php";
                while ($row = mysqli_fetch_assoc($query)) : ?>
                    <div class="order">
                        <div class="order__name">кличка - <?=$row["animal_name"]?></div>
                        <div class="order__img">
                            <img src='img/<?=$row["animal_img"]?>'>
                        </div>

                        <div class="order__info">
                            <div class="order__info-left">
                                <div class="animal__about-field">кличка - <?=$row["animal_name"]?></div>
                                <div class="animal__about-field">возраст - <?=$row["age"]?> <?=num2word($row["age"])?></div>
                                <div class="animal__about-field">порода - <?=$row["breed"]?></div>
                                <div class="animal__about-field">приют - <?=$row["name"]?></div>
                            </div>
                            <div class="order__info-right">
                                <div class="order__status order__status--pending">статус - <span><?=$row["order_status"]?></span></div>
                                <button class="order__btn btn" id="order-btn" value='<?=$row["orders_id"]?>'>отменить</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>

            
            
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>