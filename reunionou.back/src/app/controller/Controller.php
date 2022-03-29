<?php


namespace reu\back\app\controller;


use Firebase\JWT\JWT as JWT;
use Firebase\JWT\Key as Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException ;
use Firebase\JWT\BeforeValidException;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use reu\back\app\models\User;
use reu\back\app\models\Rdv;
use reu\back\app\models\Participer;
use reu\back\app\models\Commenter;
use reu\back\app\models\User_admin;

use  Illuminate\Support\Str;
use Respect\Validation\Validator as v;

use reu\back\app\utils\Writer;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/**
 * Class LBSAuthController
 * @package reu\app\app\controller
 */
class Controller
{
    private $c; //le conteneur de dépendance de l'application
    
    public function __construct(\Slim\Container $c){
        $this->container=$c;
    }

    //USER
    public function allUsers(Request $req, Response $resp, array $args): Response
    {
        $commandes = user_admin::all();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($commandes));
        return $resp;
    }


    public function getUser(Request $req, Response $resp, array $args): Response
    {
        $id=$args['id'];
        $user = user_admin::select(['id','nom','prenom','mail','sexe'])
        ->where('id','=',$id)
        ->FirstorFail();

        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($user));
        return $resp;
    }

//UserABSENT    
    public function userAbsent(Request $req, Response $resp, array $args): Response
    {

        function date_outil($date,$nombre_jour) {
 
            $year = substr($date, 0, -6);   
            $month = substr($date, -5, -3);   
            $day = substr($date, -2);   
         
            // récupère la date du jour
            $date_string = mktime(0,0,0,$month,$day,$year);
         
            // Supprime les jours
            $timestamp = $date_string - ($nombre_jour * 86400);
            $nouvelle_date = date("Y-m-d", $timestamp); 
         
            // pour afficher
           return $nouvelle_date;
         
            }

        $Ajd = date("y-m-d");
        $dateDiff= date_outil($Ajd,152);
        
        $commandes = user_admin::select(['id','nom','prenom','mail','sexe','dateConnexion'])
        ->where('dateConnexion','<',$dateDiff)
        ->get();
        // var_dump($commandes);
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($commandes));
        return $resp;
    }


    //RDV
    public function allRdv(Request $req, Response $resp, array $args): Response
    {
        $rdv = Rdv::all();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($rdv));
        return $resp;
    }

    

    public function getRdv(Request $req, Response $resp, array $args): Response
    {
        $id=$args['id'];
        $rdv = Rdv::select(['id','lat','long','libelle_event','libelle_lieu','horraire','date','createur_id'])
        ->where('id','=',$id)
        ->FirstorFail();

        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($rdv));
        return $resp;
    }


    public function rdvPasse(Request $req, Response $resp, array $args): Response
    {
        // SELECT col FROM une_table WHERE col_date <= CURDATE()

        $rdv = Rdv::select(['id','lat','long','libelle_event','libelle_lieu','horraire','date','createur_id'])
        ->where('date','<=', 'CURDATE()')
        ->get();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($rdv));
        return $resp;
    }



    //SUPP
    public function suppUser(Request $req, Response $resp, array $args): Response
    {
        $id=$args['id'];
        $user = user_admin::where('id','=',$id)
        ->delete();  
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($user));
        return $resp;
    }

    public function suppRdv(Request $req, Response $resp, array $args): Response
    {
        $id=$args['id'];
        $rdv = Rdv::where('id','=',$id)
        ->delete();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($rdv));
        return $resp;
    }

    // Back office

    public function authenticate(Request $rq, Response $rs, $args): Response
    {
        
        if (!$rq->hasHeader('Authorization')) {
            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="reu_api api" ');
            return Writer::json_error($rs, 401, 'No Authorization header present');
        };

        $authstring = base64_decode(explode(" ", $rq->getHeader('Authorization')[0])[1]);
        list($mail, $pass) = explode(':', $authstring);

        try {
            $user = user_admin::select('id', 'email', 'password', 'token')
                ->where('email', '=', $mail)
                ->firstOrFail();

            if (!password_verify($pass, $user->password)) {

                throw new \Exception("password check failed");
            }
            unset($user->password);
        } catch (ModelNotFoundException $e) {

            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="reu auth" ');
            return Writer::json_error($rs, 401, 'Erreur authentification');
        } catch (\Exception $e) {

            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="reu auth" ');
            return Writer::json_error($rs, 401, "Erreur authentification. " . $e->getMessage());
        }


        $secret = $this->container->settings['secret'];
        $token = JWT::encode(
            [
                'iat' => time(),
                'exp' => time() + (12 * 30 * 24 * 3600),
                'upr' => [
                    'mail' => $user->email,
                    'token' => $user->token,
                
                ]
            ],
            '68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=',
            'HS512'
        );

        $user->token = bin2hex(random_bytes(32));
        $user->save();
        $data = [
            'access_token' => $token,
            'token' => $user->token
        ];

        return Writer::json_output($rs, 200, $data);
    }

    public function checkValiditeToken(Request $rq, Response $rs, $args)
    {

        if (!$rq->hasHeader('Authorization')) {
            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="commande_api api" ');
            return Writer::json_error($rs, 401, 'No Authorization header present');
        };


        try {
            $secret = $this->container->settings['secret'];
            $h = $rq->getHeader('Authorization')[0];
            $tokenstring = sscanf($h, "Bearer %s")[0];
            $token = JWT::decode($tokenstring, new Key('68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=', 'HS512'));

            $data =  [
                'mail' => $token->upr->mail,
                'nom' => $token->upr->nom,
                'prenom' => $token->upr->prenom,
                'sexe' => $token->upr->sexe,
            ];
        } catch (ExpiredException $e) {
            return Writer::json_error($rs, 401, 'Le token a expiré. error message:' . $e->getMessage()); // a tester l'expiration du token
        } catch (SignatureInvalidException $e) {
            return Writer::json_error($rs, 401, 'SignatureInvalidException. error message:' . $e->getMessage());
        } catch (BeforeValidException $e) {
            return Writer::json_error($rs, 401, 'BeforeValidException. error message:' . $e->getMessage()); // Comment on teste cette erreur
        } catch (\UnexpectedValueException $e) {
            return Writer::json_error($rs, 401, 'Valuer unexpected. error message:' . $e->getMessage());
        };
        return Writer::json_output($rs, 200, $data);
    }

    function register(Request $rq, Response $rs, array $user_data): Response
    {
        $user_data = $rq->getParsedBody();

        
        if (!isset($user_data['email']) || !filter_var($user_data['email'], FILTER_SANITIZE_EMAIL)) {
            return Writer::json_error($rs, 400, "missing data : mail");
        }
        
        if (!isset($user_data['password'])) {
            return Writer::json_error($rs, 400, "missing data : password");
        }
        

        $user = user_admin::Where('email', 'like', filter_var($user_data['email'], FILTER_SANITIZE_EMAIL))->get();
        if (!empty($user[0]['id'])) {
            return Writer::json_error($rs, 400, "mail already exists");
        }



        try {
            $rs = $rs->withStatus(201)->withHeader('Content-Type', 'application/json;charset=utf-8');
            $cost = 10;
            $c = new user_admin();
            $id = Str::uuid()->toString();
            $c->id = $id;
            $c->email = filter_var($user_data['email'], FILTER_SANITIZE_EMAIL);
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

}
