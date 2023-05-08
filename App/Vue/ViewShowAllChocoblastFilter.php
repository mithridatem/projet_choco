<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/Style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./Public/Script/script.js" defer></script>
    <script src="./Public/Script/script2.js" defer></script>
    <title>All Chocoblast</title>
</head>

<body>
    <!--import du menu -->
    <?php include './App/Vue/viewMenu.php'; ?>
    <div id="filter">
        <div>
            Date Croissant : 
            <input type="checkbox" name="choco[]" id="1" value="1" class="choco">
        </div>
        <div>
            Date Décroissant : 
            <input type="checkbox" name="choco[]" id="2" value="2" class="choco">
        </div>
        <div>
            Nom Croissant : 
            <input type="checkbox" name="choco[]" id="3" value="3" class="choco">
        </div>
        <div>
            Nom Décroissant : 
            <input type="checkbox" name="choco[]" id="4" value="4" class="choco">
        </div>
    </div>
    <div id="resul"></div>
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