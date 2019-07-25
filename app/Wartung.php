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
<?php
require_once("../mysqldb.php");

$kompons = (sql_komponente_list($mysqli, 0,5));
build_table_from_result($kompons);
?>
<br>
<h3>Komponente, mit der getauscht werden soll:</h3>
<?php

$kompons = (sql_komponente_list($mysqli, 0,3));
build_table_from_result_2($kompons);
?>
<br>
<input type="submit" value="Austauschen">
</body>
</html>