<?php include './lib/fonctions.php';
 ?>

<?php
    function afficher_famille($db){

        
    
        $sql = 'SELECT libelle, image, id FROM famille ORDER BY ordre_affichage';
        $db = ouvrir_connexion($sql);
        $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));
    
        
        while ($data = mysqli_fetch_array($result)) { //tant qu'il y a des donnees a afficher
            echo '
            <table>
                <div class="famille">
                    <img class="image" src="./img_familles/'.$data['image'].'" height=120px >
                    <br>
                    <div class="libelle">
                        <a class="nounderline" href="?famille='.$data['id'].'">'.$data['libelle'].'<br></a>
                    </div>
                </div>
                
            </table>';
            
        }
    
        mysqli_close($db);
    }
?>

<?php
    function afficher_articles($famille,$db)
    {
    
        $sql = 'SELECT libelle, image, prix_ttc, id FROM article WHERE id_famille = '.$famille.' ORDER BY libelle'; //on affiche les articles dans l'ordre alphabetique
        $db = ouvrir_connexion($sql);
        $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));
    
        while ($data = mysqli_fetch_array($result)) {
            echo '
            <div class="article">
                <img class="image" src="./img_articles/'.$data['image'].'" height=50px >
                <div class="libelle">
                    <h2>'.$data['libelle'].'</h2>
                </div>
                <div class="prix">
                    <h3>'.$data['prix_ttc'].'</h3>
                </div>
                <div class="bouton">
                <a href="index.php?famille='.$famille.'&article='.$data['id'].'" class="myButton">Commander</a>
                </div>
            </div>';
    }
    
     
        mysqli_close($db);  
    }
?>


<?php 
    function afficher_panier($db){

        if(isset($_GET['vider_panier'])){ //si on clique sur le bouton pour vider le panier
            vider_panier($db);
        }

        echo '
        <div id="titre_panier">
        <img width="30px" src=./img/panier.gif>
        votre panier
        </div>';

        if (isset($_GET['article'])) //si on clique sur le bouton pour ajouter un article au panier
        {
            commander($_GET['article'],$db);
        }

        $sql = 'SELECT id_article, quantite, article.prix_ttc, libelle FROM panier_article 
                INNER JOIN article ON panier_article.id_article = article.id';

        $result = $db->query($sql);
        $data = mysqli_fetch_array($result);

        if(empty($data)) //si le panier est vide
        {
            echo '
            <div id="libelle_article">
            Votre panier est vide
            </div>';
        }
        else
        {
            $total = 0;
            do{ //boucle do et non while car si on utilise while, les articles seront ajoutes a partir du second au lieu du premier 

                $sous_total = $data['quantite'] * $data['prix_ttc'];
                $total += $sous_total; //pour avoir le total on somme tous les totaux de chaque articles multiplie par la quantite dans laquelle ils ont ete commandes
                echo '
                <div id="libelle_article">
                '.$data['libelle'].'
                </div>
                <div id="prix">
                '.$data['quantite'].' x '.$data['prix_ttc'].' = '.$sous_total.' €
                </div>';
               
            }while($data = mysqli_fetch_array($result));
            echo '
            <div id="total">
            TOTAL : '.$total.' €
            </div>
            <div class="bouton">
            <a href="index.php?vider_panier=1" class="myButton">Vider panier</a>
            <a href="index.php?finaliser_commande" class="myButton">Commander</a>
            </div>';
        }
        

    }
        
            
?>


