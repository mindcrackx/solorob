<?php
$mysqli = new mysqli("10.10.20.20", "admin", "adminadmin", "solorob_db");
// $mysqli = new mysqli("127.0.0.1", "admin", "adminadmin", "solorob_db");
if ($mysqli->connect_error){
    echo "Failed to connect to MySQL: (" . $mysqli->connect_error . ") " . $mysqli->connect_error;
}
$mysqli->query("set names utf8");
#echo $mysqli->host_info . "\n";

require_once("solorob_db_helpers/raeume.php");
require_once("solorob_db_helpers/lieferant.php");
require_once("solorob_db_helpers/benutzer.php");
require_once("solorob_db_helpers/komponentenart.php");
require_once("solorob_db_helpers/komponentenattribut.php");
require_once("solorob_db_helpers/komponente.php");

function display_sql_results($result)
{
    $is_first = TRUE;
    $row_count = mysqli_num_rows($result);
    echo("Anzahl Datensätze: $row_count");
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        while ($row = mysqli_fetch_assoc($result))
        {
            echo("<tr>");
            if ($is_first)
            {
                foreach ($row as $key=>$value)
                {
                    echo("<td>$key</td>");
                }
                echo("</tr>");
                echo("<tr>");
            }
            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</td>");
            $is_first = FALSE;
        }
        echo("</table>");
    }
}

function build_table_from_result($result)
{
    $is_first = TRUE;
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        while ($row = mysqli_fetch_assoc($result))
        {
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
            echo("<td><input type='radio' name='id_selected' value=\"$row_id\"></td>");
            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</td>");
            $is_first = FALSE;
        }
        echo("</table>");
    }
}
function build_table_from_result_with_name($result, $name)
{
    $is_first = TRUE;
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        while ($row = mysqli_fetch_assoc($result))
        {
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
            echo("<td><input type='radio' name='" . $name . "' value=\"$row_id\"></td>");
            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</td>");
            $is_first = FALSE;
        }
        echo("</table>");
    }
}

function build_table_from_result_with_name_checkbox($result, $prefix)
{
    $is_first = TRUE;
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        while ($row = mysqli_fetch_assoc($result))
        {
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
            echo("<td><input type='checkbox' name='" . $prefix . $row_id . "'></td>");
            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</td>");
            $is_first = FALSE;
        }
        echo("</table>");
    }
}


function build_table_from_result_with_name_checkbox_preselected($result, $prefix, $ids_selected)
{
    $is_first = TRUE;
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        while ($row = mysqli_fetch_assoc($result))
        {
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
            echo("<td><input type='checkbox' name='" . $prefix . $row_id . "'></td>");
            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</td>");
            $is_first = FALSE;
        }
        echo("</table>");
    }
}

function build_table_from_result_preselected($result, $selectedId)
{
    $is_first = TRUE;
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        while ($row = mysqli_fetch_assoc($result))
        {
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
            if($row_id==$selectedId){
                echo("<td><input type='radio' name='id_selected' value=\"$row_id\" checked='checked'></td>");
            } else{
                echo("<td><input type='radio' name='id_selected' value=\"$row_id\"></td>");
            }
            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</td>");
            $is_first = FALSE;
        }
        echo("</table>");
    }
}
?>

