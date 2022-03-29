<?php


namespace reu\auth\app\controller;


use Firebase\JWT\JWT as JWT;
use Firebase\JWT\Key as Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use reu\auth\app\models\User;
use reu\auth\app\utils\Writer;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/**
 * Class reuAuthController
 * @package reu\auth\app\controller
 */
class reuAuthController
{
    private $c; //le conteneur de dépendance de l'application

    public function __construct(\Slim\Container $c)
    {
        $this->container = $c;
    }
    public function authenticate(Request $rq, Response $rs, $args): Response
    {

        if (!$rq->hasHeader('Authorization')) {
            $rs = $rs->withHeader('WWW-authenticate', 'Basic realm="reu_api api" ');
            return Writer::json_error($rs, 401, 'No Authorization header present');
        };

        $authstring = base64_decode(explode(" ", $rq->getHeader('Authorization')[0])[1]);
        list($mail, $pass) = explode(':', $authstring);

        try {
            $user = User::select('id', 'mail', 'nom', 'prenom','sexe', 'password', 'token')
                ->where('mail', '=', $mail)
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
                    'mail' => $user->mail,
                    'nom' => $user->nom,
                    'prenom' => $user->prenom,
                    'sexe' => $user->sexe,
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
}
