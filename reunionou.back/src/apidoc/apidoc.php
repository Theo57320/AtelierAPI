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
 * @apiGroup rdv
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
   <!--  -->