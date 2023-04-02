<?php
    use Firebase\JWT\JWT;
    use App\Model\Utilisateur;
    use App\Utils\Fonctions;
    //Construction du header
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Content-Type: application/json');
    header('Accept: application/json');
    //Récupération des informations de connexion
    if(isset($_REQUEST['mail']) AND $_REQUEST['pwd']){
        //Instance d'un objet utilisateur
        $user = new Utilisateur();
        $user->setMailUtilisateur(Fonctions::cleanInput($_REQUEST['mail']));
        $user->setPasswordUtilisateur(Fonctions::cleanInput($_REQUEST['pwd']));
        $data = $user->getUserByMail();
        //Test si le compte existe
        if($data){
            //Vérification du password
            if(password_verify($user->getPasswordUtilisateur(), $data[0]->password_utilisateur)){
                include './env.php';
                require_once('./vendor/autoload.php');
                //Variable pour le token
                $issuedAt   = new \DateTimeImmutable();
                $expire     = $issuedAt->modify('+1 minutes')->getTimestamp();
                $serverName = "your.domain.name";
                $username   = $data[0]->nom_utilisateur;
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
            }
            //Test password incorrect
            else{
                //Réponse
                header('HTTP/1.1 401 Unauthorized');
                header('Content-Type: application/json');
                echo json_encode(['Erreur : '=>'Informations connexion invalides']);
            }
        }
        //Test si le compte n'existe pas
        else{
            //Réponse
            header('HTTP/1.1 401 Unauthorized');
            header('Content-Type: application/json');
            echo json_encode(['Erreur : '=>'Informations connexion invalides']);
        }
    }
    //Test si les informations de connexion n'existe pas
    else{
        //Réponse
        header('HTTP/1.1 401 Unauthorized');
        header('Content-Type: application/json');
        echo json_encode(['Erreur : '=>'Miss information connexion']);
    }            
?>