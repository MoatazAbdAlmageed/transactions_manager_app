<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


return function (App $app) {
    $container = $app->getContainer();
    $app->get('/api/v1/users', function (RequestInterface $request, ResponseInterface $response, $args) use ($container) {

        try {
            $sql = "SELECT  users.id  , users.name ,users.email ,users.phone , count(transactions.amount) transactions FROM `users` left JOIN transactions on transactions.user_id = users.id GROUP BY users.id ;
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
