<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <script src="./Public/Script/script.js" defer></script>
    <title>Connexion</title>
</head>
<body>
     <!--import du menu -->
     <?php include './App/Vue/viewMenu.php';?>
     
     <section class="formContainer">
     <h3>Connexion :</h3>
        <form action="" method="post">
            <label for="mail_utilisateur">Saisir votre mail :</label>
            <input type="email" name="mail_utilisateur">
            <label for="password_utilisateur">Saisir votre mot de passe :</label>
            <input type="password" name="password_utilisateur">
            <input type="submit" value="Connexion" name="submit">
        </form>
    </section>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p><?= $msg ?></p>
        </div>
    </div>
</body>
</html>