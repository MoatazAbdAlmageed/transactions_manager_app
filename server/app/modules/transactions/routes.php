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
                INNER JOIN products ON transactions.product_id = products.id order by transactions.id desc limit 10 ;
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

    $app->post('/api/v1/transactions/add', function (RequestInterface $request, ResponseInterface $response, $args) use ($container) {

        try {
            $sql = "INSERT INTO transactions (`user_id`, `product_id`, `amount`) VALUES (:user_id, :product_id, :amount)";
            $stmt = $container->get('connection')->prepare($sql);
            $data = $request->getParsedBody();
            $user_id = $data["user_id"];
            $product_id = $data["product_id"];
            $amount = $data["amount"];
            if (!$user_id || !$product_id || !$amount) {
                $response->getBody()->write(json_encode('validation error'));
                return $response
                    ->withHeader('content-type', 'application/json')
                    ->withStatus(500);
            }
            $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id, ':amount' => $amount]);
            $response->getBody()->write(json_encode('transaction created successfully'));
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
