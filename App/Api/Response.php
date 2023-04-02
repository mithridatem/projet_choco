<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
    //import du fichier de configuration
    include './env.php';
    require_once('./vendor/autoload.php');
    //Construction du header
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Content-Type: application/json');
    //Test si le token existe 
    if(!isset($_SERVER['HTTP_AUTHORIZATION'])){
        //Réponse
        header('HTTP/1.0 400 Bad Request');
        die(json_encode(['Error : '=>'Token not found in request']));
    }
    // Extraction du token
    if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
        //Réponse
        header('HTTP/1.0 400 Bad Request');
        exit;
    }
    //Vérification du token
    try {
        //Récupération  du token
        $jwt = $matches[1];
        $serverName = "your.domain.name";
        $username   = "username"; 
        //Décodage du token
        $token = JWT::decode($jwt, new Key($secretKey, 'HS512'));
            //Réponse
            header('HTTP/1.1 200 Authorized');
            header('Content-Type: application/json');
            echo json_encode(['Valide :'=>'Token valide']);
    }
    //Lever une exception
    catch (\Throwable $th) {
        //Réponse
        header('HTTP/1.1 401 Unauthorized');
        header('Content-Type: application/json');
        die(json_encode(['erreur :'=>$th->getMessage()]));
    }
?>