<?php
    session_start();
    require_once("../helpers/validate_access.php");
    require_once("../mysqldb.php");
    validate_access("Wartung");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mainstyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporting</title>
    <h1>Reporting</h1>
</head>
<body>
    <?php
        build_table_from_result(sql_komponente_list_reporting($mysqli, 0, 10));
    ?>
</body>
</html>