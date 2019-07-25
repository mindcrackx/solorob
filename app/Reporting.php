<?php
    session_start();
    require_once("../helpers/validate_access.php");
    require_once("../mysqldb.php");
    validate_access("Wartung");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/mainstyles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporting</title>
    <h1>Reporting</h1>
</head>
<body>
    <?php
    $sql0=$sql1=$sql2=$sql3=$sql4=$sql5=$sql6=$sql7="%";
    $orderBy='k_id';
    $sort='ASC';

    if(isset($_POST['bezeichnung'])){
        $sql0=$_POST['bezeichnung']."%";
    }
    if(isset($_POST['r_nr'])){    
        $sql1=$_POST['r_nr']."%";
    }
    if(isset($_POST['l_firmenname'])){    
        $sql2=$_POST['l_firmenname']."%";
    }
    if(isset($_POST['k_einkaufsdatum'])){
        $sql3=$_POST['k_einkaufsdatum']."%";
    }
    if(isset($_POST['k_gewaehrleistungsdauer'])){
        $sql4=$_POST['k_gewaehrleistungsdauer']."%";
    }    
    if(isset($_POST['k_notiz'])){
        $sql5=$_POST['k_notiz']."%";
    }
    if(isset($_POST['k_hersteller'])){
        $sql6=$_POST['k_hersteller']."%";
    }
    if(isset($_POST['ka_komponentenart'])){   
        $sql7=$_POST['ka_komponentenart']."%";
    }if(isset($_POST['orderBy'])){
        $orderBy=$_POST['orderBy'];
    }if(isset($_POST['sort'])){
        $sort=$_POST['sort'];
    }


        echo ('<form method="post">');
        
        echo("Sortieren:  Aufsteigend");
        echo("<input type='radio' name='sort' value='ASC'> Absteigend <input type='radio' name='sort' value='DESC'><br>");

        build_table_from_result_reporting(sql_komponente_list_reporting($mysqli, 0, 10, $sql0, $sql1, $sql2, $sql3, $sql4, $sql5, $sql6, $sql7, $orderBy, $sort)); 
        // $mysqli,$startNum,$howMany,$bezeichnung,$r_nr,$l_firmenname,$k_einkaufsdatum,$k_gewaehrleistungsdauer,$k_notiz,$k_hersteller,$ka_komponentenart
        echo ('<br>');
        echo('<input type="submit" value="Filter setzen" name="setFilter"');
       
        echo ("<input type='hidden' name='random'>"); //i dont know why, but this is needed!
        echo ('</form>')
    ?>
</body>
</html>


<?php
function build_table_from_result_reporting($result)
{
    $is_first = TRUE;
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        echo("<table border=\"1\">");
        
        $sqlRowCount=0;
        while ($row = mysqli_fetch_assoc($result))
        {
            echo("<tr>");
            if ($is_first)
            {
                echo("<td></td>");
                foreach ($row as $key=>$value)
                {
                    echo("<td>$key</td>");
                }
                echo("</tr>");
                echo("<tr>");
                echo("<tr>  <td>Filter:</td>
                    <td><br></td>
                    <td><input type='text' name='bezeichnung'></td>
                    <td><input type='text' name='r_nr'></td>
                    <td><input type='text' name='l_firmenname'></td>    
                    <td><input type='text' name='k_einkaufsdatum'></td>        
                    <td><input type='text' name='k_hersteller'></td>  
                    <td><input type='text' name='k_gewaehrleistungsdauer'</td> 
                    <td><input type='text' name='k_notiz'></td>     
                    <td><input type='text' name='ka_komponentenart'></td> 
                </tr>");
                echo("<tr>
                    <td>Sortiere nach:</td>
                    <td><input type='radio' name='orderBy' value='k_id'</td>
                    <td><input type='radio' name='orderBy' value='bezeichnung'</td>
                    <td><input type='radio' name='orderBy' value='r_nr'</td>
                    <td><input type='radio' name='orderBy' value='l_firenname'</td>
                    <td><input type='radio' name='orderBy' value='K_einkaufsdatum'</td>
                    <td><input type='radio' name='orderBy' value='k_hersteller'</td>
                    <td><input type='radio' name='orderBy' value='k_gewaehrleistungsdauer'</td>
                    <td><input type='radio' name='orderBy' value='k_notiz'</td>
                    <td><input type='radio' name='orderBy' value='ka_komponentenart'</td>        
                </tr>");

            }
            foreach ($row as $value)
            {
               $row_id = $value;
               break;
            }
            //location for asc desc
            echo ("<td></td>");

            foreach ($row as $value)
            {
                echo("<td>$value</td>");
            }
            echo("</td>");
            $is_first = FALSE;
            $sqlRowCount++;
        }
        echo("</table>");
    }
}
?>