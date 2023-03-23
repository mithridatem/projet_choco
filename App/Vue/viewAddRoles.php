<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <script src="./Public/Script/script.js" defer></script>
    <title>Add Roles</title>
</head>
<body>
    <h3>Ajouter un role :</h3>
    <form action="" method="post">
        <label for="nom_roles">Saisir un role :</label>
        <input type="text" name="nom_roles">
        <input type="submit" value="Ajouter" name="submit">
    </form>
    <div id="error"><?php echo $msg ?></div>
</body>
</html>