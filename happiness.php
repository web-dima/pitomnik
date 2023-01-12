<?php require "utils/header.php"?>
<?php
    require_once "config/conn.php";
    error_reporting(0);
    $query = mysqli_query($conn, "SELECT name, img, sex, date FROM `animals` WHERE `status` = 'отдан'");

?>
<main>
    <section class="happiness">
        <div class="container">
            <h1 class="section__title happiness__title">наши счасливчики</h1>
            <h3 class="section__subtitle">Животные, которых взяли в добрые руки!</h3>
            <div class="catalog catalog__happiness">
                <?php
                
                while ($row = mysqli_fetch_assoc($query)) {?>
                    <div class="animal__card-item animal__card-happiness">
                        <div class="animal__card-img">
                            <img src='img/<?=$row["img"]?>'>
                        </div>
                        <div class="animal__card__content">
                            <div class="animal__card__name"><?=$row["name"]?></div>
                            <div>пол: <span class="animal__card__sex"><?=$row["sex"]?></span></div>
                            <div class="animal__card__date">пристроен <?=$row["date"]?></div>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>