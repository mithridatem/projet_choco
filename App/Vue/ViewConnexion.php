<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <script src="./Public/Script/script.js" defer></script>
    <title>Document</title>
</head>
<body>
     <!--import du menu -->
     <?php include './App/Vue/viewMenu.php';?>
     <div class="form">
        <form action="" method="post">
            <label for="mail_utilisateur">Saisir votre mail :</label>
            <input type="email" name="mail_utilisateur">
            <label for="password_utilisateur">Saisir votre mot de passe :</label>
            <input type="password" name="password_utilisateur">
            <input type="submit" value="Connexion" name="submit">
        </form>
        <div id="error"><?php echo $msg ?></div>
     </div>
</body>
</html>