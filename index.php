<?php
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    //routeur
    switch ($path) {
        case '/projet/':
            include './App/Vue/home.php';
            break;
        case '/projet/addUser':
            include './App/Vue/viewAddUser.php';
        default:
            include './App/Vue/error.php';
            break;
    }
?>