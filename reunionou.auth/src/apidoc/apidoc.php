/**
 * @api {get} /auth/ Verification des information de connection
 * @apiName Authentification
 * @apiGroup Auth
 *
 *
 * @apiHeader (Authorization) {email} username mail de connection d'un utilisateur
 * @apiHeader (Authorization) {password} password mot de passe de l'utilisateur
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NDg2NTE1ODQsImV4cCI6MTY3OTc1NTU4NCwidXByIjp7Im1haWwiOiJ2YWxlbnRpbkB0ZXN0LmZyIiwibm9tIjoidGVzdCIsInByZW5vbSI6Im51bGwiLCJzZXhlIjoiRiJ9fQ.-Wm-je8ccEoTPe0rorj5FdBmmBB-o-NoD2lON_t1lt3mxuULaCvAFG6Vc5sZZZEQFNvJKaRuEW-vfm2Vyy80cw",
 *      "token": "e3461dc91eb264a2f9bcd0e43db8bb786664c3f926e87743a6d180d079c3722d"
 *     }
 *
 * @apiErrorExample Error-Response:
 * HTTP/1.1 401 Unauthorized
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "Erreur authentification"
 *   }
 * @apiError (Error 401) NoAuthorizationheader Il n'y a pas de header Authorization
 *
 * @apiErrorExample NoAuthorizationheader-Response:
 * HTTP/1.1 401 Unauthorized
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message": "No Authorization header present"
 *   }
 * @apiError (Error 401) password-check-failed Le mot de passe n'est pas bon
 * @apiErrorExample password-check-failed-Response:
 * HTTP/1.1 401 Unauthorized
 *   {
 *      "type": "error",
 *      "error": 401,   
 *      "message":  "Erreur authentification. password check failed"
 *   }
 */

/**
 * @api {get} /check/ Verification du token
 * @apiName Check
 * @apiGroup Check
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