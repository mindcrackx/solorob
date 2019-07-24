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
    <link rel="stylesheet" href="../css/mainstyles.css">
    <title>Ausmusterung</title>
</head>
<body>
    <h1>Komponente Ausmustern</h1>
<?php
require_once("../mysqldb.php");

$pagination_step = 10;
$first = 0;
$last = $pagination_step;
if (isset($_POST["btn_links"])){
    $first = $_POST["first"] - $pagination_step;
    $last = $_POST["last"] - $pagination_step;
}
if (isset($_POST["btn_rechts"])){
    $first = $_POST["first"] + $pagination_step;
    $last = $_POST["last"] + $pagination_step;
}
if ($first < 0)
    $first = 0;

$kompons = (sql_komponente_list($mysqli, $first, $last));
build_table_from_result($kompons);
?>
<br/>
<form action="" method="post">
    <input type="hidden" name="first" value="<?php echo $first ?>">
    <input type="hidden" name="last" value="<?php echo $last ?>">
    <?php
    echo('<input type="submit" name="btn_links" value="<" size="5"');
    if ($first === 0)
        echo(" disabled");
    echo(">");
    ?>
    <input type="submit" name="btn_rechts" value=">" size="5">
</form>
<br/>
<input type="submit" value="Ausmustern">
</body>
</html>