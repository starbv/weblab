<?php


namespace Controller;

use Entity\User\UserCreate;
use Entity\User\UserLogin;
use Repository\PostRepository;
use Service\RouterService;

include "src/Entity/User/UserCreate.php";
include "src/Entity/User/UserLogin.php";

class AjaxController
{
    public static function loadMore(): array
    {
        $postId = $_POST['data'];
        if (isset($postId)) {
            if (intval($postId) >= 0) {
                $repo = new PostRepository();
                $posts = $repo->getPreviewPosts($postId);
                $data = [];
                foreach ($posts as $post) {
                    $data[] = $post->toArray();
                }
                $_SESSION['posts'] = $data;
                echo json_encode($data);
                return $data;
            }
        }
        return [];
    }

    public static function registerUser(): array
    {
        if (isset($_SESSION['user_id'])) {
            RouterService::redirectToPage('home');
        }

        $data = $_POST['data'];
        $lastName = htmlspecialchars($data['last_name']);
        $firstName = htmlspecialchars($data['first_name']);
        $patronymic = "";
        if (isset($data['patronymic'])) {
            $patronymic = htmlspecialchars($data['patronymic']);
        }
        $email = htmlspecialchars($data['email']);
        $phone = htmlspecialchars($data['phone']);

        $password = htmlspecialchars($data['password']);
        $confirmPassport = htmlspecialchars($data['confirm_password']);

        if ($password != $confirmPassport) {
            echo json_encode(['msg' => 'Пароли не совпадают!']);
            die();
        }

        $user = new UserCreate([
            'last_name' => $lastName,
            'first_name' => $firstName,
            'patronymic' => $patronymic,
            'email' => $email,
            'phone' => $phone,
            'password' => $password
        ]);

        $userId = $user->create();
        if ($userId == -1) {
            echo json_encode(['msg' => 'Ошибка! Пользователь с данным Email уже существует!']);
            die();
        }
        $_SESSION['user_id'] = $userId;
        echo json_encode([]);

        return [];
    }

    public static function loginUser(): array
    {
        if (isset($_SESSION['user_id'])) {
            RouterService::redirectToPage('home');
        }

        $data = $_POST['data'];
        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);

        $user = new UserLogin(['email' => $email, 'password' => $password]);
        $userId = $user->login();

        if ($userId == -1) {
            echo json_encode(['msg' => 'Ошибка! Неправильный логин или пароль!']);
            die();
        }

        $_SESSION['user_id'] = $userId;
        echo json_encode([]);

        return [];
    }
}
