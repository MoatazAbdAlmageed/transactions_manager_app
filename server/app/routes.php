<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $users = require __DIR__ . '/../app/modules/users/routes.php';
    $products = require __DIR__ . '/../app/modules/products/routes.php';
    $transactions = require __DIR__ . '/../app/modules/transactions/routes.php';
    $system = require __DIR__ . '/../app/modules/system/routes.php';
    $users($app);
    $products($app);
    $transactions($app);
    $system($app);
};
