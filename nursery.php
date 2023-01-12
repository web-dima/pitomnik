<?php require "utils/header.php"?>
<main>
    <section class="nurseries">
        <div class="container">
            <h1 class="section__title nurseries__title">адреса питомников</h1>
            <?php
            
                require_once "config/conn.php";

                $query = mysqli_query($conn, "SELECT * FROM `nursery`");

                if (mysqli_num_rows($query) <= 0) {
                    exit("<h1>пока нет зарегистрированных питомников</h1>");
                }

                while ($row = mysqli_fetch_assoc($query)) { ?>
                    <div class="nursery">
                        <div class="nursery__title">название - <?= $row['name']?></div>
                        <img class="nursery__img" src='img/<?= $row['img'] ?>'>
                        <div class="nursery__address">адресс - <?= $row['address']?></div>
                        <div class="nursery__time">часы работы - <?= $row['time_work']?></div>
                        <div class="nursery__phone">телефон - <a href="<?= $row['phone']?>"><?= $row['phone']?></a></div>
                    </div>

            <?  }?>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>