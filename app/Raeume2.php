<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Räume verwaltung</title>
    <style>
    td {border: 1px #DDD solid; padding: 5px; cursor: pointer;}

    .selected {
        background-color: brown;
        color: #FFF;
    }
    </style>
</head>
<body>
<?php
require_once("../mysqldb.php");
$raum_data = sql_raeume_list($mysqli, 0, 100);
#print_r($raum_data->fetch_all(MYSQLI_ASSOC));
?>
<h1>Raum Verwaltung</h1>
<form action="" method="post">
<?php 
build_table_from_result($raum_data);
?>
<br/>
<input type="button" id="tst" value="OK" onclick="fnselect()" />
<script>
        var table = document.getElementById('table'),
        selected = table.getElementsByClassName('selected');
        table.onclick = highlight;
        function highlight(e) {
            if (selected[0]) selected[0].className = '';
            e.target.parentNode.className = 'selected';
        }
        function fnselect(){
        var $row=$(this).parent().find('td');
            var clickeedID=$row.eq(0).text();
            alert(clickeedID);
        }
</script>
</form>

<!--
<h1>Raum anlegen</h1>
<form action="" method="post">
    <input type="text" name="raum_nr" placeholder="Raum Nummer">
    <br/>
    <input type="text" name="raum_bezeichnung" placeholder="Raum Bezeichnung">
    <br/>
    <input type="text" name="raum_notiz" placeholder="Raum Notiz">
    <br/>
    <input type="submit" value="Anlegen">
</form>
-->
</body>
</html>