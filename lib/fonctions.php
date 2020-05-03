<?php include './lib/requetes.php'
 ?>

<?php
	function commander($article, $db){
		
        $sql = 'SELECT id_article, quantite, prix_ttc FROM panier_article WHERE id_article='.$article.' ';
        $data = executer_requete($sql,$db);
        if (!empty($data)){ //si l'article a deja ete commande
        	$sql = 'UPDATE panier_article SET quantite = quantite+1 WHERE id_article='.$article.''; //il suffit d'incrémenter la quantite
        }
        else
        {
        	$sql = 'INSERT INTO panier_article VALUES (1, '. $article .', 1, 0, 0,  0);'; //sinon on cree l'article dans le panier
        }
        $result = $db->query($sql) or die ('Erreur SQL : '.mysqli_error($db));
		
	}
?>

<?php
	function vider_panier($db){
		if (isset($_GET['vider_panier'])){
			$sql = 'DELETE FROM panier_article
			WHERE id_panier=1';
			$db->query($sql);
		}
	}
?>