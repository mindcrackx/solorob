<?php
session_start();
require_once("../helpers/validate_access.php");
validate_access("Wartung");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/mainstyles.css">
    <title>Ausmusterung</title>
</head>
<body>


    <h1>Komponente Warten</h1>
    <h3>Komponente die ausgetauscht werden muss:</h3>
	<form method=post>
        <?php
        require_once("../mysqldb.php");
        $showSecTable=false;

        //pages...
        $pagination_step = 10;
        $first = 0;
        $last = $pagination_step;
        if (isset($_POST["btn_links"]))
            $first = $_POST["first"] - $pagination_step;

        if (isset($_POST["btn_rechts"]))
            $first = $_POST["first"] + $pagination_step;

        if ($first < 0)
        $first = 0;
        //...pages

        //aufs Form reagieren...
        if(isset($_POST['auswahl'])){
            if(isset($_POST['id_selected'])){
                //TODO: hinterlegen der id und speichern für zweite tabelle, im nachinen prüfen ob andere ID gewählt wurde.....
                $showSecTable=true;
            }else{
                echo "keine Komponente zum Warten ausgewählt!";
            }
            if(isset($_POST['id_selected_1'])){
                sql_komponente_austauschen($mysqli, $_POST['id_selected_1'], $_POST['id_selected']);
                echo "<h3>id: ", $_POST['id_selected'], " wurde mit: ", $_POST['id_selected_1'], " gewartet.</h3>";
            }
        }
   
        echo "<h3>Zu wartende Komponente auswählen</h3>";
        
        if($showSecTable){
            build_table_from_result_preselected(sql_komponente_list($mysqli, $first, $last), $_POST['id_selected']);
            echo "<br>";
            echo "<br>";
            build_table_from_result_with_name(sql_komponente_zum_austauschen_by_komponente($mysqli, $_POST['id_selected'], $first, $last), 'id_selected_1' );
        } else{
            build_table_from_result(sql_komponente_list($mysqli, $first, $last));
        }
    ?>
    <!--pages form...-->
    <input type="hidden" name="first" value="<?php echo $first ?>">
    <?php
    echo('<input type="submit" name="btn_links" value="<" size="5"');
    if ($first === 0)
        echo(" disabled");
    echo(">");
    ?>
    <input type="submit" name="btn_rechts" value=">" size="5">
    <!--...pages form-->
    <input type="submit" name="auswahl" value="Auswählen">
    </form>
</body>
</html>