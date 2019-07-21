<?php
$mysqli = new mysqli("127.0.0.1", "admin", "adminadmin", "solorob_db");
if ($mysqli->connect_error){
    echo "Failed to connect to MySQL: (" . $mysqli->connect_error . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

require_once("solorob_db_helpers/raeume.php");
require_once("solorob_db_helpers/lieferant.php");
require_once("solorob_db_helpers/benutzer.php");
?>

