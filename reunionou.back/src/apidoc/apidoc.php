<!-- allusers -->
/**
 * @api {get} /users/ Request all users
 * @apiName users
 * @apiGroup users
 *

 *
 * @apiSuccess {int} id ID of the User.
 * @apiSuccess {String} nom  nom of the User.
 * @apiSuccess {String} prenom  prenom of the User.
 * @apiSuccess {String} mail  mail of the User.
 * @apiSuccess {String} sexe sexe of the User.
 * @apiSuccess {String} password  password of the User.
 * @apiSuccess {String} token  token of the User.
 * @apiSuccess {String} dateConnexion  Date de derniere connexion du User.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "id": "343d4125-4980-4b00-858c-056562c179d3",
        "nom": "test",
        "prenom": "test",
        "mail": "test@test.fr",
        "sexe": "F",
        "password": "$2y$10$f8HH8TDL/lEdS6hMiD5rf.wa0OQsCodcBaXizfIj6KyKQ3kxN/9wa",
        "token": "c2aa47b16bd1390h9203b0c3cf2cd7bd7d98c4e85041c2df91b486f97aa0b5d4",
        "dateConnexion": "2022-03-29"
 *     }
 *
 * @apiError url not found The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "url not found"
 *     }

 
 */

<!-- user id -->
/**
 * @api {get} /user/{id} Request a specific user
 * @apiName /user/id
 * @apiGroup users
 *
 * @apiParam {Number} id Users unique ID.
 *
 * @apiSuccess {int} id ID of the User.
 * @apiSuccess {String} nom  nom of the User.
 * @apiSuccess {String} prenom  prenom of the User.
 * @apiSuccess {String} mail  mail of the User.
 * @apiSuccess {String} sexe sexe of the User.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "id": "343d4125-4980-4b00-858c-056562c179d3",
        "nom": "test",
        "prenom": "test",
        "mail": "test@test.fr",
        "sexe": "F",
 *     }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */

<!-- user absent -->
/**
 * @api {get} /userAbsent user absent (5 month)
 * @apiName /userAbsent
 * @apiGroup users
 *

 *
 * @apiSuccess {int} id ID of the User.
 * @apiSuccess {String} nom  nom of the User.
 * @apiSuccess {String} prenom  prenom of the User.
 * @apiSuccess {String} mail  mail of the User.
 * @apiSuccess {String} sexe sexe of the User.
 * @apiSuccess {String} dateConnexion  Date de derniere connexion du User.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "id": "343d4125-4980-4b00-858c-056562c179d3",
        "nom": "test",
        "prenom": "test",
        "mail": "test@test.fr",
        "sexe": "F",
 *     }
 *
 * @apiError URI mal formee The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Not Found
 *     {
 *       "error": "URI mal formee"
 *     }
 */

 <!-- userSupp -->

 /**
 * @api {delete} /userSupp/{id} Delete specific user
 * @apiName /userSupp/id
 * @apiGroup users
 *
 * @apiParam {Number} id Users unique ID.
 *
 * @apiSuccess {int} 1 for success.


 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       1
 *     }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */

  <!-- rdv -->
  /**
 * @api {get} /rdv/ Request all rdv
 * @apiName rdv
 * @apiGroup Event
 *

 *
 * @apiSuccess {int} id ID of the event.
 * @apiSuccess {float} lat Lat of coord.
 * @apiSuccess {float} long  Long of coor.
 * @apiSuccess {String} libelle_event  Libelle of the event.
 * @apiSuccess {String} libelle_lieu Lieu of the event.
 * @apiSuccess {time} horaire  Hour of the event.
 * @apiSuccess {date} date   Date of the event.
 * @apiSuccess {varchar} createur_id   Createur of the event.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "id": "0ee2df51-f0c0-4a08-9b65-17f62a74c827",
        "lat": "49.123421",
        "long": "6.219332",
        "libelle_event": "evenement de hugo",
        "libelle_lieu": "14 rue des coquelicots, Metz",
        "horaire": "10:00:00",
        "date": "2022-03-29",
        "createur_id": "71393b2e-ad00-4b5f-8cf5-e24f537ee2a3"
 *     }
 *
 * @apiError url not found The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "url not found"
 *     }

 
 */

/**
 * @api {get} /user/rdvPasse/ Get all event information
 * @apiVersion 0.0.0
 * @apiName GetAllEvent
 * @apiGroup Event
 *
 * @apiSuccess {String} id id of the User.
 * @apiSuccess {String} lat lat of the User.
 * @apiSuccess {String} long long of the User.
 * @apiSuccess {String} libelle_event lebelle_event of the User.
 * @apiSuccess {String} lebelle_lieu of the User.
 * @apiSuccess {String} horraire horraire of the User.
 * @apiSuccess {String} date date of the User.
 * @apiSuccess {String} createur_id createur_id of the User.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "id": "0ee2df51-f0c0-4a08-9b65-17f62a74c827",
 *       "lat": "49.123421",
 *       "long": "6.219332",
 *       "libelle_event": "evenement de hugo",
 *       "libelle_lieu": "14 rue des coquelicots, Metz",
 *       "horaire": "10:00:00",
 *       "date": "2022-03-29",
 *       "createur_id": "71393b2e-ad00-4b5f-8cf5-e24f537ee2a3"
 *     }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */

/**
 * @api {get} /rdv/{id}/ Get only one event information
 * @apiVersion 0.0.0
 * @apiName GetOneEvent
 * @apiGroup Event
 *
 *
 * @apiSuccess {String} id id of the User.
 * @apiSuccess {String} lat lat of the User.
 * @apiSuccess {String} long long of the User.
 * @apiSuccess {String} libelle_event lebelle_event of the User.
 * @apiSuccess {String} lebelle_lieu of the User.
 * @apiSuccess {String} horraire horraire of the User.
 * @apiSuccess {String} date date of the User.
 * @apiSuccess {String} createur_id createur_id of the User.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       id: "0eeb52d3-e7b6-44cf-9bfb-9ecc4800f273",
 *       lat: "49.277117",
 *       long: "6.488152",
 *       libelle_event: "soirÃ©e disco",
 *       libelle_lieu: "5a rue de metz, Freistroff",
 *       horaire: "14:00:00",
 *       date: "2022-04-11",
 *       createur_id: "7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8"
 *     }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */



/**
 * @api {delete} /rdvSupp/{id}/ Get only one event information
 * @apiVersion 0.0.0
 * @apiName DeleteEvent
 * @apiGroup Event
 *
 *
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "1"
 *     }
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */


/**
 * @api {get} /auth/ Login in back
 * @apiVersion 0.0.0
 * @apiName Authentification
 * @apiGroup BackOffice
 *
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       access_token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NDg2NjEwOTIsImV4cCI6MTY3OTc2NTA5MiwidXByIjp7Im1haWwiOiJ0aGVvYW50b0BtYWlsLmZyIiwidG9rZW4iOiI0OGNhZTBjNmI0YmNiYzdiNTFkNjlhNGQ0MmUxNGNlMmM5N2E0YjZhM2NkNmFmNWZiZDQ1YmI0YzY2NTZiOTQzIn19.pK5-9HQAsqBI7GArgknGPictQ5K3K7WypklR5WrgfuauJvkbajwDGSsyid47Vu_hbKCdqQ4occDgz8I3vW6P2g",
 *       token: "0c1c199d6453d5e34cd85e9a122acb56dacef42bb2537c40d721295a5194ac4e"
}
 *
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */

/**
 * @api {post} /user/register/ Create account
 * @apiVersion 0.0.0
 * @apiName Créate account
 * @apiGroup BackOffice
 *
 @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 {
    "email":"admin3@mail.fr",
    "password":"admin"
}
 {
    "id": "33025c6a-6fb5-4ffc-88e7-bc7b3e763b58",
    "email": "admin3@mail.fr",
    "password": "$2y$10$fPjS2QXSLIwDwTXYZi7Ti.goiuQh7nqtBlM/HuICnzKhQ1/b5HPjC",
    "token": "a12cf54b9a8e71bffaf688e5819a4615f2393b8c118b62de2421562920a21f40"
}
 * @apiError UserNotFound The id of the User was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 404 Not Found
 *     {
 *       "error": "UserNotFound"
 *     }
 */
 

/**
 * @api {get} /check/ Verification du token
 * @apiName Check
 * @apiGroup BackOffice
 *
 *
 * @apiHeader (Authorization) {String} Bearer access_token delivré par /auth/
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 * {
 *  "mail": "valentin@test.fr",
 *  "nom": "bardet",
 *  "prenom": "valentin",
 *  "sexe": "M"
 * }
 *
 * @apiError (Error 401) NoAuthorizationheader Il n'y a pas de header Authorization
 *
 * @apiErrorExample NoAuthorizationheader-Response:
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "No Authorization header present"
 *   }
 * @apiError (Error 401) expired-token Le token a expiré
 * @apiError (Error 401) SignatureInvalidException la signature n'est pas bonne
 * @apiError (Error 401) BeforeValidException . 
 * @apiError (Error 401) ValueUnexpected Un champ est innatendu
 */
   <!--  -->
