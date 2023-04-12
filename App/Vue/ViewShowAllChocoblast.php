<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./Public/Script/script.js" defer></script>
    <title>All Chocoblast</title>
</head>
<body>
    <!--import du menu -->
    <?php include './App/Vue/viewMenu.php';?>
    <form class="filter" action="" method="post">
        <select name="filter">
            <option value="1">Date Croissant</option>
            <option value="2">Date Décroissant</option>
            <option value="3">Nom Croissant</option>
            <option value="4">Nom Décroissant</option>
        </select>
        <input type="submit" value="Filtrer" name="submit">
    </form>
    <section id="parent">
    <div class="chocoContainer">
        <?php 
            //Boucle pour afficher les chocoblasts
            foreach($chocos as $value){
        ?>
            <div class="choco">
                <p><?=$value->slogan_chocoblast?></p>
                <p>image here</p>
                <p><?=$value->nom_cible?></p>
                <p><?=$value->prenom_cible?></p>
                <p><?=$value->nom_auteur?></p>
                <p><?=$value->prenom_auteur?></p>
                <p><?=$value->date_chocoblast?></p>
                <div>
                    <a href="./chocoblastUpdate?id_chocoblast=<?=$value->id_chocoblast?>&id_cible=<?=$value->id_cible?>"><i class="fa-solid fa-pen"></i></a>
                    <a href="./chocoblastDelete?id_chocoblast=<?=$value->id_chocoblast?>"><i class="fa-solid fa-trash-can"></i></a> 
                    <a href="./commentaireAdd?id_chocoblast=<?=$value->id_chocoblast?>"><i class="fa-regular fa-comment"></i></a> 
                </div>
            </div>
        <?php    
            }
        ?>
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