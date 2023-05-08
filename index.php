<?php
    //Démarrage de la session
    session_start();
    //Importer les ressources
    use App\Controller\UserController;
    use App\Controller\RolesController;
    use App\Controller\ChocoblastController;
    use App\Controller\CommentaireController;
    use App\Api\ApiUser;
    include './App/Utils/BddConnect.php';
    include './App/Utils/Fonctions.php';
    include './App/Model/Roles.php';
    include './App/Controller/RolesController.php';
    include './App/Model/Utilisateur.php';
    include './App/Controller/UserController.php';
    include './App/Model/Chocoblast.php';
    include './App/Controller/ChocoblastController.php';
    include './App/Model/Commentaire.php';
    include './App/Controller/CommentaireController.php';
    include './App/Api/ApiUser.php';
    
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    $rolesController = new RolesController();
    $chocoblastController = new ChocoblastController();
    $commentaireController = new CommentaireController();
    $apiUser = new ApiUser();
    //routeur connecte
    if(isset($_SESSION['connected'])){
        switch ($path) {
            case '/projet/':
                include './App/Vue/home.php';
                break;
            case '/projet/rolesAdd':
                $rolesController->insertRoles();
                break;
            case '/projet/chocoblastAdd':
                $chocoblastController->insertChocoblast();
                break;
            case '/projet/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/projet/filter':
                $chocoblastController->showAllChocoblastJson();
                break;
            case '/projet/chocoblastDelete':
                $chocoblastController->deleteChocoblastById();
                break;
            case '/projet/chocoblastUpdate':
                $chocoblastController->updateChocoblastById();
                break;
            case '/projet/commentaireAdd':
                $commentaireController->insertCommentaire();
                break;
            case '/projet/deconnexion':
                $userController->deconnexionUser();
                break;
            default:
                include './App/Vue/error.php';
                break;
            }
    }
    //routeur non connecté
    else{
        switch ($path) {
            case '/projet/':
                include './App/Vue/home.php';
                break;
            case '/projet/userAdd':
                $userController->insertUser();
                break;
            case '/projet/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/projet/chocobalstFilter':
                $chocoblastController->showAllChocoblastJson();
                break;
            case '/projet/api/chocoFilter':
                $chocoblastController->chocoJson();
                break;
            case '/projet/chocoblastDelete':
                header('Location: ./chocoblastAll');
                break;
            case '/projet/chocoblastUpdate':
                header('Location: ./chocoblastAll');
                break;
            case '/projet/commentaireAdd':
                header('Location: ./chocoblastAll');
                break;
            case '/projet/connexion':
                $userController->connexionUser();
                break;
            case '/projet/api/users/all':
                $apiUser->getAllUsersJson();
                break;
            case '/projet/api/users/id':
                $apiUser->getUserByIdJson();
                break;
            case '/projet/api/users/add':
                $apiUser->addUserByJson();
                break;
            case '/projet/api/auth':
                include './App/Api/Authentification.php';
                break;
            case '/projet/api/response':
                include './App/Api/Response.php';
                break;
            default:
                include './App/Vue/error.php';
                break;
        }
    }
?>