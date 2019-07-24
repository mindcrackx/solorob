<?php
session_start();
require_once("../helpers/validate_access.php");
validate_access("Stammdatenverwaltung");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Räume Verwaltung</title>
    <style>
        body {
            font-family: "Lato", sans-serif;
        }
        h1 {
            color: steelblue;
        }
        table {
            border-collapse: collapse;
            border-style: hidden;
            border: 0;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            border: none;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:hover {background-color: rgb(102, 152, 192); color: white}
    </style>
</head>
<body>
<?php
if ((! (isset($_SESSION["loggedin"]))) || (! $_SESSION["loggedin"]))
    die("not logged in");
require_once("../mysqldb.php");

$raum_nr = "";
$raum_bezeichnung = "";
$raum_notiz = "";

$aendern_form = FALSE;

$first = 0;
$last = 20;
if (isset($_POST["btn_links"])){
    $first = $_POST["first"] - 20 + 1;
    $last = $_POST["last"] - 20 + 1;
}
if (isset($_POST["btn_rechts"])){
    $first = $_POST["first"] + 20;
    $last = $_POST["last"] + 20;
}

if ($first < 0)
    $first = 0;

if (isset($_POST["btn_anlegen"]))
{
    $raum_nr = $_POST["raum_nr"];
    $raum_bezeichnung = $_POST["raum_bezeichnung"];
    $raum_notiz = $_POST["raum_notiz"];
    if (! ($raum_nr && $raum_bezeichnung))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_raeume_create($mysqli, $raum_nr, $raum_bezeichnung, $raum_notiz);
}
if (isset($_POST["btn_update"]))
{
    $raum_nr = $_POST["raum_nr"];
    $raum_bezeichnung = $_POST["raum_bezeichnung"];
    $raum_notiz = $_POST["raum_notiz"];
    if (! ($raum_nr && $raum_bezeichnung))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_raeume_update($mysqli, $_POST["id_to_update"], $raum_nr, $raum_bezeichnung, $raum_notiz);
}

if (isset($_POST["btn_duplizieren"]))
{
    $raum_ausgewaehlt_result = (sql_raeume_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $raum_nr = $raum_ausgewaehlt_result["r_nr"];
    $raum_bezeichnung = $raum_ausgewaehlt_result["r_bezeichnung"];
    $raum_notiz = $raum_ausgewaehlt_result["r_notiz"];
}
if (isset($_POST["btn_loeschen"]))
{
    sql_raeume_delete($mysqli, $_POST["id_selected"]);
}
if (isset($_POST["btn_bearbeiten"]))
{
    $aendern_form = TRUE;     
    $raum_ausgewaehlt_result = (sql_raeume_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $raum_nr = $raum_ausgewaehlt_result["r_nr"];
    $raum_bezeichnung = $raum_ausgewaehlt_result["r_bezeichnung"];
    $raum_notiz = $raum_ausgewaehlt_result["r_notiz"];
}
?>
<h1>Raum Verwaltung</h1>
<form action="" method="post">
<?php 
build_table_from_result(sql_raeume_list($mysqli, $first, $last));
?>
<br/>
<input type="hidden" name="first" value="<?php echo $first ?>">
<input type="hidden" name="last" value="<?php echo $last ?>">
<?php
echo('<input type="submit" name="btn_links" value="<" size="5"');
if ($first === 0)
    echo(" disabled");
echo(">");
?>
<input type="submit" name="btn_rechts" value=">" size="5">
<br/>
<input type="submit" name="btn_duplizieren" value="Duplizieren">
<input type="submit" name="btn_bearbeiten" value="Bearbeiten">
<input type="submit" name="btn_loeschen" value="Löschen">
</form>

<div class="createbot">
<form action="" method="post">
<?php
if ($aendern_form)
    echo("<h1>Bearbeiten von ID: " . $_POST['id_selected'] . "</h1>");
else
    echo("<h1>Neuanlage</h1>");
?>
    <input type="text" name="raum_nr" placeholder="Raum Nummer" value="<?php echo($raum_nr) ?>">
    <br/>
    <input type="text" name="raum_bezeichnung" placeholder="Raum Bezeichnung" value="<?php echo($raum_bezeichnung) ?>">
    <br/>
    <input type="text" name="raum_notiz" placeholder="Raum Notiz" value="<?php echo($raum_notiz) ?>">
    <br/>
<?php
if ($aendern_form)
{
    echo("<input type='hidden' name='id_to_update' value='" . $_POST['id_selected'] . "'>");
    echo("<br/>");
    echo('<input type="submit" name="btn_update" value="Ändern">');
}
else
    echo('<input type="submit" name="btn_anlegen" value="Anlegen">');
?>
</form>
</div>
</body>
</html>
