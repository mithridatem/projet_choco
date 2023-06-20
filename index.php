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
            case '/projet_choco/':
                include './App/Vue/home.php';
                break;
            case '/projet_choco/rolesAdd':
                $rolesController->insertRoles();
                break;
            case '/projet_choco/chocoblastAdd':
                $chocoblastController->insertChocoblast();
                break;
            case '/projet_choco/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/projet_choco/chocoblastFilter':
                $chocoblastController->showAllChocoblastJson();
                break;
            case '/projet_choco/chocoblastDelete':
                $chocoblastController->deleteChocoblastById();
                break;
            case '/projet_choco/chocoblastUpdate':
                $chocoblastController->updateChocoblastById();
                break;
            case '/projet_choco/commentaireAdd':
                $commentaireController->insertCommentaire();
                break;
            case '/projet_choco/deconnexion':
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
            case '/projet_choco/':
                include './App/Vue/home.php';
                break;
            case '/projet_choco/userAdd':
                $userController->insertUser();
                break;
            case '/projet_choco/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/projet_choco/chocoblastFilter':
                $chocoblastController->showAllChocoblastJson();
                break;
            case '/projet_choco/api/chocoFilter':
                $chocoblastController->chocoJson();
                break;
            case '/projet_choco/chocoblastDelete':
                header('Location: ./chocoblastAll');
                break;
            case '/projet_choco/chocoblastUpdate':
                header('Location: ./chocoblastAll');
                break;
            case '/projet_choco/commentaireAdd':
                header('Location: ./chocoblastAll');
                break;
            case '/projet_choco/connexion':
                $userController->connexionUser();
                break;
            case '/projet_choco/api/users/all':
                $apiUser->getAllUsersJson();
                break;
            case '/projet_choco/api/users/id':
                $apiUser->getUserByIdJson();
                break;
            case '/projet_choco/api/users/add':
                $apiUser->addUserByJson();
                break;
            case '/projet_choco/api/auth':
                include './App/Api/Authentification.php';
                break;
            case '/projet_choco/api/response':
                include './App/Api/Response.php';
                break;
            default:
                include './App/Vue/error.php';
                break;
        }
    }
?>