<?php

$post = $_SESSION['detail_post'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Create Post Photolnv</title>
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
    <?php
    include_once "header.php";
    ?>

    <div class="container">
        <form action="/create_post" method="post" enctype="multipart/form-data">
            <label class="mt-5 form-label">Введите название поста</label>
            <div class="input-group mb-3">
                <input name="title" type="text" class="form-control" placeholder="Красивое полотно">
            </div>

            <label class="mt-5 form-label">Введите описание поста</label>
            <div class="input-group">
                <textarea name="description" class="form-control" placeholder="Очень крутое и красивое полотно!"></textarea>
            </div>

            <label class="mt-5 form-label">Укажите изображение поста</label>
            <div class="mb-3">
                <input class="form-control" type="file" name="file">
            </div>

            <div class="text-center">
                <button id="#createPost" class="btn btn-primary w-75 mt-5">Создать пост</button>
            </div>
        </form>
    </div>

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
</body>
</html>
