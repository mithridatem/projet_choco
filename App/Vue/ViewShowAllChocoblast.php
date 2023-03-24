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
    <!--import du menu -->
    <?php include './App/Vue/viewMenu.php';?>
    <div class="form">
        <?php 
            //Boucle pour afficher les chocoblasts
            foreach($chocos as $value){
                echo '<div class="choco">
                    <h3>'.$value->slogan_chocoblast.'</h3>
                    <p>'.$value->date_chocoblast.'</p>
                    <h3>Auteur : </h3>
                    <p>'.$value->nom_auteur.'</p>
                    <p>'.$value->prenom_auteur.'</p>
                    <h3>Cible : </h3>
                    <p>'.$value->nom_cible.'</p>
                    <p>'.$value->prenom_cible.'</p>
                </div>';
            }
        ?>
        <div id="error"><?php echo $msg ?></div>
    </div>
</body>
</html>