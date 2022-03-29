<?php

/**
 * File:  index.php
 *
 */

require_once  __DIR__ . '/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use reu\app\app\controller\Controller as Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use reu\app\app\middlewares\Token as Token;
use reu\app\app\utils\Writer;

use reu\app\app\models\User as User;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true, // Mettre à false pour déployer l'api en mode production
        "determineRouteBeforeAppMiddleware" => true,
    ],
    'dbconf' => function ($c) {
        return parse_ini_file(__DIR__ . '/../src/app/conf/reu.db.conf.ini');
    },
    "phpErrorHandler" => function (\Slim\Container $c) {
        return function ($req, $resp, \Throwable $error) {
            $resp = $resp->withStatus(500)->withHeader('Content-Type', 'application/json');
            $resp->getBody()->write(json_encode(
                [
                    "type" => "error",
                    "error" => "500",
                    "message" => "Erreur serveur : {$error->getMessage()}",
                    "trace" => $error->getTraceAsString(),
                    "file" => $error->getFile() . "ligne: " . $error->getLine(),
                ]
            ));
            return $resp;
        };
    },

    "notAllowedHandler" => function ($c) {
        return function ($req, $resp, $methods) {
            $resp = $resp->withStatus(405)->withHeader('Content-Type', 'application/json');
            $resp->getBody()->write(json_encode(
                [
                    "type" => "error",
                    "error" => "405",
                    "message" => 'Methode autorisee : ' . implode(",", $methods),
                ]
            ));
            return $resp;
        };
    },
    "notFoundHandler" => function (\Slim\Container $c) {
        return function ($req, $resp) {
            $resp = $resp->withStatus(400)->withHeader('Content-Type', 'application/json');
            $resp->getBody()->write(json_encode(
                [
                    "type" => "error",
                    "error" => "400",
                    "message" => "URI mal formee",
                ]
            ));
            return $resp;
        };
    },
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($c->dbconf); /* configuration avec nos paramètres */
$db->setAsGlobal(); /* rendre la connexion visible dans tout le projet */
$db->bootEloquent();

function checkToken(Request $rq, Response $rs, callable $next)
{
   
    // récupérer l'identifiant de cmmde dans la route et le token
    // $id = $rq->getAttribute('route')->getArgument( 'id');
    $token = $rq->getQueryParam('token', null);
    // vérifier que le token correspond à la commande
    try {
        User::where('token', '=', $token)
            // ->where('id', '=', $id)
            ->firstOrFail();
    } catch (ModelNotFoundException $e) {
        return Writer::json_error($rs, 400, "erreur param token inexistant ou invalide");
        return $rs;
    };
    return $next($rq, $rs);
}
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', $req->getHeader('Origin'))
            ->withHeader('Access-Control-Allow-Methods', 'POST, PUT, OPTIONS, GET, DELETE')
            ->withHeader('Access-Control-Allow-Credentials','true')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, X-Custom-Header','XMLHttpRequest');
});
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->get(
    '/users[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->listUsers($req, $resp, $args);
    }
)->add('checkToken');
$app->get(
    '/events[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->listEvents($req, $resp, $args);
    }
)->add('checkToken');
$app->post(
    '/register[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->register($req, $resp, $args);
    }
);
$app->get(
    '/myPage[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->myPage($req, $resp, $args);
    }
)->add('checkToken');

$app->post(
    '/updateUser[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->Update($req, $resp, $args);
    }
)->add('checkToken');

$app->post(
    '/postEvent[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->PostEvent($req, $resp, $args);
    }
)->add('checkToken');
$app->post(
    '/lastConnection[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->lastConnection($req, $resp, $args);
    }
)->add('checkToken');
$app->get(
    '/myEvents[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->myEvents($req, $resp, $args);
    }
)->add('checkToken');
$app->get(
    '/myEvent/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->myEventbyId($req, $resp, $args);
    }
)->add('checkToken');
$app->get(
    '/AllMyEvents[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->AllmyEvents($req, $resp, $args);
    }
)->add('checkToken');
$app->post(
    '/Venir/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->Venir($req, $resp, $args);
    }
)->add('checkToken');
$app->post(
    '/PasVenir/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->PasVenir($req, $resp, $args);
    }
)->add('checkToken');
$app->post(
    '/AddComment/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->addComment($req, $resp, $args);
    }
)->add('checkToken');
$app->get(
    '/ListComments/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->ListComment($req, $resp, $args);
    }
);

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});
$app->run();
