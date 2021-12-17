<?php

$post = $_SESSION['detail_post'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detail Photolnv</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/style/style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <header id="header" class="header">
        <div class="header__container _container">
            <a href="/" class="header__logo"> Photelnv </a>
            <nav class="header__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="/" class="menu__link"> Main </a>
                    </li>
                    <li class="menu__item">
                        <a href="#popup" class="menu__link popup-link"> Sign in </a>
                    </li>
                    <li class="menu__item">
                        <a href="#popup_2" class="menu__link popup-link"> Sign up </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="page detail-page">
        <div class="container">
            <div class="row">
                <div class="col-6 text-center card">
                    <img src="<?php echo '../' . $post['image_url'] ?>" class="img-thumbnail">
                </div>
                <div class="col-6 text-start d-block">
                    <div class="card__title">
                        <?= $post['title'] ?>
                    </div>
                    <div class="card__score mt-2">
                        <div class="col-3">
                            <div class="row card__score-author">
                                <div><?= $post['account_name'] ?></div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <span style="font-weight: bold;"><?= $post['total_count_score'] ?></span>
                                <span style="font-weight: bold;"> ♡</span>
                            </div>
                        </div>
                    </div>
                    <div class="card__rating mt-2">
                        <div class="col p-0">
                            <span>Рейтинг:</span>
                            <span><?= $post['avg_score'] ?></span>
                        </div>
                    </div>
                    <div class="card__description mt-2">
                        <?= $post['description'] ?>
                    </div>
                </div>
            </div>
    </main>

    <footer class="footer">
        <div class="footer__container _container">
            <div class="footer__row">
                <div class="footer__column">
                    <div class="item-footer">
                        <div class="item-footer__text text">Contacts:</div>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="item-footer">
                        <div class="item-footer__text text">administrator</div>
                        <a
                                href="https://www.instagram.com/_linbv_/"
                                class="item-footer__link text"
                        >
                            _linbv_
                        </a>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="item-footer">
                        <div class="item-footer__text text">developer</div>
                        <a href="https://vk.com/starbv" class="item-footer__link text">
                            vk.com/starbv
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<div id="popup" class="popup">
    <form id="form1">
        <div class="popup__body">
            <div class="popup__content">
                <div class="content__container">
                    <div class="content__title">Sign In With</div>
                    <div class="content__button content__container">
                        <div class="button__container button-content">
                            <div class="button-content_container">
                                <div class="button-content__icon">
                                    <img class="icon" src="../public/assets/tg.png" alt="Error"/>
                                </div>
                                <div class="button-content__text">Telegram</div>
                            </div>
                            <div class="button-content_container content__container">
                                <div class="button-content__icon">
                                    <img class="icon" src="../public/assets/insta.png" alt="Error"/>
                                </div>
                                <div class="button-content__text">Instagram</div>
                            </div>
                        </div>
                        <div class="content__input-form">
                            <div class="input-form content__container">
                                <div class="input-form__text">Username</div>
                                <input
                                        id="username"
                                        name="username"
                                        class="form__input _reqSign _username"
                                        type="text"
                                        placeholder=" "
                                />
                                <div class="errors"></div>
                            </div>
                            <div class="input-form content__container">
                                <div class="input-form__text">Password</div>
                                <input
                                        id="password"
                                        name="password"
                                        class="form__input _reqSign _password"
                                        type="password"
                                        placeholder=" "
                                />
                                <div class="errors"></div>
                            </div>
                        </div>
                        <div class="content__button content__container">
                            <div class="input-form button">
                                <font style="vertical-align: inherit">
                                    <font style="vertical-align: inherit">
                                        <input type="submit" value="Sign in"
                                    </font>
                                </font>
                            </div>
                        </div>

                        <div class="content__link content__container">
                            <a href="#popup_2" class="link popup-link">
                                <font style="vertical-align: inherit">
                                    <font style="vertical-align: inherit">
                                        Creat an account
                                    </font>
                                </font>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="popup_2" class="popup">
    <form id="form2">
        <div class="popup__body">
            <div class="popup__content popup_registration">
                <div class="content__container">
                    <div class="content__title">User registration</div>
                    <div class="content__button content__container">
                        <div class="button__container button-content">
                            <div class="button-content_container">
                                <div class="button-content__icon">
                                    <img class="icon" src="../public/assets/tg.png" alt="Error"/>
                                </div>
                                <div class="button-content__text">Telegram</div>
                            </div>
                            <div class="button-content_container content__container">
                                <div class="button-content__icon">
                                    <img class="icon" src="../public/assets/insta.png" alt="Error"/>
                                </div>
                                <div class="button-content__text">Instagram</div>
                            </div>
                        </div>
                        <div class="content__input-form">
                            <div class="input-form content__container">
                                <div class="input-form__text">Username</div>
                                <input
                                        id="username"
                                        name="username"
                                        class="form__input _reqReg _username"
                                        type="text"
                                        placeholder=" "
                                />
                                <div class="errors"></div>
                            </div>
                            <div class="input-form content__container">
                                <div class="input-form__text">E-mail</div>
                                <input
                                        id="email"
                                        name="email"
                                        class="form__input _reqReg _email"
                                        type="text"
                                        placeholder=" "
                                />
                                <div class="errors"></div>
                            </div>
                            <div class="input-form content__container">
                                <div class="input-form__text">Telephone</div>
                                <input
                                        id="phone"
                                        name="phone"
                                        class="form__input _reqReg _phone"
                                        type="text"
                                        placeholder=" "
                                />
                                <div class="errors"></div>
                            </div>
                            <div class="input-form content__container">
                                <div class="input-form__text">Password</div>
                                <input
                                        id="password"
                                        name="password"
                                        class="form__input _reqReg _password"
                                        type="password"
                                        placeholder=" "
                                />
                                <div class="errors"></div>
                            </div>
                            <div class="input-form content__container">
                                <div class="input-form__text">Repeat password</div>
                                <input
                                        id="rapeatPassword"
                                        name="reqPassword"
                                        class="form__input _reqReg _repPas"
                                        type="password"
                                        placeholder=" "
                                />
                                <div class="errors"></div>
                            </div>
                        </div>
                        <div class="checkbox__container">
                            <input
                                    type="checkbox"
                                    name="checkbox"
                                    class="form-check _reqReg"
                                    value="1"
                            />
                            <p id="checkbox" class="checkbox">I agree to accept</p>
                        </div>

                        <div class="content__button content__container">
                            <div class="input-form button">
                                <font style="vertical-align: inherit">
                                    <font style="vertical-align: inherit">
                                        <input type="submit" value="Sign up"
                                    </font>
                                </font>
                            </div>
                        </div>

                        <div class="content__link content__container">
                            <a href="#popup" class="link popup-link">
                                <font style="vertical-align: inherit">
                                    <font style="vertical-align: inherit"> Sign in </font>
                                </font>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="../public/script/popups.js"></script>
<script src="../public/script/reg.js"></script>
<script src="../public/script/sign.js"></script>
</body>
</html>
