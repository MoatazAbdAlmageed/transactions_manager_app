<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;

return function (App $app) {
    $container = $app->getContainer();
    $app->get('/api/v1/transactions', function (RequestInterface $request, ResponseInterface $response, $args) use ($container) {

        try {
            $sql = "
                SELECT transactions.id , transactions.amount amount, users.name user ,products.name product
                FROM transactions
                INNER JOIN users ON transactions.user_id = users.id
                INNER JOIN products ON transactions.product_id = products.id limit 10 ;
";
            $stmt = $container->get('connection')->query($sql);
            $transactions = $stmt->fetchAll(PDO::FETCH_OBJ);
            $response->getBody()->write(json_encode($transactions));
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
