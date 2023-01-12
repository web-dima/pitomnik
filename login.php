<?php require "utils/header.php"?>
<main>
    <section class="auth">
        <div class="auth__container">
            <div class="auth__inner">
                <div class="auth__title">войдите в аккаунт</div>
                <hr>
                <form action="" class="auth__form">
                    <div class="auth__field-elem">
                        <label for="login-email" class="auth__label">ваш email</label>
                        <input class="auth__input form__input" type="email" name="login-email"
                            placeholder="введите ваш email">
                    </div>
                    <div class="auth__field-elem">
                        <label for="login-pass" class="auth__label">ваш пароль</label>
                        <input class="auth__input form__input" type="password" name="login-pass"
                            placeholder="введите ваш пароль">
                    </div>
                    <div class="auth__tip">
                        нет аккаунта? <a href="register.php">зарегистрируйтесь</a>
                    </div>
                    <button class="auth__btn btn" id="login-btn">войти</button>
                </form>
            </div>
            <span class="message error"></span>
        </div>
    </section>
</main>
<?php require "utils/footer.php"?>