<?php
session_start();
require_once("../helpers/validate_access.php");
validate_access("Wartung");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/mainstyles.css">
    <title>Ausmusterung</title>
</head>
<body>
    <h1>Komponente Warten</h1>
    <h3>Komponente die ausgetauscht werden muss:</h3>
	<form method=post>
    <?php
    require_once("../mysqldb.php");
    $showSecTable=false;

    if(isset($_POST['auswahl']))
    {
        if(!isset($_POST['id_selected']))
        {
            echo "Es wurde keine Komponente zum Ausmustern ausgewählt!";
        }
        else
        {
            echo $_POST['id_selected'], " wird gewartet.";
            $showSecTable=true;
        }
    }	
    echo "<h3>Zu wartende Komponente auswählen</h3>";
    build_table_from_result(sql_komponente_list($mysqli, 0, 10));	
    ?>

    <input type="submit" name="auswahl" value="Auswählen">
</form>
</body>
</html>