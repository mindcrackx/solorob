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
    <title>Lieferanten Verwaltung</title>
</head>
<body>
<?php
require_once("../mysqldb.php");

$liefer_firmenname = "";
$liefer_strasse = "";
$liefer_plz = "";
$liefer_ort = "";
$liefer_tel = "";    
$liefer_mobil = "";
$liefer_fax = "";
$liefer_email = "";


$aendern_form = FALSE;

if (isset($_POST["btn_anlegen"]))
{
    $liefer_firmenname = $_POST["liefer_firmenname"];
    $liefer_strasse = $_POST["liefer_strasse"];
    $liefer_plz = $_POST["liefer_plz"];
    $liefer_ort = $_POST["liefer_ort"];
    $liefer_tel = $_POST["liefer_tel"];    
    $liefer_mobil = $_POST["liefer_mobil"];
    $liefer_fax = $_POST["liefer_fax"];
    $liefer_email = $_POST["liefer_email"];
    
    
    if (! ($liefer_firmenname))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_lieferant_anlegen($mysqli, $liefer_firmenname, $liefer_strasse, $liefer_plz, $liefer_ort, $liefer_tel, $liefer_mobil, $liefer_fax, $liefer_email);
}
if (isset($_POST["btn_update"]))
{
    $liefer_firmenname = $_POST["liefer_firmenname"];
    $liefer_strasse = $_POST["liefer_strasse"];
    $liefer_plz = $_POST["liefer_plz"];
    $liefer_ort = $_POST["liefer_ort"];
    $liefer_tel = $_POST["liefer_tel"];    
    $liefer_mobil = $_POST["liefer_mobil"];
    $liefer_fax = $_POST["liefer_fax"];
    $liefer_email = $_POST["liefer_email"];
    if (! ($liefer_firmenname))
    {
        echo("Nicht alle daten ausgefüllt");
    }
    sql_lieferant_update($mysqli, $_POST["id_to_update"], $liefer_firmenname, $liefer_strasse, $liefer_plz, $liefer_ort, $liefer_tel, $liefer_mobil, $liefer_fax, $liefer_email);
}

if (isset($_POST["btn_duplizieren"]))
{
    $liefer_ausgewaehlt_result = sql_lieferant_list_one($mysqli, $_POST["id_selected"])->fetch_assoc();
    $liefer_firmenname = $liefer_ausgewaehlt_result["l_firmenname"];
    $liefer_strasse = $liefer_ausgewaehlt_result["l_strasse"];
    $liefer_plz = $liefer_ausgewaehlt_result["l_plz"];
    $liefer_ort = $liefer_ausgewaehlt_result["l_ort"];
    $liefer_tel = $liefer_ausgewaehlt_result["l_tel"];
    $liefer_mobil = $liefer_ausgewaehlt_result["l_mobil"];
    $liefer_fax = $liefer_ausgewaehlt_result["l_fax"];;
    $liefer_email = $liefer_ausgewaehlt_result["l_email"];
}
if (isset($_POST["btn_loeschen"]))
{
    sql_lieferant_delete($mysqli, $_POST["id_selected"]);
}
if (isset($_POST["btn_bearbeiten"]))
{
    $aendern_form = TRUE;     
    $liefer_ausgewaehlt_result = sql_lieferant_list_one($mysqli, $_POST["id_selected"])->fetch_assoc();
    $liefer_firmenname = $liefer_ausgewaehlt_result["l_firmenname"];
    $liefer_strasse = $liefer_ausgewaehlt_result["l_strasse"];
    $liefer_plz = $liefer_ausgewaehlt_result["l_plz"];
    $liefer_ort = $liefer_ausgewaehlt_result["l_ort"];
    $liefer_tel = $liefer_ausgewaehlt_result["l_tel"];
    $liefer_mobil = $liefer_ausgewaehlt_result["l_mobil"];
    $liefer_fax = $liefer_ausgewaehlt_result["l_fax"];;
    $liefer_email = $liefer_ausgewaehlt_result["l_email"];
}
?>
<h1>Lieferant Verwaltung</h1>
<form action="" method="post">
<?php 
build_table_from_result(sql_lieferant_list($mysqli, 0, 10));
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
    <input type="text" name="liefer_firmenname" placeholder="liefer Name" value="<?php echo($liefer_firmenname) ?>">
    <br/>
    <input type="text" name="liefer_strasse" placeholder="liefer Strasse" value="<?php echo($liefer_strasse) ?>">
    <br/>
    <input type="text" name="liefer_plz" placeholder="liefer Plz" value="<?php echo($liefer_plz) ?>">
    <br/>
    <input type="text" name="liefer_ort" placeholder="liefer Ort" value="<?php echo($liefer_ort) ?>">
    <br/>
    <input type="text" name="liefer_tel" placeholder="liefer Tel" value="<?php echo($liefer_tel) ?>">
    <br/>
    <input type="text" name="liefer_mobil" placeholder="liefer Mobil" value="<?php echo($liefer_mobil) ?>">
    <br/>
    <input type="text" name="liefer_fax" placeholder="liefer Fax" value="<?php echo($liefer_fax) ?>">
    <br/>
    <input type="text" name="liefer_email" placeholder="liefer Email" value="<?php echo($liefer_email) ?>">
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
