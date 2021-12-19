<?php

use Repository\UserRepository;

include_once "src/Repository/UserRepository.php";

$userId = $_SESSION['user_id'];
if (isset($userId)) {
    $userRepo = new UserRepository();
    $userName = $userRepo->getUserFirstName($userId);

    if (!isset($userName)) {
        unset($_SESSION['user_id']);
    }
}
?>
<header id="header" class="header">
    <div class="header__container _container">
        <a href="/" class="header__logo"> Photelnv </a>
        <nav class="header__menu menu">
            <ul class="menu__list">
                <?php if (!isset($userName)) :?>
                    <li class="menu__item">
                        <a href="#popup" class="menu__link popup-link"> Sign in </a>
                    </li>
                    <li class="menu__item">
                        <a href="#popup_2" class="menu__link popup-link"> Sign up </a>
                    </li>
                <?php else: ?>
                    <li class="menu__item">
                        <span class="menu__link">Привет, <?=$userName?> !</span>
                        <br>
                        <a href="/logout" class="menu__link"> Log out </a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</header>