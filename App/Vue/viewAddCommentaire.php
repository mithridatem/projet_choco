<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <script src="./Public/Script/script.js" defer></script>
    <title>Ajouter un commentaire</title>
</head>
<body>
    <!--import du menu -->
    <?php include './App/Vue/viewMenu.php';?>
    <section class="formContainer">
        <h3>Ajouter un Commentaire :</h3>
        <form action="" method="post">
            <label for="note_commentaire">Saisir votre note :</label>
            <input type="text" name="note_commentaire">
            <label for="text_commentaire">Saisir votre commentaire :</label>
            <input type="text" name="text_commentaire">
            <label for="date_commentaire">Saisir la date :</label>
            <input type="date" name="date_commentaire">
            <input type="submit" value="Ajouter" name="submit">
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