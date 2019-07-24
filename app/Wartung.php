<?php session_start();
require_once("../mysqldb.php");
?>
<html>
	<head>
		<link rel="stylesheet" href="../css/mainstyles.css">
	</head>
	<h1>Wartung</h1>	
	
	<form method=post>
	<?php
		$showSecTable=false;
		if(isset($_POST['auswahlKomponente0'])){
			if(!isset($_POST['id_selected'])){
				echo "Es wurde keine Komponente zum Ausmustern ausgewählt!";
			} else {		
			echo $_POST['id_selected'], " wird gewartet.";
			$showSecTable=true;
			}
		}	
		echo "<h3>Zu wartende Komponente auswählen</h3>";
		build_table_from_result(sql_komponente_list($mysqli, 0, 10));				
	?>	
	<input type='submit' name='auswahlKomponente0' value='Auswählen'>			
	<?php
		if($showSecTable){	
		echo "<h3>Mit folgender Kompnente austauschen:</h3>";
		build_table_from_result(sql_komponente_zum_austauschen_by_komponente($mysqli, $_POST['id_selected'], 0, 10));
		echo "<input type='submit' name='auswahlKomponente1' value='Komponente warten'>";
		}	
	?>
		
	
		
	</form>
	
	
</html>