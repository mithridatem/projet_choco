<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <script src="./Public/Script/script.js" defer></script>
    <title>Ajouter un Utilisateur</title>
</head>
<body>
    <!--import du menu -->
    <?php include './App/Vue/viewMenu.php';?>
    <div class="form">
        <h3>Ajouter un compte utilisateur :</h3>
        <form action="" method="post">
            <label for="nom_utilisateur">saisir votre nom :</label>
            <input type="text" name="nom_utilisateur">
            <label for="prenom_utilisateur">saisir votre prénom :</label>
            <input type="text" name="prenom_utilisateur">
            <label for="mail_utilisateur">saisir votre mail :</label>
            <input type="email" name="mail_utilisateur">
            <label for="password_utilisateur">saisir votre mot de passe :</label>
            <input type="password" name="password_utilisateur">
            <input type="submit" value="Ajouter" name="submit">
        </form>
        <div id="error"><?php echo $msg; ?></div>
    </div>
</body>
</html>