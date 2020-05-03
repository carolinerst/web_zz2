<?php
	function ouvrir_connexion(){
		
		$db = mysqli_connect('localhost', 'root', '', 'vente_en_ligne') or die ('Erreur SQL : '. mysqli_error($db));
        $db->query('SET NAMES UTF8');

        return $db;
	}
?>

<?php
	function executer_requete($sql, $db){
		
		$result = $db->query($sql) or die ('Erreur SQL : '.mysqli_error($db));
		$data = mysqli_fetch_array($result);

        return $data;
	}
?>

<?php
	function fermer_connexion($db){
		
		mysqli_close($db);
	}
?>
