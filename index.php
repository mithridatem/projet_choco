<?php
    //démarrage de la session
    session_start();
    //importer les ressources
    use App\Controller\UserController;
    use App\Controller\RolesController;
    include './App/Utils/BddConnect.php';
    include './App/Utils/Fonctions.php';
    include './App/Model/Roles.php';
    include './App/Controller/RolesController.php';
    include './App/Model/Utilisateur.php';
    include './App/Controller/UserController.php';

    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    $rolesController = new RolesController();
    //instancier le controller roles

    //routeur
    switch ($path) {
        case '/projet/':
            include './App/Vue/home.php';
            break;
        case '/projet/userAdd':
            //appel de la fonction insertUser
            $userController->insertUser();
            break;
        case '/projet/rolesAdd':
            //appel de la fonction insertRoles
            $rolesController->insertRoles();
            break;
        case '/projet/connexion':
            $userController->connexionUser();
            break;
        case '/projet/deconnexion':
        $userController->deconnexionUser();
        break;
        default:
            include './App/Vue/error.php';
            break;
    }
?>