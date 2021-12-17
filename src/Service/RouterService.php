<?php


namespace Service;

include "src/Controller/HomeController.php";
include "src/Controller/AjaxController.php";
include "src/Controller/PostController.php";


class RouterService
{
    private static array $routeList = [];

    public static function registerRoute(string $route, string $controller, string $method, string $allowMethod): void
    {
        self::$routeList[] = [
            'uri' => $route,
            'controller' => $controller,
            'method' => $method,
            'allow_method' => $allowMethod
        ];
    }

    public static function enable()
    {
        $serverMethod = $_SERVER['REQUEST_METHOD'];
        $query = trim($_GET['q'], '/');
        $params = explode('/', $query);
        foreach (self::$routeList as $route) {
            $uri = explode('/', trim($route['uri'], '/'))[0];
            if ($params[0] === $uri && $serverMethod === $route['allow_method']) {
                $action = new $route['controller'];
                $method = $route['method'];
                if (isset($params[1])) {
                    $action->$method($params[1]);
                    die();
                } else {
                    $action->$method();
                    die();
                }
            }
        }
        RouterService::redirectToPage('not_found');
    }

    public static function redirectToPage(string $page)
    {
        $path = "templates/" . $page . ".php";
        if (file_exists($path)) {
            require_once $path;
            die();
        }
    }
}
