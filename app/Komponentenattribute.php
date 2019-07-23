<?php
session_start();
if ((! (isset($_SESSION["loggedin"]))) || (! $_SESSION["loggedin"]))
    die("not logged in");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komponentenattribute Verwaltung</title>
</head>
<body>
<?php
require_once("../mysqldb.php");

$kmpatr_bezeichnung = "";

$aendern_form = FALSE;

if (isset($_POST["btn_anlegen"]))
{
    $kmpatr_bezeichnung = $_POST["kmpatr_bezeichnung"];
   
	if (! ($kmpatr_bezeichnung))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_komponentenattribut_anlegen($mysqli, $kmpatr_bezeichnung);
}
if (isset($_POST["btn_update"]))
{
    $kmpatr_bezeichnung = $_POST["kmpatr_bezeichnung"];
    
	if (! ($kmpatr_bezeichnung && $_POST["id_to_update"]))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_komponentenattribut_update($mysqli, $_POST["id_to_update"], $kmpatr_bezeichnung);
}

if (isset($_POST["btn_duplizieren"]))
{
    $kmpatr_ausgewaehlt_result = (sql_komponentenattribut_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $kmpatr_bezeichnung = $kmpatr_ausgewaehlt_result["kat_bezeichnung"];
}
if (isset($_POST["btn_loeschen"]))
{
    sql_komponentenattribut_delete($mysqli, $_POST["id_selected"]);
}
if (isset($_POST["btn_bearbeiten"]))
{
    $aendern_form = TRUE;     
    $kmpatr_ausgewaehlt_result = (sql_komponentenattribut_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $kmpatr_bezeichnung = $kmpatr_ausgewaehlt_result["kat_bezeichnung"];
}
?>
<h1>Verwaltung Komponentenattribute</h1>
<form action="" method="post">
<?php 
build_table_from_result(sql_komponentenattribut_list($mysqli, 0, 10));
?>
<br/>
<input type="submit" name="btn_duplizieren" value="Duplizieren">
<input type="submit" name="btn_bearbeiten" value="Bearbeiten">
<input type="submit" name="btn_loeschen" value="Löschen">
</form>

<form action="" method="post">
<?php
if ($aendern_form)
    echo("<h1>Bearbeiten von ID: " . $_POST['id_selected'] . "</h1>");
else
    echo("<h1>Neuanlage</h1>");
?>
    <input type="text" name="kmpatr_bezeichnung" placeholder="kmpatr Bezeichnung" value="<?php echo($kmpatr_bezeichnung) ?>">
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
</body>
</html>

