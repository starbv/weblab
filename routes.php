<?php

use Controller\AjaxController;
use Controller\HomeController;
use Controller\PostController;
use Service\RouterService;

include "src/Service/RouterService.php";

RouterService::registerRoute('', HomeController::class, 'home', 'GET');
RouterService::registerRoute('/post/<id>', PostController::class, 'detailPost', 'GET');
RouterService::registerRoute('/ajax_load_more', AjaxController::class, 'loadMore', 'POST');

RouterService::enable();
