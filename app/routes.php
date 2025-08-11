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

    // get
    $app->get('/users', function (Request $request, Response $response) {
        $data = ['users' => ['Adrian', 'Maria', 'Pedro']];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    // ruta con parametros
    $app->get('/users/{id}', function (Request $request, Response $response, $args) {
        $userId = $args['id'];
        $data = ['user' => "Usuario ID: $userId"];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });

    // post 
    $app->post('/users', function (Request $request, Response $response) {
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);
        
        // procesar la creacion
        $newUser = [
            'id' => rand(1, 1000),
            'name' => $data['name'],
            'email' => $data['email']
        ];
        
        $response->getBody()->write(json_encode($newUser));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // Created
    });

    // put
    $app->put('/users/{id}', function (Request $request, Response $response, $args) {
        $userId = $args['id'];
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);
        
        // actualizacion
        $updatedUser = [
            'id' => $userId,
            'name' => $data['name'],
            'email' => $data['email'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $response->getBody()->write(json_encode($updatedUser));
        return $response->withHeader('Content-Type', 'application/json');
    });

    // delete
    $app->delete('/users/{id}', function (Request $request, Response $response, $args) {
        $userId = $args['id'];
        
        // logica
        $result = [
            'message' => "Usuario $userId eliminado correctamente",
            'deleted_at' => date('Y-m-d H:i:s')
        ];
        
        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });
};
