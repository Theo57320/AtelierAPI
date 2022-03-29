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
use reu\app\app\models\Inviter;

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


        $user = User::Where('mail', 'like', filter_var($user_data['mail'], FILTER_SANITIZE_EMAIL))->get();
        if (!empty($user[0]['id'])) {
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
            $c->dateConnexion = date("Y-m-d");

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
        $resp = $resp->$resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8')->withStatus(200);
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
    function PostEvent(Request $rq, Response $rs, array $event_data): Response
    {
        $event_data = $rq->getParsedBody();

        if (!isset($event_data['lat'])) {
            return Writer::json_error($rs, 400, "missing data : lat");
        }
        if (!isset($event_data['long'])) {
            return Writer::json_error($rs, 400, "missing data : long");
        }
        if (!isset($event_data['libelle_event'])) {
            return Writer::json_error($rs, 400, "missing data : libelle_event");
        }
        if (!isset($event_data['libelle_lieu'])) {
            return Writer::json_error($rs, 400, "missing data : libelle_lieu");
        }
        if (!isset($event_data['horaire'])) {
            return Writer::json_error($rs, 400, "missing data : horaire");
        }
        if (!isset($event_data['date'])) {
            return Writer::json_error($rs, 400, "missing data : date");
        }
        //VALIDATOR
        if (v::floatVal()->validate($event_data['lat']) != true) {
            return Writer::json_error($rs, 400, "incorrect value for: lat");
        }
        if (v::floatVal()->validate($event_data['long']) != true) {
            return Writer::json_error($rs, 400, "incorrect value for: long");
        }
        if (v::stringType()->validate($event_data['libelle_event']) != true) {
            return Writer::json_error($rs, 400, "incorrect value for: libelle_event");
        }
        if (v::stringType()->validate($event_data['libelle_lieu']) != true) {
            return Writer::json_error($rs, 400, "incorrect value for: libelle_lieu");
        }
        if (v::date('Y-m-d')->validate($event_data['date']) != true) {
            return Writer::json_error($rs, 400, "incorrect value or format for: date");
        }
        if (v::stringType()->validate($event_data['horaire']) != true) {
            return Writer::json_error($rs, 400, "incorrect value or format for: horaire");
        }
        $token = $rq->getQueryParam('token', null);
        $createur_id = User::where('token', '=', $token)
            ->get('id');

        try {
            $rs = $rs->withStatus(201)->withHeader('Content-Type', 'application/json;charset=utf-8');
            $r = new Rdv();
            $id = Str::uuid()->toString();
            $r->id = $id;
            $r->lat = $event_data['lat'];
            $r->long = $event_data['long'];
            $r->libelle_event = $event_data['libelle_event'];
            $r->libelle_lieu = $event_data['libelle_lieu'];
            $r->horaire = $event_data['horaire'];
            $r->date = $event_data['date'];
            $r->createur_id = $createur_id[0]['id'];
            $r->save();

            $i = new Inviter();
            $i->id_rdv = $id;
            $i->id_user = $createur_id[0]['id'];
            $i->save();

            $p = new Participer();
            $p->id_rdv = $id;
            $p->id_user = $createur_id[0]['id'];
            $p->statut = 'oui';
            $p->save();

            $c = new Commenter();
            $c->id_rdv = $id;
            $c->id_user = $createur_id[0]['id'];
            $c->message = 'Je viens';
            $c->save();

            $rs->getBody()->write(json_encode($r)); //erreur DEMANDER AU PROF
            return $rs;
        } catch (\Exception $e) {
            $rs = $rs->withStatus(500)->withHeader('Content-Type', 'application/json;charset=utf-8');
            $rs->getBody()->write($e->getMessage());
            return $rs;
        }
    }

    public function MyEvents(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);

        $user = User::where('token', '=', $token)
            ->get();
        $events = Rdv::where("createur_id", "like", $user[0]['id'])->get()->sortBy('date');
        if (isset($events)) {
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode([
                "type" => "collection",
                "count" => count($events),
                "events" => $events,
            ]));
            return $resp;
        } else {
            return Writer::json_error($resp, 404, "you have not yet created an event'");
            // return Writer::json_error($resp, 404, $user);
        }
    }


    public function myEventbyId(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $event = Rdv::Where('id', '=', $id)->get();
        $userToken = User::Where('token', '=', $token)->get('id');
        if ($event[0]['createur_id'] == $userToken[0]['id']) {
            $res["type"] = "event";
            $res["infos"] = $event;
            $tableParticiper = Participer::Get()
                ->where('id_rdv', '=', $id)->where('statut', 'like', 'oui');
            $i = 0;
            foreach ($tableParticiper as $value) {
                $user = User::Where('id', 'like', $value["id_user"])->get(['nom', 'prenom']);
                $res["users"][$i] = $user[0];
                $i++;
            }
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode($res));
            return $resp;
        } else {
            return Writer::json_error($resp, 404, "you are not the creator of this event'");
        }
    }
    public function NeparticipePas(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $event = Rdv::Where('id', '=', $id)->get();
        $userToken = User::Where('token', '=', $token)->get('id');
        if ($event[0]['createur_id'] == $userToken[0]['id']) {
            $res["type"] = "users";
            $tableParticiper = Participer::Get()
                ->where('id_rdv', '=', $id)->where('statut', 'like', 'non');
            $i = 0;
            foreach ($tableParticiper as $value) {
                $user = User::Where('id', 'like', $value["id_user"])->get(['nom', 'prenom']);
                $res["users"][$i] = $user[0];
                $i++;
            }
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode($res));
            return $resp;
        } else {
            return Writer::json_error($resp, 404, "you are not the creator of this event'");
        }
    }

    public function AllmyEvents(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);

        $user = User::Get()
            ->where('token', '=', $token);
        $res["type"] = "event";
        $tableParticiper = Participer::Get()
            ->where('id_user', '=', $user[0]['id']);
        $i = 0;
        foreach ($tableParticiper as $value) {
            $rdv = RDV::Where('id', 'like', $value["id_rdv"])->get(['lat', 'long', 'libelle_event', 'libelle_lieu', 'horaire', 'date', 'createur_id']);
            $res["events"][$i] = $rdv[0];
            $tableParticipants = Participer::Get()
                ->where('id_rdv', '=', $value["id_rdv"])->where('statut', 'like', 'oui');
            $a = 0;
            foreach ($tableParticipants as $p) {
                $participant = User::Where('id', 'like', $p["id_user"])->get(['nom', 'prenom']);
                $part[$a] = $participant[0];
                $a++;
            };
            $i++;
        }
        $res["events"][$i]['participants'] = $part;
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($res));
        return $resp;
    }

    public function Venir(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $user = User::where('token', '=', $token)
            ->get();
        $event = Rdv::where("id", "like", $id)->get();
        if (isset($event[0])) {

            $p = Participer::where("id_rdv", "like", $id)
                ->where("id_user", 'like', $user[0]['id'])
                ->get();
            if (isset($p[0])) {
                if ($p[0]['statut'] == 'oui') {
                    return Writer::json_error($resp, 401, "you already participe to this event'");
                } else {
                    Participer::where("id_rdv", "like", $id)
                        ->where("id_user", 'like', $user[0]['id'])
                        ->update(['statut' => 'oui']);
                    $c = new Commenter();
                    $c->id_rdv = $id;
                    $c->id_user = $user[0]['id'];
                    $c->message = 'Je viens';
                    $c->save();
                }
            } else {
                $p = new Participer();
                $p->id_rdv = $id;
                $p->id_user = $user[0]['id'];
                $p->statut = 'oui';
                $p->save();
                $c = new Commenter();
                $c->id_rdv = $id;
                $c->id_user = $user[0]['id'];
                $c->message = 'Je viens';
                $c->save();
            }
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode([
                "type" => "collection",
                "oui" => 'Vous participez',
                "events" => $event,
            ]));
            return $resp;
        } else {
            return Writer::json_error($resp, 404, "This event does not exist");
        }
    }
    public function PasVenir(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $user = User::where('token', '=', $token)
            ->get();
        $event = Rdv::where("id", "like", $id)->get();
        if (isset($event[0])) {

            $p = Participer::where("id_rdv", "like", $id)
                ->where("id_user", 'like', $user[0]['id'])
                ->get();
            if (isset($p[0])) {
                if ($p[0]['statut'] == 'non') {
                    return Writer::json_error($resp, 401, "you already not participe to this event'");
                } else {
                    Participer::where("id_rdv", "like", $id)
                        ->where("id_user", 'like', $user[0]['id'])
                        ->update(['statut' => 'non']);
                    $c = new Commenter();
                    $c->id_rdv = $id;
                    $c->id_user = $user[0]['id'];
                    $c->message = 'Je ne viens pas';
                    $c->save();
                }
            } else {
                $p = new Participer();
                $p->id_rdv = $id;
                $p->id_user = $user[0]['id'];
                $p->statut = 'non';
                $p->save();
                $c = new Commenter();
                $c->id_rdv = $id;
                $c->id_user = $user[0]['id'];
                $c->message = 'Je ne viens pas';
                $c->save();
            }
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode([
                "type" => "collection",
                "non" => 'Vous ne participez pas',
                "events" => $event,
            ]));
            return $resp;
        } else {
            return Writer::json_error($resp, 404, "This event does not exist");
        }
    }
    public function addComment(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $comment = $req->getQueryParam('comment', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $user = User::where('token', '=', $token)
            ->get();
        $event = Rdv::where("id", "like", $id)->get();
        if (isset($event[0])) {
            if (v::stringType()->validate($comment) != true) {
                return Writer::json_error($resp, 400, "incorrect format for: comment");
            }
            $c = new Commenter();
            $c->id_rdv = $id;
            $c->id_user = $user[0]['id'];
            $c->message = $comment;
            $c->save();

            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode($c));
            return $resp;
        } else {
            return Writer::json_error($resp, 404, "This event does not exist");
        }
    }

    public function listComment(Request $req, Response $resp, array $args): Response
    {
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $event = Rdv::where("id", "like", $id)->get();
        if (isset($event[0])) {
            $comments = Commenter::where("id_rdv", 'like', $id)->get(['message', 'id_user', 'created_at'])->sortBy('created_at');
            $i = 0;
            foreach ($comments as $comment) {
                $res[$i]['message'] = $comment['message'];
                $user = User::where("id", '=', $comment['id_user'])->get(['nom', 'prenom']);
                $res[$i]['user'] = $user[0];
                $i++;
            }
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode($res));
            return $resp;
        } else {
            return Writer::json_error($resp, 404, "This event does not exist");
        }
    }
    public function getStats(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $user = User::Where('token', '=', $token)->get('id');
        $participer = Participer::Where('id_rdv', '=', $id)->get();
        if ($participer[0] !== null) {
            $res = $participer[0]['statut'];
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode($res));
            return $resp;
        } else {
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode("rien"));
            return $resp;
        }
    }
    public function getStatut(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $user = User::Where('token', '=', $token)->get('id');
        $participer = Participer::Where('id_rdv', '=', $id)->get();
        if ($participer[0] !== null) {
            $res = $participer[0]['statut'];
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode($res));
            return $resp;
        } else {
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode("rien"));
            return $resp;
        }
    }
    public function getRole(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $user = User::Where('token', '=', $token)->get('id');
        $event = Rdv::Where('id', '=', $id)->get();
        if ($event[0] !== null) {
            if ($event[0]['createur_id'] == $user[0]['id']) {
                $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
                $resp->getBody()->write(json_encode(["role" => "proprietaire"]));
                return $resp;
            } else {
                $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
                $resp->getBody()->write(json_encode(["role" => "invite"]));
                return $resp;
            }
        } else {
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode(["role" => "invite"]));
            return $resp;
        }
    }
    public function getUsersInvite(Request $req, Response $resp, array $args): Response
    {
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $inviters = Inviter::where("id_rdv", "like", $id)->get();
        $res["type"] = "user";
        $i = 0;
        foreach ($inviters as $inv) {
            $inviters = User::where("id", "like", $inv['id_user'])->get();
            $res["users"][$i] = $inviters[0];
            $i++;
        }
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($res));
        return $resp;
    }
    public function getUsersInviteNonRefuse(Request $req, Response $resp, array $args): Response
    {
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $inviters = Inviter::where("id_rdv", "like", $id)->get('id_user');
        $inviters = json_decode(json_encode($inviters));
        $i = 0;
        foreach ($inviters as $inv) {
            foreach ($inv as $val) {
                $tableIDInviter[$i] = json_decode(json_encode($val));
            }
            $i++;
        }
        if (empty($tableIDInviter)) {
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode("rien"));
            return $resp;
        }
        $pasParticiper = Participer::Where('id_rdv', '=', $id)
            ->where('statut', 'like', 'non')
            ->get('id_user');
        $pasParticiper = json_decode(json_encode($pasParticiper));
        $c = 0;

        foreach ($pasParticiper as $value) {
            foreach ($value as $id) {
                $table[$c] = json_decode(json_encode($id));
            }
            $c++;
        }
        if (empty($pasParticiper)) {
            $n = 0;
            foreach ($tableIDInviter as $b) {
                $usr = User::Where('id', '=', $b)->get(['nom', 'prenom', 'id', 'mail']);
                $result["users"][$n] = $usr[0];
                $n++;
            }
            $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
            $resp->getBody()->write(json_encode($result));
            return $resp;
        }

        $TableIDnonAccepte = array_diff($tableIDInviter, $table);
        $n = 0;
        foreach ($TableIDnonAccepte as $b) {
            $usr = User::Where('id', '=', $b)->get(['nom', 'prenom', 'id', 'mail']);
            $result["users"][$n] = $usr[0];
            $n++;
        }
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($result));
        return $resp;
    }
    public function getUsersNonInvite(Request $req, Response $resp, array $args): Response
    {
        $id = $args['id'];
        if (v::stringType()->validate($id) != true) {
            return Writer::json_error($resp, 400, "incorrect format for: id");
        }
        $allUsers = User::get('id');
        $allUsers = json_decode($allUsers);
        $inviters = Inviter::where("id_rdv", "like", $id)->get('id_user');
        $inviters = json_decode(json_encode($inviters));
        $i = 0;
        foreach ($inviters as $inv) {
            foreach ($inv as $val) {
                $tableIDInviter[$i] = json_decode(json_encode($val));
            }
            $i++;
        }
        $a = 0;
        foreach ($allUsers as $user) {
            foreach ($user as $val) {
                $tableIDUsers[$a] = json_decode(json_encode($val));
            }
            $a++;
        }
        $TableIDnonInvite = array_diff($tableIDUsers, $tableIDInviter);
        $n = 0;
        foreach ($TableIDnonInvite as $b) {
            $usr = User::Where('id', '=', $b)->get(['nom', 'prenom', 'id', 'mail']);
            $result["users"][$n] = $usr[0];
            $n++;
        }

        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($result));
        return $resp;
    }
    public function invitation(Request $req, Response $resp, array $args): Response
    {
        $id = $args['id'];
        $id_user = $req->getQueryParam('id_user', null);

        if ($id_user == null) {
            return Writer::json_error($resp, 400, "id_user invalid or not here");
        }
        $p = new Inviter();
        $p->id_rdv = $id;
        $p->id_user = $id_user;
        $p->save();


        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode([
            "type" => "Response",
            "message" => "User invite",
        ]));
        return $resp;
    }
    public function InvitEvents(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $user = User::where('token', '=', $token)->get();
        $res["type"] = "event";
        $tableInviter = Inviter::where('id_user', '=', $user[0]['id'])->get();
        $i = 0;
        foreach ($tableInviter as $value) {
            $rdv = RDV::Where('id', 'like', $value["id_rdv"])->get(['id', 'lat', 'long', 'libelle_event', 'libelle_lieu', 'horaire', 'date', 'createur_id']);
            $res["events"][$i] = $rdv[0];
            $i++;
        }
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($res));
        return $resp;
    }
    public function getUser(Request $req, Response $resp, array $args): Response
    {
        $id = $req->getQueryParam('id', null);
        $user = User::where('id', '=', $id)->first();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($user));
        return $resp;
    }
    public function suppUser(Request $req, Response $resp, array $args): Response
    {
        $token = $req->getQueryParam('token', null);
        $user = User::where('token', '=', $token)
            ->delete();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($user));
        return $resp;
    }
}
