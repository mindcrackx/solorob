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
    <title>Komponentenarten Verwaltung</title>
</head>
<body>
<?php
require_once("../mysqldb.php");

$kompart_name = "";

$aendern_form = FALSE;

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



if (isset($_POST["btn_anlegen"]))
{
    $darf_anlegen = TRUE;
    $kompart_name = $_POST["kompart_name"];
    if (! $kompart_name)
    {
        $darf_anlegen = FALSE;
        echo("Nicht alle Formularfelder wurden ausgefüllt");
    }
    # search listbox for ids
    $kompattr_ids_selected = array();
    foreach ($_POST as $key => $value)
    {
        $split = preg_split("/^kompattr_id_/", $key);
        if (isset($split[1]))
            $kompattr_ids_selected[] = $split[1];
    }
    # komponentenart anlegen
    $new_kompart_id = sql_komponentenart_anlegen($mysqli, $kompart_name);

    if ($darf_anlegen)
    {
        foreach ($kompattr_ids_selected as $kompattr_id)
        {
            sql_komponentenart_komponentenattribut_verknüpfen($mysqli, $new_kompart_id, $kompattr_id);
        }
        echo("Erfolgreich angelegt");
    }
}
if (isset($_POST["btn_update"]))
{
    $darf_updaten = TRUE;
    $kompart_id = $_POST["id_to_update"];
    $kompart_name = $_POST["kompart_name"];
    if (! ($kompart_name && $kompart_id))
    {
        $darf_anlegen = FALSE;
        echo("Nicht alle Formularfelder wurden ausgefüllt");
    }
    # search listbox for ids
    $kompattr_ids_selected = array();
    foreach ($_POST as $key => $value)
    {
        $split = preg_split("/^kompattr_id_/", $key);
        if (isset($split[1]))
            $kompattr_ids_selected[] = $split[1];
    }

    if ($darf_updaten)
    {
        # komponentenart updaten
        sql_komponentenart_update($mysqli, $kompart_id, $kompart_name);

        #bisherigen wbd löschen
        sql_komponentenart_delete_wird_beschrieben_durch($mysqli, $kompart_id);

        # wdb wieder anlegen
        foreach ($kompattr_ids_selected as $kompattr_id)
        {
            sql_komponentenart_komponentenattribut_verknüpfen($mysqli, $kompart_id, $kompattr_id);
        }
        echo("Erfolgreich geändert");
    }
}

if (isset($_POST["btn_duplizieren"]))
{
    $kompart_ausgewaehlt_result = (sql_komponentenart_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $kompart_name = $kompart_ausgewaehlt_result["ka_komponentenart"];
    $kompart_wbd_result = (sql_komponentenart_get_wird_beschrieben_durch($mysqli, $_POST["id_selected"]))->fetch_all(MYSQLI_ASSOC);
}
if (isset($_POST["btn_loeschen"]))
{
    sql_komponentenart_delete_wird_beschrieben_durch($mysqli, $_POST["id_selected"]);
    sql_komponentenart_delete($mysqli, $_POST["id_selected"]);
}
if (isset($_POST["btn_bearbeiten"]))
{
    $aendern_form = TRUE;     
    $kompart_ausgewaehlt_result = (sql_komponentenart_list_one($mysqli, $_POST["id_selected"]))->fetch_assoc();
    $kompart_name = $kompart_ausgewaehlt_result["ka_komponentenart"];
    $kompart_wbd_result = (sql_komponentenart_get_wird_beschrieben_durch($mysqli, $_POST["id_selected"]))->fetch_all(MYSQLI_ASSOC);
}
?>
<h1>Komponentenarten Verwaltung</h1>
<form action="" method="post">
<?php 
build_table_from_result(sql_komponentenart_list($mysqli, $first, $last));
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
    <input type="text" name="kompart_name" placeholder="Komponentenart Name" value="<?php echo($kompart_name) ?>">
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
<?php
# show komponentenattribute for linking to komponentenart in tbl_wird_beschrieben_durch
    $result = sql_komponentenattribut_list_all($mysqli);
    $prefix = "kompattr_id_";

    $is_first = TRUE;
    $found_wdb = FALSE;
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        while ($row = mysqli_fetch_assoc($result))
        {
            $found_wdb = FALSE;
            echo("<tr>");
            if ($is_first)
            {
                echo("<td>x</td>");
                foreach ($row as $key=>$value)
                {
                    echo("<td>$key</td>");
                }
                echo("</tr>");
                echo("<tr>");
            }
            foreach ($row as $value)
            {
               $row_id = $value;
               break;
            }
            if (isset($kompart_wbd_result))
            {
                foreach ($kompart_wbd_result as $wdb)
                {
                    if ($wdb["komponentenattribute_kat_id"] === $row["kat_id"])
                    {
                        echo("<td><input type='checkbox' name='" . $prefix . $row_id . "' checked></td>");
                        $found_wdb = TRUE;
                    }
                }
                if (! $found_wdb)
                    echo("<td><input type='checkbox' name='" . $prefix . $row_id . "'></td>");
            }
            else
                echo("<td><input type='checkbox' name='" . $prefix . $row_id . "'></td>");
            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</tr>");
            $is_first = FALSE;
        }
        echo("</table>");
    }
?>
</form>
</body>
</html>
