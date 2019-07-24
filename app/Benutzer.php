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
    <title>Benutzer Verwaltung</title>
</head>
<body>
<?php
require_once("../mysqldb.php");
#print_r($raum_data->fetch_all(MYSQLI_ASSOC));

$benutzer_name = "";
$benutzer_vorname = "";
$benutzer_nickname = "";
$benutzer_password = "";
$benutzer_rechte_rolle_id = "";

$aendern_form = FALSE;

if (isset($_POST["btn_anlegen"]))
{
    $benutzer_name = $_POST["benutzer_name"];
    $benutzer_vorname = $_POST["benutzer_vorname"];
    $benutzer_nickname = $_POST["benutzer_nickname"];
    $benutzer_password = $_POST["benutzer_password"];
    $benutzer_rechte_rolle_id = $_POST["benutzer_rechte_rolle_id"];

    if (! ($benutzer_name && $benutzer_vorname && $benutzer_nickname && $benutzer_password && $benutzer_rechte_rolle_id))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_benutzer_anlegen($mysqli, $benutzer_name, $benutzer_vorname, $benutzer_nickname, $benutzer_password, $benutzer_rechte_rolle_id);
}
if (isset($_POST["btn_update"]))
{
    $benutzer_name = $_POST["benutzer_name"];
    $benutzer_vorname = $_POST["benutzer_vorname"];
    $benutzer_nickname = $_POST["benutzer_nickname"];
    $benutzer_password = $_POST["benutzer_password"];
    $benutzer_rechte_rolle_id = $_POST["benutzer_rechte_rolle_id"];

    if (! ($benutzer_name && $benutzer_vorname && $benutzer_nickname && $benutzer_password && $benutzer_rechte_rolle_id))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_benutzer_update($mysqli, $_POST["id_to_update"], $benutzer_name, $benutzer_vorname, $benutzer_nickname, $benutzer_password, $benutzer_rechte_rolle_id);
}

if (isset($_POST["btn_duplizieren"]))
{
    $benutzer_ausgewaehlt_result = (sql_benutzer_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $benutzer_name = $benutzer_ausgewaehlt_result["b_name"];
    $benutzer_vorname = $benutzer_ausgewaehlt_result["b_vorname"];
    $benutzer_nickname = $benutzer_ausgewaehlt_result["b_nickname"];
    $benutzer_password = ""; # kein pwdhash duplizieren
    $benutzer_rechte_rolle_id = $benutzer_ausgewaehlt_result["b_rechte_rolle_id"];
}
if (isset($_POST["btn_loeschen"]))
{
    sql_benutzer_delete($mysqli, $_POST["id_selected"]);
}
if (isset($_POST["btn_bearbeiten"]))
{
    $aendern_form = TRUE;     
    $benutzer_ausgewaehlt_result = (sql_benutzer_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $benutzer_name = $benutzer_ausgewaehlt_result["b_name"];
    $benutzer_vorname = $benutzer_ausgewaehlt_result["b_vorname"];
    $benutzer_nickname = $benutzer_ausgewaehlt_result["b_nickname"];
    $benutzer_password = ""; # kein pwdhash duplizieren
    $benutzer_rechte_rolle_id = $benutzer_ausgewaehlt_result["b_rechte_rolle_id"];
}
?>
<h1>Benutzer Verwaltung</h1>
<form action="" method="post">
<?php 
build_table_from_result(sql_benutzer_list($mysqli, 0, 10));
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
    <input type="text" name="benutzer_name" placeholder="Benutzer Name" value="<?php echo($benutzer_name) ?>">
    <br/>
    <input type="text" name="benutzer_vorname" placeholder="Benutzer Vorname" value="<?php echo($benutzer_vorname) ?>">
    <br/>
    <input type="text" name="benutzer_nickname" placeholder="Benutzer Nickname" value="<?php echo($benutzer_nickname) ?>">
    <br/>
    <input type="password" name="benutzer_password" placeholder="Benutzer Passwort" value="">
    <br/>
    <select name="benutzer_rechte_rolle_id">
        <?php
        $rechte_rollen = sql_rechte_rolle_list($mysqli);
        foreach ($rechte_rollen as $id => $name)
        {
            echo("<option value=" . $id . ">" . $name . "</option>");
        }
        ?>
    </select>
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

