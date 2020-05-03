<?php include './lib/affichage.php';
    $db = ouvrir_connexion();
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./CSS/style.css" media="all" type="text/css">
        <title>Top Modélisme</title>
    </head>
    <body>
        <div id="page">

            <div id="titre">
                <a href="."><img src="img/logo_500px.gif" alt="Logo" ></a>
                le leader du modélisme en ligne
            </div>

            <div id="authentification">
                
                <h1>Authentification</h1>
                <form method="POST" action="enregistrement_utilisateur.php"> 
                    <label for="pseudo">Pseudo</label>
                    <br>
                    <input type="text" name="pseudo">
                    <br>
                    <label for="mdp">Mot de passe</label>
                    <br>    
                    <input type="text" name="mdp">
                    <br>
                    <input type="submit" value="Se connecter" class="myButton" name="connecter">
                    <input type="submit" value="Créer un compte" class="myButton" name="creer">
                </form>

            </div>
            <div id="contenu">

                <?php 
                    if (isset($_GET['famille'])) { //si l'on clique sur une famille

                        afficher_articles($_GET['famille'], $db);

                        if (isset($_GET['commander'])) {

                            commander($_GET['article'], $db);
                            
                        }

                    }
                    else {

                        afficher_famille($db); 
                    }
                ?>

            </div>
            <div id="panier">

                <?php

                    afficher_panier($db);
                ?>

            </div>
            <div id="pied_de_page">

                TOPModelisme.com est enregistre au R.C.S. sous le numero 1234567890
                <br>13 avenue du Pre la Reine - 75007 Paris

            </div>
        </div>
    </body>
</html>

<?php
    fermer_connexion($db);
?>