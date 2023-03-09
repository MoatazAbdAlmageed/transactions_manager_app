<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


return function (App $app) {
    $container = $app->getContainer();
    $app->get('/api/v1/users', function (RequestInterface $request, ResponseInterface $response, $args) use ($container) {

        try {
            $sql = "
                SELECT * 
                FROM users
           limit 10;
";
            $stmt = $container->get('connection')->query($sql);
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            $response->getBody()->write(json_encode($users));
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
