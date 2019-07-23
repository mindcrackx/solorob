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
    <title>Neubeschaffung</title>
</head>
<body>
<?php
require_once("../mysqldb.php");

$komp_bezeichnung = "";
$komp_gewaehrleistungsdauer = "";
$komp_hersteller = "";
$komp_notiz = "";
$komp_einkaufsdatum = date("Y-m-d");
$komp_raeume_r_id = "";
$komp_lieferant_l_id = "";
$komp_komponentenarten_ka_id = "";

$btn_step_1_pressed = FALSE;

if (isset($_POST["btn_step_1"]))
{
    $komp_bezeichnung = $_POST["komp_bezeichnung"];
    $komp_gewaehrleistungsdauer = $_POST["komp_gewaehrleistungsdauer"];
    $komp_hersteller = $_POST["komp_hersteller"];
    $komp_notiz = $_POST["komp_notiz"];
    $komp_einkaufsdatum = $_POST["komp_einkaufsdatum"];
    $komp_raeume_r_id = $_POST["komp_raeume_r_id"];
    $komp_lieferant_l_id = $_POST["komp_lieferant_l_id"];
    $komp_komponentenarten_ka_id = $_POST["komp_komponentenarten_ka_id"];

    $btn_step_1_pressed = TRUE;
}

if (isset($_POST["btn_anlegen"]))
{
    $komp_bezeichnung = $_POST["komp_bezeichnung"];
    $komp_gewaehrleistungsdauer = $_POST["komp_gewaehrleistungsdauer"];
    $komp_hersteller = $_POST["komp_hersteller"];
    $komp_notiz = $_POST["komp_notiz"];
    $komp_einkaufsdatum = $_POST["komp_einkaufsdatum"];
    $komp_raeume_r_id = $_POST["komp_raeume_r_id"];
    $komp_lieferant_l_id = $_POST["komp_lieferant_l_id"];
    $komp_komponentenarten_ka_id = $_POST["komp_komponentenarten_ka_id"];

    $btn_step_1_pressed = TRUE;
    
    $komponentenattribute_form = array();
    $komponentenattribute_sql = (sql_komponentenattribute_by_komponentenart($mysqli, $komp_komponentenarten_ka_id));
    $no_insert = FALSE;
    foreach ($komponentenattribute_sql as $kompattribut)
    {
        $tmp_str = "kompattribut_" . $kompattribut["kat_id"];
        $wert = $_POST[$tmp_str];
        if (empty(trim($wert)))
        {
            $no_insert = TRUE;
            echo("Alle Werte im Formular müssen ausgefüllt werden");
            break;
        }
        $komponentenattribute_form[$kompattribut["kat_id"]] = $wert;
    }
    print_r($komponentenattribute_form);
    if (! $no_insert)
    {
        sql_komponente_anlegen(
            $mysqli,
            $komp_bezeichnung,
            $komp_raeume_r_id,
            $komp_lieferant_l_id,
            $komp_einkaufsdatum,
            $komp_gewaehrleistungsdauer,
            $komp_notiz,
            $komp_hersteller,
            $komp_komponentenarten_ka_id
        );
        foreach ($komponentenattribute_form as $id => $value)
        {

        }
        echo("erfolgreich angelegt");
    }
}

?>
<!-- Formular step_1 -->
<h1>Komponenten Neubeschaffung</h1> <input type="submit" value="Duplizieren">
<form action="" method="post">
    <h3>Komponenten Neuanlage</h3>
    <input type="text" name="komp_bezeichnung" placeholder="Komponenten Bezeichnung" value="<?php echo($komp_bezeichnung)?>">

    <select name="komp_lieferant_l_id">
        <?php
        $lieferanten = (sql_lieferant_list_all($mysqli))->fetch_all(MYSQLI_ASSOC);
        foreach ($lieferanten as $lieferant)
        {
            echo("<option value=" . $lieferant["l_id"] . ">" . $lieferant["l_firmenname"] . "</option>");
        }
        ?>
    </select>
    <br/>
    <input type="text" name="komp_gewaehrleistungsdauer" placeholder="Komponenten Gewährleistungsdauer" value="<?php echo($komp_gewaehrleistungsdauer)?>">

     <select name="komp_raeume_r_id">
        <?php
        $raeume = (sql_raeume_list_all($mysqli))->fetch_all(MYSQLI_ASSOC);
        foreach ($raeume as $raum)
        {
            echo("<option value=" . $raum["r_id"] . ">" . $raum["r_nr"] . " - " . $raum["r_bezeichnung"] . "</option>");
        }
        ?>
    </select>
    <br/>
    <input type="text" name="komp_notiz" placeholder="Komponenten Notiz" value="<?php echo($komp_notiz)?>">
     <select name="komp_komponentenarten_ka_id">
        <?php
        $komponentenarten = (sql_komponentenart_list_all($mysqli))->fetch_all(MYSQLI_ASSOC);
        foreach ($komponentenarten as $kompart)
        {
            echo("<option value=" . $kompart["ka_id"] . ">" . $kompart["ka_komponentenart"] . "</option>");
        }
        ?>
    </select>
    <br/>
    <input type="text" name="komp_hersteller" placeholder="Komponenten Hersteller" value="<?php echo($komp_hersteller)?>">
    <input type="date" name="komp_einkaufsdatum" placeholder="Komponenten Einkaufsdatum" value="<?php echo($komp_einkaufsdatum)?>">
    <br/>
    <input type="submit" name="btn_step_1" value="Weiter">

    <br/><br/>

    
    <?php
    $komponentenattribute = (sql_komponentenattribute_by_komponentenart($mysqli, $komp_komponentenarten_ka_id));
    echo("<table border='1'>");
    foreach ($komponentenattribute as $kompattribut)
    {
        echo("<tr>");
        echo("<td>" . $kompattribut['kat_bezeichnung'] . "</td>");
        echo("<td><input type='text' name='kompattribut_" . $kompattribut["kat_id"] . "' value=''></td>");
        echo("</tr>");
    }
    echo("</table>");
    ?>
    <input type="submit" name="btn_anlegen" value="Anlegen">
</form>
</body>
</html>

