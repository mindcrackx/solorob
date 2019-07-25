<?php
session_start();
require_once("../helpers/validate_access.php");
require_once("../mysqldb.php");
validate_access("Wartung");
$_SESSION['Wartung.php'];
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
            $showSecTable=false;
            //pages...
            $pagination_step[0] = 10;
            $first[0] = 0;
            $last[0] = $pagination_step[0];
            if (isset($_POST["btn_links_0"]))
                $first[0] = $_POST["first_0"] - $pagination_step[0];

            if (isset($_POST["btn_rechts_0"]))
                $first[0] = $_POST["first_0"] + $pagination_step[0];

            if ($first[0] < 0)
            $first = [0];
            //...pages...
            $pagination_step[1] = 10;
            $first[1] = 0;
            $last[1] = $pagination_step[1];
            if (isset($_POST["btn_links_1"]))
                $first[1] = $_POST["first_1"] - $pagination_step[1];

            if (isset($_POST["btn_rechts_1"]))
                $first[1] = $_POST["first_1"] + $pagination_step[1];

            if ($first[1] < 0)
                $first[1] = 0;
            //...pages

            //aufs Form reagieren...
            if(isset($_POST['auswahl'])){
                if(isset($_POST['id_selected'])){
                    $showSecTable=true;
                    $_SESSION['Wartung.php']['idFirstTable']=$_POST['id_selected'];
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
                echo $_SESSION['Wartung.php']['idFirstTable'];
                echo build_table_from_result_preselected(sql_komponente_list_one($mysqli, $_SESSION['Wartung.php']['idFirstTable']), $_SESSION['Wartung.php']['idFirstTable']);
            } else{
                build_table_from_result(sql_komponente_list($mysqli, $first[0], $last[0]));
            }
    
            if(!$showSecTable){
                echo('<input type="hidden" name="first_0"       value="<?php echo $first[0] ?>">');    
                echo('<input type="submit" name="btn_links_0"   value="<"               size="5"');
                if ($first[0] === 0)
                    echo(" disabled");
                echo(">");
                echo('<input type="submit" name="btn_rechts_0"  value=">"               size="5">');
            }else{
                echo "<br>";
                echo "<br>";
                build_table_from_result_with_name(sql_komponente_zum_austauschen_by_komponente($mysqli, $_POST['id_selected'], $first[1], $last[1]), 'id_selected_1' );
                echo "<br>";
                echo('<input type="hidden" name="first_1"       value="<?php echo $first[1] ?>">');    
                echo('<input type="submit" name="btn_links_1"   value="<"               size="5"');
                if ($first[1] === 0)
                    echo(" disabled");
                echo(">");
                echo('<input type="submit" name="btn_rechts_1"  value=">"               size="5">');

            }
            echo('<input type="submit" name="auswahl" value="Auswählen">');
        ?>    
    </form>
</body>
</html>