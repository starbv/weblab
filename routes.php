<?php

use Controller\AjaxController;
use Controller\HomeController;
use Controller\PostController;
use Service\RouterService;

include "src/Service/RouterService.php";

RouterService::registerRoute('', HomeController::class, 'home', 'GET');
RouterService::registerRoute('/logout', HomeController::class, 'logout', 'GET');
RouterService::registerRoute('/post/<id>', PostController::class, 'detailPost', 'GET');
RouterService::registerRoute('/ajax_load_more', AjaxController::class, 'loadMore', 'POST');
RouterService::registerRoute('/ajax_register', AjaxController::class, 'registerUser', 'POST');
RouterService::registerRoute('/ajax_login', AjaxController::class, 'loginUser', 'POST');

RouterService::enable();
