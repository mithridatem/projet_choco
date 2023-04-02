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
                
    
    $issuedAt   = new \DateTimeImmutable();
    $expire     = $issuedAt->modify('+1 minutes')->getTimestamp();      // Add 60 seconds
    $serverName = "your.domain.name";
    $username   = "username";                                           // Retrieved from filtered POST data

    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
        'iss'  => $serverName,                       // Issuer
        'nbf'  => $issuedAt->getTimestamp(),         // Not before
        'exp'  => $expire,                           // Expire
        'userName' => $username,                     // User name
    ];
    echo JWT::encode(
        $data,
        $secretKey,
        'HS512'
    );
?>