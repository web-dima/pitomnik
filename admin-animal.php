<?php require "utils/header.php"?>
<?php
                
    require_once "config/conn.php";

    $query = mysqli_query($conn, "SELECT id,name FROM `nursery`");

    if (mysqli_num_rows($query) <= 0) {
        exit("<h1>пока нет зарегистрированных питомников</h1>");
    }

?>
<main>
    <section class="auth">
        <div class="auth__container">
            <div class="auth__inner">
                <div class="auth__title">добавить животное</div>
                <hr>
                <form class="auth__form add__animal__form" action="actions/add-animal.php" method="POST" enctype='multipart/form-data'>
                    <div class="auth__field-elem">
                        <label for="animal-type" class="auth__label">тип:</label>
                        <select class="form__select" name="animal-type">
                            <option class="kostyl" value="" selected disabled>выберите тип</option>
                            <option value="собака">собака</option>
                            <option value="кошка">кошка</option>
                        </select>
                    </div>
                    <div class="auth__field-elem">
                        <label for="animal-name" class="auth__label">кличка:</label>
                        <input class="auth__input form__input" type="text" name="animal-name"
                            placeholder="введите кличку">
                    </div>
                    <div class="auth__field-elem">
                        <label for="animal-sex" class="auth__label">пол:</label>
                        <select class="form__select" name="animal-sex">
                            <option class="kostyl" value="" selected disabled>выберите пол</option>
                            <option value="мужской">мужской</option>
                            <option value="женский">женский</option>
                        </select>
                    </div>
                    <div class="auth__field-elem">
                        <label for="animal-age" class="auth__label">возраст:</label>
                        <input class="auth__input form__input" type="number" name="animal-age"
                            placeholder="введите возраст">
                    </div>
                    <div class="auth__field-elem">
                        <label for="animal-breed" class="auth__label">порода:</label>
                        <input class="auth__input form__input" type="text" name="animal-breed"
                            placeholder="введите породу">
                    </div>
                    <div class="auth__field-elem">
                        <label for="animal-nursery" class="auth__label">приют:</label>
                        <select class="form__select" name="animal-nursery">
                            <option class="kostyl" value="" selected disabled>выберите приют</option>
                            <?php
                                while ($row = mysqli_fetch_assoc($query)) { ?>
                                <option value='<?=$row['id']?>'><?=$row["name"]?></option>
                            <?  }?>
                        </select>
                    </div>
                    <div class="auth__field-elem">
                        <label for="animal-img" class="auth__label">фото:</label>
                        <input class="auth__input form__input" type="file" name="animal-img" accept="image/*">
                    </div>
                    <button class="auth__btn btn" id="add-animal-btn" name="add-animal-btn">добавить</button>
                </form>
            </div>
            </div><span class="message"></span>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>