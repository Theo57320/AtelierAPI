<?php


namespace reu\app\app\controller;


use Firebase\JWT\JWT as JWT;
use Firebase\JWT\Key as Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Illuminate\Database\Eloquent\Builder;

use reu\app\app\models\User;
use reu\app\app\models\Rdv;
use reu\app\app\models\Participer;
use reu\app\app\models\Commenter;

use  Illuminate\Support\Str;
use Respect\Validation\Validator as v;

use reu\app\app\utils\Writer;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/**
 * Class LBSAuthController
 * @package reu\app\app\controller
 */
class Controller
{
    private $c; //le conteneur de dépendance de l'application

    public function __construct(\Slim\Container $c)
    {
        $this->container = $c;
    }

    public function listUsers(Request $req, Response $resp, array $args): Response
    {
        $users = User::all();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($users));
        return $resp;
    }
    public function listEvents(Request $req, Response $resp, array $args): Response
    {
        $rdv = Rdv::all();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($rdv));
        return $resp;
    }

    function register(Request $rq, Response $rs, array $user_data): Response
    {
        $user_data = $rq->getParsedBody();

        if (!isset($user_data['nom'])) {
            return Writer::json_error($rs, 400, "missing data : nom");
        }
        if (!isset($user_data['prenom'])) {
            return Writer::json_error($rs, 400, "missing data : prenom");
        }
        if (!isset($user_data['mail']) || !filter_var($user_data['mail'], FILTER_SANITIZE_EMAIL)) {
            return Writer::json_error($rs, 400, "missing data : mail");
        }
        if (!isset($user_data['sexe'])) {
            return Writer::json_error($rs, 400, "missing data : sexe");
        }
        if (!isset($user_data['password'])) {
            return Writer::json_error($rs, 400, "missing data : password");
        }
        //VALIDATOR
        if (v::stringType()->validate($user_data['nom']) != true) {
            return Writer::json_error($rs, 400, "incorrect value for: nom");
        }
        if (v::stringType()->validate($user_data['prenom']) != true) {
            return Writer::json_error($rs, 400, "incorrect value for: prenom");
        }
        if (v::stringType()->validate($user_data['password']) != true) {
            return Writer::json_error($rs, 400, "incorrect value for: password");
        }
        if ($user_data['sexe'] !== "M") {
            if ($user_data['sexe'] !== "F") {
                return Writer::json_error($rs, 400, "incorrect value for: sexe ( must be F or M )");
            }
        }
        if (v::email()->validate($user_data['mail']) != true) {
            return Writer::json_error($rs, 400, "incorrect format for: mail");
        }


        $user = User::Get()->where('mail', 'like', filter_var($user_data['mail'], FILTER_SANITIZE_EMAIL));
        if ($user !== null) {
            return Writer::json_error($rs, 400, "mail already exists");
        }



        try {
            $rs = $rs->withStatus(201)->withHeader('Content-Type', 'application/json;charset=utf-8');
            $cost = 10;
            $c = new User();
            $id = Str::uuid()->toString();
            $c->id = $id;
            $c->nom = filter_var($user_data['nom'], FILTER_SANITIZE_STRING);
            $c->prenom = filter_var($user_data['prenom'], FILTER_SANITIZE_STRING);
            $c->mail = filter_var($user_data['mail'], FILTER_SANITIZE_EMAIL);
            $c->sexe = filter_var($user_data['sexe'], FILTER_SANITIZE_STRING);
            $c->password = password_hash(filter_var($user_data['password'], FILTER_SANITIZE_STRING), PASSWORD_BCRYPT, ["cost" => $cost]);
            $c->token = bin2hex(random_bytes(32));

            $c->save();


            $rs->getBody()->write(json_encode($c)); //erreur DEMANDER AU PROF
            return $rs;
        } catch (\Exception $e) {
            $rs = $rs->withStatus(500)->withHeader('Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write($e->getMessage());
            return $rs;
        }
    }

    public function myPage(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $user = User::where('token', '=', $token)
            ->get();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($user));
        return $resp;
    }

    public function Update(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $nom = $req->getQueryParam('nom', null);
        $prenom = $req->getQueryParam('prenom', null);
        $mail = $req->getQueryParam('mail', null);
        $password = $req->getQueryParam('password', null);


        $user = User::where('token', '=', $token)
            ->get();
        if ($nom !== null) {
            if (v::stringType()->validate($nom) != true) {
                return Writer::json_error($resp, 400, "incorrect value for: nom");
            } else {
                User::where('token', '=', $token)
                    ->update(['nom' => $nom]);
            }
        }
        if ($prenom !== null) {
            if (v::stringType()->validate($prenom) != true) {
                return Writer::json_error($resp, 400, "incorrect value for: prenom");
            } else {
                User::where('token', '=', $token)
                    ->update(['prenom' => $prenom]);
            }
        }
        if ($mail !== null) {
            if (v::email()->validate($mail) != true) {
                return Writer::json_error($resp, 400, "incorrect value for: mail");
            } else {
                $test = User::where('mail', '=', $mail)->get();
                if (isset($test[0]['id'])) {
                    return Writer::json_error($resp, 400, "mail already exists");
                }
                User::where('token', '=', $token)
                    ->update(['mail' => $mail]);
            }
        }


        if ($password !== null) {
            if (v::stringType()->validate($password) != true) {
                return Writer::json_error($resp, 400, "incorrect value for: password");
            } else {
                User::where('token', '=', $token)
                    ->update(['password' => password_hash(filter_var($password, FILTER_SANITIZE_STRING), PASSWORD_BCRYPT, ["cost" => 10])]);
            }
        }
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($user));
        return $resp;
    }
    public function lastConnection(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        User::where('token', '=', $token)
            ->update(['dateConnexion' => date('Y-m-d')]);
        $user = User::where('token', '=', $token)
            ->get();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($user));
        return $resp;
    }
}
