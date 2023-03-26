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
    <title>Add Roles</title>
</head>
<body>
    <!--import du menu -->
    <?php include './App/Vue/viewMenu.php';?>
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
                    <i class="fa-solid fa-pen"></i>
                    <i class="fa-solid fa-trash-can"></i> 
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