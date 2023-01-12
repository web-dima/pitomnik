<?php require "utils/header.php"?>
<?php
    require_once "config/conn.php";
    error_reporting(0);
    $id = htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8');
    $query = mysqli_query($conn, "SELECT `animals`.`name`,`breed`,`type`,`sex`,`age`,`animals`.`img`,`status`, `nursery`.`name` as `nursery_name` FROM `animals` INNER JOIN `nursery` ON `animals`.`nursery_id` = `nursery`.`id` WHERE `animals`.`id` = $id");
    if (mysqli_num_rows($query) <= 0) {
        http_response_code(404);
        exit(" 
        <div class='container' style='height: 100vh; display: flex; justify-content: center; align-items: center; flex-direction: column;'>
            <h1>такой страницы не существует</h1>
            <a href='/' style='text-decoration: underline;'>вернуться на главную</a>
        </div>
        ");
    }
    $result = mysqli_fetch_assoc($query);
    require "utils/functions.php";

?>
<main>
    <section class="animal-section">
        <div class="container">
            <h1 class="section__title animal__title"><?=$result["type"]?> <?=$result["name"]?></h1>
            <div class="animal__inner">
                <img class="animal__img" src='img/<?=$result["img"]?>'>
                <div class="animal__about">
                    <div class="animal__about-field">кличка - <?=$result["name"]?></div>
                    <div class="animal__about-field">пол - <?=$result["sex"]?></div>
                    <div class="animal__about-field">возраст - <?=$result["age"]?> <?=num2word($result["age"])?></div>
                    <div class="animal__about-field">порода - <?=$result["breed"]?></div>
                    <div class="animal__about-field">приют - <?= $result["nursery_name"]?></div>
                    <button class="animal_btn btn" value='<?=$id?>' id="create-order-btn">приютить</button>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>