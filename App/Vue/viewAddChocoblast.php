<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <script src="./Public/Script/script.js" defer></script>
    <title>Add Chocoblast</title>
</head>
<body>
    <!-- Import du menu -->
    <?php include './App/Vue/viewMenu.php'; ?>
    <div class="form">
        <form action="" method="post">
            <label for="slogan_chocoblast">Saisir votre slogan :</label>
            <input type="text" name="slogan_chocoblast">
            <label for="date_chocoblast">Saisir la date :</label>
            <input type="date" name="date_chocoblast">
            <label for="cible_chocoblast">Choisir votre cible :</label>
            <select name="cible_chocoblast">
                <!-- générer la liste des utilisateur en PHP -->
            </select>
            <input type="submit" value="Ajouter" name="submit">
        </form>
    </div>
</body>
</html>