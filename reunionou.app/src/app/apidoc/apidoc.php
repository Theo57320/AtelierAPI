/**
 * @api {get} /ListInvitsSansRep/ Invitations de l'utilisateur non vues

 * @apiName LiListInvitsSansRepst
 * @apiGroup Events
 *
 * @apiParam {String} token Users unique token.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 *       "type": "collection",
 *       "events": { ... }
 *                 { ... }
 *     }
 * @apiError notAllowedHandler Methode non autorisée.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 BadRequest
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "erreur param token inexistant ou invalide" 
 *     }
 *     
 */

/**
 * @api {delete} /RdvSupp/:id/ Supprimer son propre evenement
 * @apiParam {String} id de l'evenement
 * @apiName RdvSupp
 * @apiGroup Events
 *
 * @apiParam {String} token Users unique token.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 *      "event supprimé"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "you are not the creator of this event" 
 *     }
 *     
 */

/**
 * @api {delete} /userSupp/ Supprimer son propre compte
 * @apiName userSupp
 * @apiGroup User
 * @apiParam {String} token Users unique token.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 *      "User supprimé"
 *     }
 *     
 */