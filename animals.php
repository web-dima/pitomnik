<?php require "utils/header.php"?>
<?php
    require_once "config/conn.php";
    error_reporting(0);
    $query = mysqli_query($conn, "SELECT id,name, img, sex, age FROM `animals` WHERE `status` = 'в питомнике'");
    
?>
<main>
    <section class="catalog-section">
        <div class="container">
            <h1 class="section__title animals__title">Наши животные</h1>
            <div class="catalog-section__content">
                <div class="catalog">
                    <?php
                    require "utils/functions.php";
                    while ($row = mysqli_fetch_assoc($query)) {?>
                        <a class="animal__card-item animal__card-def" href="animal.php?id=<?=$row['id']?>">
                            <div class="animal__card-img">
                                <img src='img/<?=$row["img"]?>'>
                            </div>
                            <div class="animal__card__content">
                                <div class="animal__card__name"><?=$row["name"]?></div>
                                <div class="animal__card__name">возраст - <?=$row["age"]?> <?=num2word($row["age"])?></div>
                                <div>пол: <span class="animal__card__sex"><?=$row["sex"]?></span></div>
                            </div>
                        </a>
                    <?}?>
                </div>
                <div class="filters">
                    <div class="filters__title">фильтры</div>
                    <hr>
                    <form class="filters__form">
                        <button class="btn" id="resetBtn" style="margin-top: 20px; font-family: sans-serif; background: slategray; padding: 10px;">сбросить фильтры</button>
                        <div class="filtered_field">
                            <div class="filters__form-title">тип:</div>
                            <div class="inputs">
                                <div class="filtered_elem">
                                    <input class="change_handle" type="radio" value="собака" name="type"><label for="type">собака</label>
                                </div>
                                <div class="filtered_elem">
                                    <input class="change_handle" type="radio" value="кошка" name="type"><label for="type">кошка</label>
                                </div>
                            </div>
                        </div>

                        <div class="filtered_field">
                            <div class="filters__form-title">пол:</div>
                            <div class="inputs">
                                <div class="filtered_elem">
                                    <input class="change_handle" type="radio" value="мужской" name="sex"><label for="sex">мужской</label>

                                </div>
                                <div class="filtered_elem">
                                    <input class="change_handle" type="radio" value="женский" name="sex"><label for="sex">женский</label>
                                </div>
                            </div>


                        </div>

                        <div class="filtered_field">
                            <div class="filters__form-title">возраст:</div>
                            <label class="filters__age-label" for="age-min">от:</label><input
                                class="filters__age-input change_handle" type="number" name="age-min">
                            <label class="filters__age-label" for="age-max">до:</label><input
                                class="filters__age-input change_handle" type="number" name="age-max">
                        </div>

                        <div class="filtered_field">
                            <div class="filters__form-title">порода:</div>
                            <div class="inputs">
                            <?php
                                $query = mysqli_query($conn, "SELECT DISTINCT breed FROM `animals` WHERE `status` = 'в питомнике'");
                                while ($row = mysqli_fetch_assoc($query)) : ?>
                                    <div class="filtered_elem">
                                        <input class="change_handle" type="checkbox" name="breed" value='<?=$row["breed"]?>'><label for="breed"><?=$row["breed"]?></label>
                                    </div>
                                <?endwhile?>
                            </div>

                        </div>
                        <button class="btn" id="fillterBtn" style="margin-top: 20px; background: tan;">применить фильтры</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</main>
<?php require "utils/footer.php"?>