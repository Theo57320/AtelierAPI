/**
 * @api {get} /users/:token Requête pour la liste des utilisateurs
 * @apiName users
 * @apiGroup Users
 *
 * @apiParam {Chaine} token Users unique token.
 *
 * @apiSuccess {Chaine} id Identifiant de l'utilisateur.
 * @apiSuccess {Chaine} nom Nom de l'utilisateur.
 * @apiSuccess {Chaine} prenom Prenom de l'utilisateur.
 * @apiSuccess {Chaine} mail Mail de l'utilisateur.
 * @apiSuccess {Chaine} sexe Sexe de l'utilisateur.
 * @apiSuccess {Chaine} token Token de l'utilisateur.
 * @apiSuccess {Chaine} dateConnexion Date de la dernière connexion de l'utilisateur.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *[
 *   {
  *      "id": "343d4125-4980-4b00-858c-056562c179d3",
  *      "nom": "test",
 *       "prenom": "test",
 *       "mail": "test@test.fr",
 *       "sexe": "M",
 *       "password": "$2y$10$f8HH8TDL/lEdShxMiD5rf.wa0OQsCodcBaXizfIj6KyKQ3kxN/9wa",
 *       "token": "5cc1c0826852a37f0d21282387f03f1ced4506494d152ed0c51eb8b8166dbb76",
 *       "dateConnexion": "2022-03-30"
 *   },
 *   {
 *       "id": "3a7012db-6529-4104-a6e4-ac02e8858d50",
 *       "nom": "thibaultTest",
 *       "prenom": "thibaultTest",
 *       "mail": "thibaultTest@mail.com",
 *       "sexe": "M",
 *       "password": "$2y$10$447JzgPu766jKsfZ2HKefeUVqFsXJUWrx0W5i48o2GMUKLvCaGZ7O",
 *       "token": "c26babbd2786598204160539fad4df04fae4ac0ca5482c0d5f0b2dc01c677ac2",
 *       "dateConnexion": "2022-03-30"
 *   },
 *]
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 */

/**
 * @api {get} /events/:token Requête pour la liste des événements
 * @apiName events
 * @apiGroup Events
 *
 * @apiParam {Chaine} token Users unique token.
 *
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *[
 *      {
 *       "id": "0ee2df51-f0c0-4a08-9b65-17f62a74c827",
 *       "lat": "49.123421",
 *       "long": "6.219332",
 *       "libelle_event": "evenement de hugo",
 *       "libelle_lieu": "14 rue des coquelicots, Metz",
 *       "horaire": "10:00:00",
 *       "date": "2022-03-29",
 *       "createur_id": "71393b2e-ad00-4b5f-8cf5-e24f537ee2a3"
 *   },
 *   {
 *       "id": "0eeb52d3-e7b6-44cf-9bfb-9ecc4800f273",
 *       "lat": "49.277117",
 *       "long": "6.488152",
 *       "libelle_event": "soirée disco",
 *       "libelle_lieu": "5a rue de metz, Freistroff",
 *       "horaire": "14:00:00",
 *       "date": "2022-04-11",
 *       "createur_id": "7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8"
 *   },
 *]
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 */

/**
 * @api {post} /register/ Requête pour ajouter un utilisateur
 * @apiName register
 * @apiGroup Users
 *
 * @apiBody {chaine} nom Nom de l'utilisateur
 * @apiBody {chaine} prenom Prenom de l'utilisateur
 * @apiBody {chaine} mail Mail de l'utilisateur
 * @apiBody {chaine} sexe Sexe de l'utilisateur
 * @apiBody {chaine} password Mot de passe de l'utilisateur
 *
 * @apiSuccess {Chaine} access_token JWT token.
 * @apiSuccess {Chaine} token token de l'utilisateur.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *
 *{
 *   "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NDg2NTExMzcsImV4cCI6MTY3OTc1NTEzNywidXByIjp7Im1haWwiOiJhbWFnYXR0aGliYXVsdEBtYWlsLmNvbSIsIm5vbSI6InRoaWJhdWx0IiwicHJlbm9tIjoidGFnYW1hIiwic2V4ZSI6Ik0ifX0.LB7G5NFrS5Ix3Um8qpN3vgXilL1PMeHlkEXPI9A7p2s62qzriNLIMlgPuVAGLoro_kfWrFJGou75jTyBnmflbQ",
 *   "token": "0196a3a5d93980b497839f7cedb49b38076c4f886e22b4766813274eebc032af"
 *}
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError ErroValue Erreur de valeur.
 * @apiError MissingData Donnée manquante.
 * @apiError MailAlreadyExists Mail existe déjà.
 * @apiError MailFormatError Format mail erreur.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 *   HTTP/1.1 400 ErroValue
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect value for: (nom,prenom,sexe,password)" 
 *     }
 *   HTTP/1.1 400 MissingData
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "missing data: (nom,prenom,sexe,password)" 
 *     }
 *   HTTP/1.1 400 MailAlreadyExists
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "mail already exists" 
 *     }
 *   HTTP/1.1 400 MailFormatError
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect format for: mail" 
 *     }
 */

/**
 * @api {get} /myPage/:token Requête pour recuperer les données d'un utilisateur
 * @apiName myPage
 * @apiGroup Users
 *
 * @apiParam {Chaine} token Users unique token.
 *
 * @apiSuccess {Chaine} id Id de l'utilisateur
 * @apiSuccess {Chaine} nom Nom de l'utilisateur
 * @apiSuccess {Chaine} prenom Prenom de l'utilisateur
 * @apiSuccess {Chaine} mail Mail de l'utilisateur
 * @apiSuccess {Chaine} sexe Sexe de l'utilisateur
 * @apiSuccess {Chaine} password Mot de passe de l'utilisateur
 * @apiSuccess {Chaine} token Token de l'utilisateur
 * @apiSuccess {Date} dateConnexion Date de la derniere connexion de l'utilisateur
 *
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *
 *{
 *       "id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32",
 *       "nom": "thibault",
 *       "prenom": "tagama",
 *       "mail": "amagatthibault@mail.com",
 *       "sexe": "M",
 *       "password": "$2y$10$gBekRvJGhhiwNDjAQrZqtO.8SqQsxC/u1ElsXLghKG0Ydx/xq6YlS",
 *       "token": "0196a3a5d93980b497839f7cedb49b38076c4f886e22b4766813274eebc032af",
 *       "dateConnexion": "2022-03-30"
 *}
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 */

/**
 * @api {post} /updateUser/ Requête modifier les données d'un utilisateur
 * @apiName updateUser
 * @apiGroup Users
 *
 * @apiParam {Chaine} token Users unique token.
 * @apiParam {Chaine} nom Nom de l'utilisateur.
 * @apiParam {Chaine} prenom Prenom de l'utilisateur.
 * @apiParam {Chaine} mail Mail de l'utilisateur.
 *
 * @apiSuccess {Chaine} id Id de l'utilisateur
 * @apiSuccess {Chaine} nom Nom de l'utilisateur
 * @apiSuccess {Chaine} prenom Prenom de l'utilisateur
 * @apiSuccess {Chaine} mail Mail de l'utilisateur
 * @apiSuccess {Chaine} sexe Sexe de l'utilisateur
 * @apiSuccess {Chaine} token Token de l'utilisateur
 * @apiSuccess {Date} dateConnexion Date de la derniere connexion de l'utilisateur
 *
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *
 *{
 *       "id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32",
 *       "nom": "thibault",
 *       "prenom": "tagama",
 *       "mail": "amagatthibault@mail.com",
 *       "sexe": "M",
 *       "token": "0196a3a5d93980b497839f7cedb49b38076c4f886e22b4766813274eebc032af",
 *       "dateConnexion": "2022-03-30"
 *}
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError MailAlreadyExists Mail existe déjà.
 * @apiError MailFormatError Erreur format de mail.
 * @apiError ErroValue Erreur valeurs.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 *   HTTP/1.1 400 MailAlreadyExists
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "mail already exists" 
 *     }
 *   HTTP/1.1 400 MailFormatError
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect format for: mail" 
 *     }
 *   HTTP/1.1 400 ErroValue
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect value for: (nom,prenom,sexe,password)" 
 *     }
 */

/**
 * @api {post} /postEvent/:token Requête pour ajouter un evenement
 * @apiName postEvent
 * @apiGroup Events
 *
 * @apiParam {chaine} token Token de l'utilisateur
 *
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *
 *{
 *           "id": "6351406f-cfb1-4a78-9f1d-b4d896dae7a9",
 *           "lat": "48.701329",
 *           "long": "6.191928",
 *           "libelle_event": "anniver",
 *           "libelle_lieu": "47 rue de l'abbe gridel, Nancy",
 *           "horaire": "10:00:00",
 *           "date": "2022-03-29",
 *           "createur_id": "7a8832e1-6d8c-4f2e-9d48-70c60cbb59e8"
 *}
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError ErroValue Erreur de valeur.
 * @apiError MissingData Donnée manquante.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 *   HTTP/1.1 400 ErroValue
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect value for: (nom,prenom,sexe,password)" 
 *     }
 *   HTTP/1.1 400 MissingData
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "missing data: (nom,prenom,sexe,password)" 
 *     }
 */

/**
 * @api {post} /lastConnection/:token Requête pour la update la derniere date de connexion
 * @apiName lastConnection
 * @apiGroup Users
 *
 * @apiParam {Chaine} token Users unique token.
 *
 * @apiSuccess {Chaine} id Identifiant de l'utilisateur.
 * @apiSuccess {Chaine} nom Nom de l'utilisateur.
 * @apiSuccess {Chaine} prenom Prenom de l'utilisateur.
 * @apiSuccess {Chaine} mail Mail de l'utilisateur.
 * @apiSuccess {Chaine} sexe Sexe de l'utilisateur.
 * @apiSuccess {Chaine} token Token de l'utilisateur.
 * @apiSuccess {Chaine} dateConnexion Date de la dernière connexion de l'utilisateur.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK

 *   {
 *       "id": "343d4125-4980-4b00-858c-056562c179d3",
 *       "nom": "test",
 *       "prenom": "test",
 *       "mail": "test@test.fr",
 *       "sexe": "M",
 *       "password": "$2y$10$f8HH8TDL/lEdShxMiD5rf.wa0OQsCodcBaXizfIj6KyKQ3kxN/9wa",
 *       "token": "5cc1c0826852a37f0d21282387f03f1ced4506494d152ed0c51eb8b8166dbb76",
 *       "dateConnexion": "2022-03-30"
 *   },
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 */


/**
 * @api {get} /myEvents/:token Requête pour recuperer tout ses événements 
 * @apiName myEvents
 * @apiGroup Events
 *
 * @apiParam {Chaine} token Users unique token.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Entier} count Nombre d'événement de l'utilisateur.
 * @apiSuccess {Tableau} events Tableau des événements de l'utilisateur.
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*
*{
*    "type": "collection",
*    "count": 1,
*    "events": [
*        {
*            "id": "6f114b00-3c03-4815-a9c5-566f79df4307",
*            "lat": "49.223903",
*            "long": "4.052947",
*            "libelle_event": "foot",
*            "libelle_lieu": "9b place de la république, Cormontreuil",
*            "horaire": "17:00:00",
*            "date": "2022-04-01",
*            "createur_id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32"
*        }
*    ]
*}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError NotCreateEvent Pas de création d'évenement.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 *     HTTP/1.1 404 NotCreateEvent
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "you have not yet created an event" 
 *     }
 */


/**
 * @api {get} /myEvent/{id}/:token Requête pour recuperer un événement en tant que créateur de cet événement
 * @apiName myEvent
 * @apiGroup Events
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Tableau} infos Tableau des données.
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 * @apiSuccess {Tableau} users Tableau des données.
 * @apiSuccess {Chaine} nom Nom du participant.
 * @apiSuccess {Chaine} prenom Prenom du participant.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

"type": "event",
    "infos": [
        {
            "id": "6f114b00-3c03-4815-a9c5-566f79df4307",
            "lat": "49.223903",
            "long": "4.052947",
            "libelle_event": "foot",
            "libelle_lieu": "9b place de la république, Cormontreuil",
            "horaire": "17:00:00",
            "date": "2022-04-01",
            "createur_id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32"
        }
    ],
    "users": [
        {
            "nom": "thibault",
            "prenom": "tagama"
        },
        {
            "nom": "georg",
            "prenom": "hugo"
        }
    ]
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError incorrectFormat Valeur erreur.
 * @apiError NotCreateEvent Pas de création d'évenement.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 *     HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect format for: .." 
 *     }
 *     HTTP/1.1 404 NotTheCreator
 *     {
 *      "type": "error",
 *       "error": "404",
 *       "message": "you are not the creator of this event" 
 *     }
 */

/**
 * @api {get} /event/{id}/:token Requête pour recuperer un événement
 * @apiName event
 * @apiGroup Events
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Tableau} infos Tableau des données.
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 * @apiSuccess {Tableau} users Tableau des données.
 * @apiSuccess {Chaine} nom Nom du participant.
 * @apiSuccess {Chaine} prenom Prenom du participant.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

"type": "event",
    "infos": [
        {
            "id": "6f114b00-3c03-4815-a9c5-566f79df4307",
            "lat": "49.223903",
            "long": "4.052947",
            "libelle_event": "foot",
            "libelle_lieu": "9b place de la république, Cormontreuil",
            "horaire": "17:00:00",
            "date": "2022-04-01",
            "createur_id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32"
        }
    ],
    "users": [
        {
            "nom": "thibault",
            "prenom": "tagama"
        },
        {
            "nom": "georg",
            "prenom": "hugo"
        }
    ]
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError incorrectFormat Valeur erreur.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 *     HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect format for: .." 
 *     }
 */


 
/**
 * @api {get} /AllMyEvents/:token Requête pour recuperer ses événement
 * @apiName AllMyEvents
 * @apiGroup Events
 *
 * @apiParam {Chaine} token User unique token.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Tableau} events Tableau des événements de l'utilisateur.
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 * @apiSuccess {Objet} creator Objet createur de l'événement.
 * @apiSuccess {Chaine} nom Nom du créateur de l'événement.
 * @apiSuccess {Chaine} prenom Prenom du créateur de l'événement.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "type": "collection",
    "events": [
        {
            "id": "6f114b00-3c03-4815-a9c5-566f79df4307",
            "libelle_event": "foot",
            "libelle_lieu": "9b place de la république, Cormontreuil",
            "horaire": "17:00:00",
            "date": "2022-04-01",
            "createur_id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32",
            "creator": {
                "nom": "thibault",
                "prenom": "tagama"
            }
        }
    ]
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
 */



/**
 * @api {post} /Venir/{id}/:token Requête pour venir à un événement
 * @apiName Venir
 * @apiGroup Events
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Chaine} oui Vous participez.
 * @apiSuccess {Tableau} events Tableau de l'événements auquel vous participez.
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "type": "collection",
    "oui": "Vous participez",
    "events": [
        {
            "id": "0ee2df51-f0c0-4a08-9b65-17f62a74c827",
            "lat": "49.123421",
            "long": "6.219332",
            "libelle_event": "evenement de hugo",
            "libelle_lieu": "14 rue des coquelicots, Metz",
            "horaire": "10:00:00",
            "date": "2022-03-29",
            "createur_id": "71393b2e-ad00-4b5f-8cf5-e24f537ee2a3"
        }
    ]
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError alreadyParticipe Vous participez déjà.
 * @apiError incorrectFormat Format incorrect.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
        HTTP/1.1 401 alreadyParticipe
 *     {
 *      "type": "error",
 *       "error": "401",
 *       "message": "you already participe to this event" 
 *     }
        HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": " incorrect format" 
 *     }

 */


/**
 * @api {post} /PasVenir/{id}/:token Requête pour ne pas venir à un événement
 * @apiName PasVenir
 * @apiGroup Events
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Chaine} non Vous ne participez pas.
 * @apiSuccess {Tableau} events Tableau de l'événements auquel vous participez.
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "type": "collection",
    "non" => 'Vous ne participez pas',
    "events": [
        {
            "id": "0ee2df51-f0c0-4a08-9b65-17f62a74c827",
            "lat": "49.123421",
            "long": "6.219332",
            "libelle_event": "evenement de hugo",
            "libelle_lieu": "14 rue des coquelicots, Metz",
            "horaire": "10:00:00",
            "date": "2022-03-29",
            "createur_id": "71393b2e-ad00-4b5f-8cf5-e24f537ee2a3"
        }
    ]
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError alreadyParticipe Vous ne participez pas déjà.
 * @apiError incorrectFormat Format incorrect.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
        HTTP/1.1 401 alreadyNotParticipe
 *     {
 *      "type": "error",
 *       "error": "401",
 *       "message": "you already not participe to this event" 
 *     }
        HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": " incorrect format" 
 *     }

 */

/**
 * @api {post} /AddComment/{id}/:token Requête ajouter un commentaires
 * @apiName AddComment
 * @apiGroup Comments
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement.
 * @apiParam {Chaine} comment Commentaire.
 *
 * @apiSuccess {Chaine} id_rdv Identifiant du rdv.
 * @apiSuccess {Chaine} id_user Identifiant de l'utilisateur.
 * @apiSuccess {Chaine} message Contenu du message.
 * @apiSuccess {TimeStamp} updated_at Date de l'update du message.
 * @apiSuccess {TimeStamp} created_at Date de création du message.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "id_rdv": "0ee2df51-f0c0-4a08-9b65-17f62a74c827",
    "id_user": "b8fa9148-3b0e-46a1-a4d8-546160e90a32",
    "message": "test",
    "updated_at": "2022-03-30T16:24:39.000000Z",
    "created_at": "2022-03-30T16:24:39.000000Z"
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError incorrectFormat Format incorrect.
 * @apiError eventDoesntExists Evenement inexistant.

 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
        HTTP/1.1 404 eventDoesntExists
 *     {
 *      "type": "error",
 *       "error": "404",
 *       "message": "This event does not exist" 
 *     }
        HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": " incorrect format for : .." 
 *     }

 */
 
/**
 * @api {get} /ListComments/{id}/:token Requête liste les commentaires d'un evenement
 * @apiName ListComments
 * @apiGroup Comments
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement..
 *
 * @apiSuccess {Chaine} message Contenu du message.
 * @apiSuccess {Tableau} user Tableau donnée de l'auteur.
 * @apiSuccess {Chaine} nom Nom de l'auteur.
 * @apiSuccess {Chaine} prenom Prenom de l'auteur.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

[
    {
        "message": "Je viens",
        "user": {
            "nom": "georg",
            "prenom": "hugo"
        }
    },
    {
        "message": "Je viens",
        "user": {
            "nom": "thibault",
            "prenom": "tagama"
        }
    },
    {
        "message": "test",
        "user": {
            "nom": "thibault",
            "prenom": "tagama"
        }
    }
]
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError incorrectFormat Format incorrect.
 * @apiError eventDoesntExists Evenement inexistant.

 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
        HTTP/1.1 404 eventDoesntExists
 *     {
 *      "type": "error",
 *       "error": "404",
 *       "message": "This event does not exist" 
 *     }
        HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": " incorrect format for : .." 
 *     }

 */

/**
 * @api {get} /NeparticipePas/{id}/:token Requête liste des utilisateurs ne participant pas à un evenement (Pour le créateur de l'evenement)
 * @apiName NeparticipePas
 * @apiGroup Participer
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Tableau} user Tableau donnée de l'utilisateur ne participant pas .
 * @apiSuccess {Chaine} nom Nom de l'utilisateur ne participant pas .
 * @apiSuccess {Chaine} prenom Prenom de l'utilisateur ne participant pas .

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "type": "users",
    "users": [
        {
            "nom": "test",
            "prenom": "val"
        }
    ]
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError incorrectFormat Format incorrect.
 * @apiError NotCreator Vous n'êtes pas le créateur de cet événement.

 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
        HTTP/1.1 404 NotCreator
 *     {
 *      "type": "error",
 *       "error": "404",
 *       "message": "you are not the creator of this event" 
 *     }
        HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": " incorrect format for : .." 
 *     }

 */



/**
 * @api {get} /getRole/{id}/:token Requête Donne le role
 * @apiName getRole
 * @apiGroup Users
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id Id de l'événement.
 *
 * @apiSuccess {Chaine} role Role de l'utilisateur reference au token.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "role": "proprietaire"
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.
 * @apiError incorrectFormat Format incorrect.

 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }
        HTTP/1.1 400 incorrectFormat
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": " incorrect format for : .." 
 *     }

 */

/**
 * @api {get} /InvitEvents/:token Requête retourne la liste des evenements auquel l'utilisateur est invité
 * @apiName getRole
 * @apiGroup Invitation
 *
 * @apiParam {Chaine} token User unique token.
 *
 * @apiSuccess {Chaine} type Type des données.
 * @apiSuccess {Tableau} events Tableau de l'événements auquel vous participez.
 * @apiSuccess {Chaine} id Identifiant de l'événement.
 * @apiSuccess {Double} lat Latitude de l'événement.
 * @apiSuccess {Double} long Longitude de l'événement.
 * @apiSuccess {Chaine} libelle_event Libelle de l'événement.
 * @apiSuccess {Chaine} libelle_lieu Libelle du lieu.
 * @apiSuccess {Time} horaire Horaire de l'événement.
 * @apiSuccess {Date} date Date de l'événement.
 * @apiSuccess {Chaine} createur_id Identifiant du créateur de l'événement.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "type": "event",
    "events": [
        {
            "id": "6f114b00-3c03-4815-a9c5-566f79df4307",
            "lat": "49.223903",
            "long": "4.052947",
            "libelle_event": "foot",
            "libelle_lieu": "9b place de la république, Cormontreuil",
            "horaire": "17:00:00",
            "date": "2022-04-01",
            "createur_id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32"
        }
    ]
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.

 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }

 */


/**
 * @api {get} /getUser/:token Requête retourne l'utilisateur en fonction de son id et de son token
 * @apiName getUser
 * @apiGroup Users
 *
 * @apiParam {Chaine} token User unique token.
 * @apiParam {Chaine} id User id.
 *
 * @apiSuccess {Chaine} id Id de l'utilisateur.
 * @apiSuccess {Chaine} nom Nom de l'utilisateur.
 * @apiSuccess {Chaine} prenom Prenom de l'utilisateur.
 * @apiSuccess {Chaine} mail Mail de l'utilisateur.
 * @apiSuccess {Chaine} sexe Sexe de l'utilisateur.
 * @apiSuccess {Chaine} password Mot de passe de l'utilisateur.
 * @apiSuccess {Chaine} token Token de l'utilisateur.
 * @apiSuccess {Time} dateConnexion Date de derniere connexion.

 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
*

{
    "id": "b8fa9148-3b0e-46a1-a4d8-546160e90a32",
    "nom": "thibault",
    "prenom": "tagama",
    "mail": "amagatthibault@mail.com",
    "sexe": "M",
    "password": "$2y$10$gBekRvJGhhiwNDjAQrZqtO.8SqQsxC/u1ElsXLghKG0Ydx/xq6YlS",
    "token": "0196a3a5d93980b497839f7cedb49b38076c4f886e22b4766813274eebc032af",
    "dateConnexion": "2022-03-30"
}
 *
 * @apiError notAllowedHandler Methode non autorisée.
 * @apiError phpErrorHandler Erreur serveur.
 * @apiError notFoundHandler URI mal formulee.

 * @apiErrorExample Error-Response:
 *     HTTP/1.1 405 notAllowedHandler
 *     {
 *      "type": "error",
 *       "error": "405",
 *       "message": "Methode autorisee : ..." 
 *     }
 *     HTTP/1.1 500 phpErrorHandler
 *     {
 *      "type": "error",
 *       "error": "500",
 *       "message": "Erreur serveur : ..." 
 *     }
 *     HTTP/1.1 400 notFoundHandler
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "URI mal formulee" 
 *     }

 */

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
 *       "error": "401",
 *       "message": "you are not the creator of this event" 
 *     }
 *     
 */

/**
 * @api {delete} /userSupp/ Supprimer son propre compte
 * @apiName userSupp
 * @apiGroup Users
 * @apiParam {String} token Users unique token.
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *    {
 *      "User supprimé"
 *     }
 *     
 */

/**
 * @api {post} /invitation/:id/ Inviter un User à un Event
 * @apiParam {String} id de l'evenement
 * @apiName PostInvit
 * @apiGroup Invitation
 *
 * @apiParam {String} token Users unique token
 * @apiParam {String} id Identifiant d'un Event
 * @apiParam {String} id_user Identifiant d'un Utilisateur
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *      "type" : "Response",
 *      "message" : "User invite"
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Unauthorized
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "id_user invalid or not here" 
 *     }
 *     
 */

/**
 * @api {get} /getUsersInviteNonRefuse/:id/ Users qui n'ont pas réagit a une invitation
 * @apiParam {String} id de l'evenement
 * @apiName getUsersInviteNonRefuse
 * @apiGroup Invitation
 *
 * @apiParam {String} token Users unique token
 * @apiParam {String} id Identifiant d'un Event
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *      "users" : {  ...  }
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Unauthorized
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect format for: id" 
 *     }
 *     
 */

/**
 * @api {get} /getUsersNonInvite/:id/ Users qui ne sont pas inviter a un evenement
 * @apiParam {String} id de l'evenement
 * @apiName getUsersNonInvite
 * @apiGroup Invitation
 *
 * @apiParam {String} token Users unique token
 * @apiParam {String} id Identifiant d'un Event
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *      "users" : {  ...  }
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Unauthorized
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect format for: id" 
 *     }
 *     
 */

/**
 * @api {get} /getUsersInvite/:id/ Users qui ne sont pas inviter a un evenement
 * @apiParam {String} id de l'evenement
 * @apiName getUsersInvite
 * @apiGroup Invitation
 *
 * @apiParam {String} token Users unique token
 * @apiParam {String} id Identifiant d'un Event
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *      "users" : {  ...  }
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 400 Unauthorized
 *     {
 *      "type": "error",
 *       "error": "400",
 *       "message": "incorrect format for: id" 
 *     }
 *     
 */