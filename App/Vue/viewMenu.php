<?php
    //Test si connecté 
    if(isset($_SESSION['connected'])){
?>  
    <!-- connecté -->
    <div id="navbar">
        <li><a href="./">Home</a></li>
        <li><a href="./chocoblastAdd">Ajouter chocoblast</a></li>
        <li><a href="./chocoblastAll">Afficher chocoblast</a></li>
        <li><a href="./rolesAdd">Ajouter Role</a></li>
        <li><a href="./deconnexion">Déconnexion</a></li>
    </div>
<?php
    }
    //Test sinon non connecté
    else{
?>
    <!-- déconnecté -->
    <div id="navbar">
        <li><a href="./">Home</a></li>
        <li><a href="./userAdd">Inscription</a></li>
        <li><a href="./chocoblastAll">Afficher chocoblast</a></li>
        <li><a href="./connexion">Connexion</a></li>
    </div>
<?php
    }
?>
