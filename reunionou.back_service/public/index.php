<?php

/**
 * File:  index.php
 *
 */

require_once  __DIR__ . '/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use reu\back\app\controller\Controller as Controller;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true, // Mettre à false pour déployer l'api en mode production
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


$app->get(
    '/users[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->allUsers($req, $resp, $args);
    }
);

$app->get(
    '/user/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->getUser($req, $resp, $args);
    }
);

$app->get(
    '/userAbsent[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->userAbsent($req, $resp, $args);
    }
);


$app->delete(
    '/userSupp/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->suppUser($req, $resp, $args);
    }
);
    
$app->get(
    '/rdv[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->allRdv($req, $resp, $args);
    }
);


$app->get(
    '/rdv/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->getRdv($req, $resp, $args);
    }
);

$app->get(
    '/rdvPasse[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->rdvPasse($req, $resp, $args);
    }
);


$app->delete(
    '/rdvSupp/{id}[/]',
    function (Request $req, Response $resp, $args): Response {
        $ctrl = new Controller($this);
        return $ctrl->suppRdv($req, $resp, $args);
    }
);





$app->run();