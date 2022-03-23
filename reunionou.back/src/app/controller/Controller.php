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
        $commandes = User::all();
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($commandes));
        return $resp;
    }


    public function getUser(Request $req, Response $resp, array $args): Response
    {
        $id=$args['id'];
        $user = User::select(['id','nom','prenom','mail','sexe'])
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
        
        $commandes = User::select(['id','nom','prenom','mail','sexe','dateConnexion'])
        ->where('dateConnexion','<',$dateDiff)
        ->get();
        // var_dump($commandes);
        $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
        $resp->getBody()->write(json_encode($commandes));
        return $resp;
    }
   

    // public function userAbsent(Request $req, Response $resp, array $args): Response
    // {
    //     $commandes = User::select(['id','nom','prenom','mail','sexe','dateConnexion'])
    //     ->where('datediff(day, dateConnexion, getdate()','>','10')
    //     ->get();
    //     $resp = $resp->withHeader('Content-Type', 'application/json;charset=utf-8');
    //     $resp->getBody()->write(json_encode($commandes));
    //     return $resp;
    // }


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
        $user = User::where('id','=',$id)
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
}








// Afficher les evenement qui ont eu lieu avant la date d'ajd


// All rdv
// where: dateRdv < dateAjd
// Quand :
// date ajd
// DAYOFYEAR(NOW())
// <
