<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test-sql</title>
</head>
<body>
<?php
echo "<br/>";
require_once("mysqldb.php");

function sql_result_to_array($result)
{
    $result_array = array();
    while($row = $result->fetch_assoc()){
        $result_array[] = $row;
    }
    return $result_array;
}
function print_result_array($result_array)
{
    foreach ($result_array as $row)
    {
        echo "<br/>";
        foreach ($row as $col)
        {
            echo $col . "&nbsp;&nbsp;&nbsp;";
        }
    }
}

# test raeume
echo "<br/> Test raeume <br/>";
sql_raeume_create($mysqli, "001", "raum 1", "dies ist ein testraum");
sql_raeume_create($mysqli, "001", "raum 1", "dies ist ein testraum");

$res = sql_raeume_list($mysqli, 0, 10);
$res= sql_result_to_array($res);
print_result_array($res);

sql_raeume_delete($mysqli, 2);

sql_raeume_update($mysqli, 3, "002", "raum 2", "dies ist ein geaenderter testraum");

echo "<br/>";
$res = sql_raeume_list($mysqli, 0, 10);
$res= sql_result_to_array($res);
print_result_array($res);

# test lieferant
echo "<br/><br/> Test lieferant <br/>";
sql_lieferant_anlegen($mysqli, "testfirma", "test strasse", "9715", "entenhausen", "090019", "51982742", "723598723", "email@mail.com");
sql_lieferant_anlegen($mysqli, "testfirma2", "test strasse", "9715", "entenhausen", "090019", "51982742", "723598723", "email@mail.com");

$res = sql_lieferant_list($mysqli, 0, 10);
$res= sql_result_to_array($res);
print_result_array($res);

sql_lieferant_delete($mysqli, 1);

sql_lieferant_update($mysqli, 2, "updateFirma", "update strasse", "9716", "entenhausen", "90020", "51982743", "723598724", "update@mail.com");

echo "<br/>";
$res = sql_lieferant_list($mysqli, 0, 10);
$res = sql_result_to_array($res);
print_result_array($res);

# test benutzer
echo "<br/><br/> Test benutzer <br/>";
sql_benutzer_anlegen($mysqli, "name", "vorname", "nick1", "superpwdhash", 1);
sql_benutzer_anlegen($mysqli, "name2", "vorname2", "nick2", "superduperpwdhash", 3);

$res = sql_benutzer_list($mysqli, 0, 10);
$res= sql_result_to_array($res);
print_result_array($res);

sql_benutzer_delete($mysqli, 2);

sql_benutzer_update($mysqli, 3, "updatename", "update vorname", "updateNick", "pwdhash", 2);

echo "<br/>";
$res = sql_benutzer_list($mysqli, 0, 10);
$res = sql_result_to_array($res);
print_result_array($res);


# test komponentenart
echo "<br/><br/> Test komponentenart <br/>";
sql_komponentenart_anlegen($mysqli, "komponentenart nr1");
sql_komponentenart_anlegen($mysqli, "komponentenart nr2");

$res = sql_komponentenart_list($mysqli, 0, 10);
$res= sql_result_to_array($res);
print_result_array($res);

sql_komponentenart_delete($mysqli, 1);

sql_komponentenart_update($mysqli, 2, "updated komponentenart");

echo "<br/>";
$res = sql_komponentenart_list($mysqli, 0, 10);
$res = sql_result_to_array($res);
print_result_array($res);


# test komponentenattribut
echo "<br/><br/> Test komponentenattribut <br/>";
sql_komponentenattribut_anlegen($mysqli, "komp attr nr1");
sql_komponentenattribut_anlegen($mysqli, "komp attr nr2");

$res = sql_komponentenattribut_list($mysqli, 0, 10);
$res= sql_result_to_array($res);
print_result_array($res);

sql_komponentenattribut_delete($mysqli, 1);

sql_komponentenattribut_update($mysqli, 2, "updated komp attr");

echo "<br/>";
$res = sql_komponentenattribut_list($mysqli, 0, 10);
$res = sql_result_to_array($res);
print_result_array($res);


# test komponente
echo "<br/><br/> Test komponente <br/>";
sql_komponente_anlegen($mysqli, "komp bezeichn 1", 4, 2, date("Y-m-d"), 365, "super notiz", "hersteller 1", 2);
sql_komponente_anlegen($mysqli, "komp bezeichn 2", 4, 2, date("Y-m-d"), 365, "super notiz", "hersteller 1", 2);

$res = sql_komponente_list($mysqli, 0, 10);
$res= sql_result_to_array($res);
print_result_array($res);

sql_komponente_delete($mysqli, 1);

sql_komponente_update($mysqli, 2, "update bezeichn 2", 4, 2, date("Y-m-d"), 365, "super notiz", "hersteller 1", 2);

echo "<br/>";
$res = sql_komponente_list($mysqli, 0, 10);
$res = sql_result_to_array($res);
print_result_array($res);
?>
    
</body>
</html>