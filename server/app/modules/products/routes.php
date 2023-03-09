<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


return function (App $app) {
    $container = $app->getContainer();

    $app->get('/api/v1/products', function (RequestInterface $request, ResponseInterface $response, $args) use ($container) {

        try {
            $sql = "
                SELECT * from products limit 10;
";
            $stmt = $container->get('connection')->query($sql);
            $items = $stmt->fetchAll(PDO::FETCH_OBJ);
            $response->getBody()->write(json_encode($items));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus(200);
        } catch (PDOException $e) {
            $error = array(
                "message" => $e->getMessage()
            );

            $response->getBody()->write(json_encode($error));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus(500);
        }
    });
};
