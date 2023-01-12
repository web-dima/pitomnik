<?php require "utils/header.php"?>

<main>
    <section class="auth">
        <div class="auth__container">
            <div class="auth__inner">
                <div class="auth__title">зарегистрируйтесь</div>
                <hr>
                <form action="" class="auth__form">
                    <div class="auth__field-elem">
                        <label for="register-email" class="auth__label">ваш email</label>
                        <input class="auth__input form__input" type="email" name="register-email"
                            placeholder="введите ваш email">
                    </div>
                    <div class="auth__field-elem">
                        <label for="register-name" class="auth__label">ваше имя</label>
                        <input class="auth__input form__input" type="text" name="register-name"
                            placeholder="введите ваше имя">
                    </div>
                    <div class="auth__field-elem">
                        <label for="register-pass" class="auth__label">ваш пароль</label>
                        <input class="auth__input form__input" type="password" name="register-pass"
                            placeholder="введите ваш пароль">
                    </div>
                    <div class="auth__tip">
                        есть аккаунт? <a href="login.php">авторизируйтесь</a>
                    </div>
                    <button class="auth__btn btn" id="register-btn">войти</button>
                </form>
                
            </div><span class="message error"></span>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>