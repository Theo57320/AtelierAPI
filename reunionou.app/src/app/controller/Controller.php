<?php


namespace reu\app\app\controller;


use Firebase\JWT\JWT as JWT;
use Firebase\JWT\Key as Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException ;
use Firebase\JWT\BeforeValidException;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    
    public function __construct(\Slim\Container $c){
        $this->container=$c;
    }

    public function listUsers(Request $req, Response $resp, array $args): Response
    {
        $commandes = User::all();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($commandes));
        return $resp;
    }
    public function listEvents(Request $req, Response $resp, array $args): Response
    {
        $commandes = Rdv::all();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($commandes));
        return $resp;
    }

    // function addCommande (Request $rq, Response $rs, array $command_data):Response{
    //     $command_data=$rq->getParsedBody();
        
    //     if (!isset($command_data['nom'])){
    //         return Writer::json_error($rs, 400, "missing data : nom");
    //     }
    //     if (!isset($command_data['prenom'])){
    //         return Writer::json_error($rs, 400, "missing data : prenom");
    //     }
    //     if (!isset($command_data['mail'])|| !filter_var($command_data['mail'],FILTER_SANITIZE_EMAIL)){
    //         return Writer::json_error($rs, 400, "missing data : mail");
    //     }
    //     if (!isset($command_data['sexe'])){
    //         return Writer::json_error($rs, 400, "missing data : sexe");
    //     }
            
    //     if (!isset($command_data['livraison']['heure'])){
    //         return Writer::json_error($rs, 400, "missing data : livraison heure");
    //     }
    //     //VALIDATOR
    //     if(v::alnum()->validate($command_data['nom_client'])!=true){
    //         $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
    //         $rs->getBody()->write("error incorrect value for:nom_client");
    //         return $rs;    
    //     }
    //     if(v::date('Y-m-d')->validate($command_data['livraison']['date'])!=true||$command_data['livraison']['date']<date("Y-m-d")){
    //         $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
    //         $rs->getBody()->write("error incorrect value for:date");
    //         return $rs;   
    //     }
    //     if(v::email()->validate($command_data['mail_client'])!=true){
    //         $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
    //         $rs->getBody()->write("error incorrect value for:mail_client");
    //         return $rs;    
    //     }
     
    //     if(!isset($command_data['items'])){
    //         $rs = $rs->withStatus(400)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
    //         $rs->getBody()->write("error array items doesn't exist");
    //         return $rs;    
    //     };
        
    

    //     try{
    //         $rs = $rs->withStatus(201)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
    //         $date=new DateTime($command_data['livraison']['date'].' '.$command_data['livraison']['heure']);
            
    //         $c= new User();
    //         $id=Str::uuid()->toString();
    //         $c->id = $id;
    //         $c->nom = filter_var($command_data['nom_client'],FILTER_SANITIZE_STRING);
    //         $c->mail = filter_var($command_data['mail_client'],FILTER_SANITIZE_EMAIL);
    //         $c->livraison = date_format($date,'Y-m-d H:i');
    //         $c->status = 5;
    //         $c->token=bin2hex(random_bytes(32));
    //         $c->montant=0;
    //         foreach($command_data['items'] as $item){
    //             Rdv::create([
    //                 'uri' => $item['uri'],
    //                 'quantite'=>$item['q'],
    //                 'libelle'=>$item['libelle'],
    //                 'command_id'=>$c->id,
    //                 'tarif'=>$item['tarif'],
    //             ]);


               
    //             $c->montant+=$item['q']*$item['tarif'];
            
    //         }
            
    //         $c->save();


    //         $rs->getBody()->write(json_encode($c));//erreur DEMANDER AU PROF
    //         return $rs;
    //     }catch(\Exception $e){
    //         $rs = $rs->withStatus(500)->withHeader( 'Content-Type', 'application/json;charset=utf-8');
    //         $rs->getBody()->write($e->getMessage());
    //         return $rs;
    //     }
    // }


    public function authenticate(Request $rq, Response $rs, $args): Response {

        if (!$rq->hasHeader('Authorization')) {

            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="commande_api api" ');
            return Writer::json_error($rs, 401, 'No Authorization header present');
        };

        $authstring = base64_decode(explode(" ", $rq->getHeader('Authorization')[0])[1]);   
        list($email, $pass) = explode(':', $authstring);

        try {
            
            $user = User::select('id', 'email', 'username', 'passwd', 'refresh_token', 'level')
                ->where('email', '=', $email)
                ->firstOrFail();
           
            if (!password_verify($pass, $user->passwd)){
                
                throw new \Exception("password check failed");
            }
            unset ($user->passwd);

        } catch (ModelNotFoundException $e) {
            
            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs auth" ');
            return Writer::json_error($rs, 401, 'Erreur authentification');
        } catch (\Exception $e) {
           
            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs auth" ');
            return Writer::json_error($rs, 401, "Erreur authentification. ".$e->getMessage());
        }


        $secret = $this->container->settings['secret'];
        $token = JWT::encode(['iss' => 'http://api.auth.local/auth',
            'aud' => 'http://api.backoffice.local',
            'iat' => time(),
            'exp' => time() + (12 * 30 * 24 * 3600),
            'upr' => [
                'email' => $user->email,
                'username' => $user->username,
                'level' => $user->level
            ]],
            $secret, 'HS512');

            $user->refresh_token = bin2hex(random_bytes(32));
            $user->save();
            $data = [
                'access-token' => $token,
                'refresh-token' => $user->refresh_token
            ];

            return Writer::json_output($rs, 200, $data);


    }

    public function checkValiditeToken(Request $rq, Response $rs, $args){
        
        if (!$rq->hasHeader('Authorization')) {

            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="commande_api api" ');
            return Writer::json_error($rs, 401, 'No Authorization header present');
        };
       

        try {
            $secret = $this->container->settings['secret'];
            $h = $rq->getHeader('Authorization')[0] ;
            $tokenstring = sscanf($h, "Bearer %s")[0] ;
            $token = JWT::decode($tokenstring, new Key($secret,'HS512' ));

            $data=  [
                'email' => $token->upr->email,
                'username' => $token->upr->username,
                'level'=>$token->upr->level
            ];
            
            
        } catch (ExpiredException $e) {
            return Writer::json_error($rs, 401, 'Le token a expiré. error message:'.$e->getMessage());// a tester l'expiration du token
        } catch (SignatureInvalidException $e) {
            return Writer::json_error($rs, 401, 'SignatureInvalidException. error message:'.$e->getMessage());
        } catch (BeforeValidException $e) {
            return Writer::json_error($rs, 401, 'BeforeValidException. error message:'.$e->getMessage());// Comment on teste cette erreur
        } catch (\UnexpectedValueException $e) { 
            return Writer::json_error($rs, 401, 'Valuer unexpected. error message:'.$e->getMessage());
        };
        return Writer::json_output($rs, 200, $data);
        }

}