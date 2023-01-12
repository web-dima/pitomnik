<?php
session_start();

if (isset($_SESSION["user"])) {
    require_once "config/conn.php";
    error_reporting(0);
    $id = $_SESSION["user"];
    $query = mysqli_query($conn, "SELECT `role` FROM users WHERE id = $id");
    $result = mysqli_fetch_assoc($query);
    
}

?>
<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <a class="footer__logo" href="index.php">
                <img src="img/logo.png" alt="хомбо">
            </a>
            <div class="footer__socials">
                <div class="socials__title">мы в соцсетях</div>
                <ul class="socilas__list">
                    <li><a href="https://vk.com"><img src="img/vk.svg" alt=""></a></li>
                    <li><a href="https://instagram.com"><img src="img/instagram.svg" alt=""></a></li>
                </ul>
            </div>
            <ul class="footer__nav">
                <li class="footer__nav-item"><a href="animals.php">животные</a></li>
                <li class="footer__nav-item"><a href="nursery.php">питомники</a></li>
                <?php
                        if (isset($_SESSION["user"]) && $result["role"] === "user") {
                            echo "<li class='header__nav-item'><a href='orders.php'>заявки</a></li>";
                            echo "<li class='header__nav-item'><a href='actions/logout.php'>выйти</a></li>";
                        }
                        else if (isset($_SESSION["user"]) && $result["role"] === "admin") {
                            
                            echo "<li class='header__nav-item kostyl2'><a href='admin-orders.php'>заявки</a></li>";
                            echo "<li class='header__nav-item kostyl2'><a href='admin-animal.php'>добавить животное</a></li>";
                            echo "<li class='header__nav-item kostyl2'><a href='actions/logout.php'>выйти</a></li>";
                        }
                        else {
                            echo "<li class='header__nav-item'><a href='login.php'>войти</a></li>";
                        }
                    ?>
            </ul>
        </div>
        <div class="footer__copyright">
            made by hombo
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="js/slick.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/index.js"></script>
</body>

</html>