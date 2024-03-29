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
    <link rel="stylesheet" href="../css/mainstyles.css">
    <title>Benutzer Verwaltung</title>
</head>
<body>
<?php
require_once("../mysqldb.php");

$pagination_step = 10;
$first = 0;
$last = $pagination_step;

if (isset($_POST["first"]))
    $first = $_POST["first"];

if (isset($_POST["btn_links"]))
    $first = $_POST["first"] - $pagination_step;

if (isset($_POST["btn_rechts"]))
    $first = $_POST["first"] + $pagination_step;

if ($first < 0)
    $first = 0;

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
    if (sql_benutzer_check_nickname_unique($mysqli, $benutzer_nickname))
    {
        sql_benutzer_anlegen($mysqli, $benutzer_name, $benutzer_vorname, $benutzer_nickname, $benutzer_password, $benutzer_rechte_rolle_id);
        echo("Benutzer erfolgreich angelegt");
    }
    else
        echo("Nickname schon vergeben");

    
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
build_table_from_result(sql_benutzer_list($mysqli, $first, $last));
?>
<br/>
    <input type="hidden" name="first" value="<?php echo $first ?>">
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

<?php
if ($aendern_form)
    echo("<h1>Bearbeiten von ID: " . $_POST['id_selected'] . "</h1>");
else
    echo("<h1>Neuanlage</h1>");
?>
    <input type="text" name="benutzer_name" placeholder="Name" value="<?php echo($benutzer_name) ?>">
    <br/>
    <input type="text" name="benutzer_vorname" placeholder="Vorname" value="<?php echo($benutzer_vorname) ?>">
    <br/>
    <input type="text" name="benutzer_nickname" placeholder="Nickname" value="<?php echo($benutzer_nickname) ?>">
    <br/>
    <input type="password" name="benutzer_password" placeholder="Passwort" value="">
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
</div>
</body>
</html>

