<?php

declare(strict_types=1);

use App\Application\Controllers\User\UserController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hola Campers!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', [UserController::class, 'index']);
        $group->get('/{id}', [UserController::class, 'findById']);
        $group->post('', [UserController::class, 'create']);
        $group->put('/{id}', [UserController::class, 'update']);
        $group->delete('/{id}', [UserController::class, 'delete']);
    });

    // GET
    $app->get('/usuarios', function ($request, $response, $args) {
        $usuarios = [/* ... */];
        $response->getBody()->write(json_encode($usuarios));
        return $response->withHeader('Content-Type', 'application/json');
    });

    // POST
    $app->post('/usuarios', function ($request, $response, $args) {
        $data = json_decode($request->getBody()->getContents(), true);
        // procesar $data
        $response->getBody()->write(json_encode(['mensaje' => 'Usuario creado']));
        return $response->withStatus(201)->withHeader('Content-Type', 'application/json');
    });

    // PUT
    $app->put('/usuarios/{id}', function ($request, $response, $args) {
        $id = $args['id'];
        $data = json_decode($request->getBody()->getContents(), true);
        // actualizar usuario
        return $response->withHeader('Content-Type', 'application/json');
    });

    // DELETE
    $app->delete('/usuarios/{id}', function ($request, $response, $args) {
        $id = $args['id'];
        // eliminar usuario
        return $response->withStatus(204);
    });

    $app->run();
};
