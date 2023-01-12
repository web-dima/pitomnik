<?php require "utils/header.php"?>
<?php
    require_once "config/conn.php";
    error_reporting(0);
    $query = mysqli_query($conn, "SELECT id,name,sex,img FROM `animals` WHERE status = 'в питомнике' ORDER BY id DESC LIMIT 4");

?>

<section class="slider__section">
    <div class="slider">
        <div class="slider__item">
            <div class="slider__item_wrapper">
                <img class="slider__item-img" src="img/slider_img1.jpg">
                <div class="container">
                    <div class="slider__content">
                        <div class="slider__text">
                            <h2 class="slider__text-title">завоз новых животных</h2>
                            <div class="slider__text-subtitle">буквально на днях был произведен завоз
                                нескольних животных, пожалуйтса
                                не остовайтесь в стороне и помогите им</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="slider__item">
            <div class="slider__item_wrapper">
                <img class="slider__item-img" src="img/slider_img3.jpg">
                <div class="container">
                    <div class="slider__content">
                        <div class="slider__text">
                            <h2 class="slider__text-title">наша организация получила ресурсы</h2>
                            <div class="slider__text-subtitle">вчера был совершен перевод крупной суммы денег на наш
                                счет, мы не знаем кто это, но очень ему благодарны</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="slider__item">
            <div class="slider__item_wrapper">
                <img class="slider__item-img" src="img/slider_img2.jpg">
                <div class="container">
                    <div class="slider__content">
                        <div class="slider__text">
                            <h2 class="slider__text-title">Мы работаем в кризис</h2>
                            <div class="slider__text-subtitle">мы работаем несмотря ни на что, мы некомерческая
                                огранизация и нам плевать на кризис, мы сделаем все ради благополучия животных</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<main>
    <section class="mCatalog">
        <div class="container">
            <h1 class="section__title hombo">недавно поступившие</h1>
            <div class="animal__card-list">
                <?php
                
                while ($row = mysqli_fetch_assoc($query)) {?>
                    <a class="animal__card-item animal__card-new" href="animal.php?id=<?=$row['id']?>">
                        <div class="animal__card-img">
                            <img src='img/<?=$row["img"]?>'>
                        </div>
                        <div class="animal__card__content">
                            <div class="animal__card__name"><?=$row["name"]?></div>
                            <div>пол: <span class="animal__card__sex"><?=$row["sex"]?></span></div>
                        </div>
                    </a>
                <?}?>
            </div>
        </div>
    </section>
    <section class="our_happiness">
        <div class="container">
            <div class="our_happiness__inner">
                <img class="our_happiness__img" src="img/happiness-bg.jpg">
                <div class="our_happiness__content">
                    <h3 class="our_happiness__title">наши счасливчики</h3>
                    <p class="our_happiness__text">вы можете посмотреть на тех кого уже передали в добрые руки, мы
                        очень
                        гордимся людьми которые помогают животным обритать новый дом и находить новое счастье, пусть
                        на этой странице будет как можно больше животных
                    </p>
                    <a class="our_happiness__link" href="happiness.php">наши счасливчики</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>