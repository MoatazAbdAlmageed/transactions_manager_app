<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


return function (App $app) {
    $container = $app->getContainer();
    $app->get('/api/v1/users', function (RequestInterface $request, ResponseInterface $response, $args) use ($container) {

        try {
            $sql = " SELECT users.id, users.name, users.email, users.phone,
(SELECT COUNT(*) FROM transactions WHERE user_id = users.id) AS transactions
FROM users
ORDER BY transactions DESC
LIMIT 10

 ;
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
    $app->post('/api/v1/users/add', function (RequestInterface $request, ResponseInterface $response, $args) use ($container) {

        try {
            $sql = "INSERT INTO users (`name`, `email`, `phone`) VALUES (:name, :email, :phone)";
            $stmt = $container->get('connection')->prepare($sql);
            $data = $request->getParsedBody();
            $name = $data["name"];
            $email = $data["email"];
            $phone = $data["phone"];
            if (!$name || !$email || !$phone) {
                $response->getBody()->write(json_encode('validation error'));
                return $response
                    ->withHeader('content-type', 'application/json')
                    ->withStatus(500);
            }
            $stmt->execute([':name' => $name, ':email' => $email, ':phone' => $phone]);
            $response->getBody()->write(json_encode('user created successfully'));
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
