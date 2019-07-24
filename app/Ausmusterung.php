<?php
session_start();
require_once("../helpers/validate_access.php");
validate_access("Ausmusterung");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ausmusterung</title>
</head>
<body>
    <h1>Komponente Ausmustern</h1>
<?php
require_once("../mysqldb.php");

$kompons = (sql_komponente_list($mysqli, 0,100));
build_table_from_result($kompons);
?>
<input type="submit" value="Ausmustern">
</body>
</html>