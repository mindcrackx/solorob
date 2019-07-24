<?php
function validate_access($funktion)
{
if ((! (isset($_SESSION["loggedin"]))) || (! $_SESSION["loggedin"]))
    die("Zugriff verweigert, Benutzer ist nicht eingeloggt");

if (! in_array($funktion, $_SESSION["funktionen"]))
    die("Zugriff verweigert, Benutzer hat nicht die entsprechenden Berechtigungen");
}
?>