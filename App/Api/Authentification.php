<?php
use Firebase\JWT\JWT;
    //import du fichier de configuration
    include './env.php';
    require_once('./vendor/autoload.php');
    //Construction du header
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Content-Type: application/json');
    header('Accept: application/json');
                
    //Variable pour le token
    $issuedAt   = new \DateTimeImmutable();
    $expire     = $issuedAt->modify('+1 minutes')->getTimestamp();
    $serverName = "your.domain.name";
    $username   = "username";
    //Contenu du token
    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Timestamp génération du token
        'iss'  => $serverName,                       // Serveur
        'nbf'  => $issuedAt->getTimestamp(),         // Timestamp empécher date antérieure
        'exp'  => $expire,                           // Timestamp expiration du token
        'userName' => $username,                     // Nom utilisateur
    ];
    //retourne le JWT token encode
    echo JWT::encode(
        $data,
        $secretKey,
        'HS512'
    );
?>