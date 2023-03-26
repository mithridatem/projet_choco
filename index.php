<?php
    //Démarrage de la session
    session_start();
    //Importer les ressources
    use App\Controller\UserController;
    use App\Controller\RolesController;
    use App\Controller\ChocoblastController;
    include './App/Utils/BddConnect.php';
    include './App/Utils/Fonctions.php';
    include './App/Model/Roles.php';
    include './App/Controller/RolesController.php';
    include './App/Model/Utilisateur.php';
    include './App/Controller/UserController.php';
    include './App/Model/Chocoblast.php';
    include './App/Controller/ChocoblastController.php';

    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    $rolesController = new RolesController();
    $chocoblastController = new ChocoblastController();
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
                $chocoblastController->inserChocoblast();
                break;
            case '/projet/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/projet/deconnexion':
                $userController->deconnexionUser();
                break;
            default:
                include './App/Vue/error.php';
                break;
            }
    }
    //routeur déconnecté
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
        case '/projet/connexion':
            $userController->connexionUser();
            break;
        default:
            include './App/Vue/error.php';
            break;
    }
}
    //routeur non connecté

?>